<?php
// Calea catre fisierul JSON 
$json_file_path = "./assets/movie-favorites.json";

require_once("./includes/functions.php");

// Verificăm dacă s-a trimis formularul și preluăm acțiune
if (!empty($_GET) && isset($_GET["movie_id"])) {
    // Extrage ID-ul din URL
    $movie_id = intval($_GET["movie_id"]);

    // Citim continutul fisierului JSON
    $favorites_data = get_movie_favorites();

    // Verificam daca ID-ul filmului exista in fisiser
    $favorites_count = isset($favorites_data[$movie_id]) ? $favorites_data[$movie_id] : 0;

    // Verificam daca exista cookie-ul "keep_fav_movies"
    $fav_movies = [];
    if (isset($_COOKIE["keep_fav_movies"])) {
        // Preluam ID-urle filmelor existente din cookie si le transformam in array
        $fav_movies = json_decode($_COOKIE["keep_fav_movies"], true);
        if (!is_array($fav_movies)) {
            $fav_movies = []; // In caz ca exista o eroare in cookie, reinitializam array-ul
        }
    }

    // Verificam daca filmul este deja in favorite
    $is_already_favorite = in_array($movie_id, $fav_movies);

    // Verificam daca formularul a fost trimis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["favorite"])) {
        $is_favorite = intval($_POST["favorite"]); // 1 pentru adaugare, 0 pentru stergere

        // Daca adaugam filmul la favorite
        if ($is_favorite === 1) {
            // Incrementeaza numarul de adaugari la favorite pentru acest film
            if (isset($favorites_data[$movie_id])) {
                $favorites_data[$movie_id]++;
            } else {
                $favorites_data[$movie_id] = 1;
            }

            // Adaugam filmul la lista de favorite daca nu este deja prezent
            if (!in_array($movie_id, $fav_movies)) {
                $fav_movies[] = $movie_id;
            }
        }
        // Daca stergem filmul din favorite
        else if ($is_favorite === 0) {
            if (isset($favorites_data[$movie_id]) && $favorites_data[$movie_id] > 0) {
                $favorites_data[$movie_id]--;
            }

            // Stergem filmul din lista de favorite
            //array_search cauta id-ul filmului curent "$movie_id" in lista de favorite "$fav_movies" si o leaga de variabila "$key"
            if (($key = array_search($movie_id, $fav_movies)) !== false) {
                unset($fav_movies[$key]);
            }
        }

        // Salvam modificarile in fisierul JSON
        save_movie_favorites($favorites_data);

        // Salvam ID-urile filmelor inapoi in cookie, convertind array-ul in JSON
        setcookie("keep_fav_movies", json_encode($fav_movies), time() + 86400 * 365);

        // Redirectionam pentru a evita trimiterea accidentala a formularului la refresh
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    // Schimbam textul butonului si valoarea in functie de starea filmului
    $button_text = $is_already_favorite ? "Remove from Favorite" : "Add to Favorite";
    $favorites_value = $is_already_favorite ? 0 : 1;
    $btn_aspect = $is_already_favorite ? "btn-danger" : "btn-success";

    // Includem header-ul
    require_once('./includes/header.php');

    // Filtram array-ul $movies pentru a gasi filmul care are ID-ul egal cu $movie_id
    $filtered_movies = array_filter($movies, function ($movie) use ($movie_id) {
        return $movie['id'] === $movie_id;
    });

    // Extragem primul rezultat din array-ul filtrat
    $movie = reset($filtered_movies); // reset() returneaza primul element din array


    // Verificăm dacă există filmul
    if ($movie) {
?>
        <div class="flex">
            <h1><?php echo $movie["title"] ?></h1>
            <form action="" method="POST">
                <input type="hidden" name="favorite" value="<?php echo $favorites_value ?>">
                <button class="btn <?php echo $btn_aspect ?>" type="submit">
                    <?php echo $button_text ?>
                </button>
                <!-- Afisam numarul de adaugari la favorite -->
                <span class="badge text-bg-secondary"><?php echo $favorites_count ?> times added</span>
            </form>
        </div>

        <div class="row">
            <div class="col-md-4 col-lg-3">
                <img
                    class="card-img-top"
                    src="<?php echo check_poster($movie['posterUrl']); ?>"
                    alt="poster for <?php echo $movie["title"] ?>" />
            </div>
            <div class="col-md-8 col-lg-9">
                <h2><?php echo $movie["year"] ?> <?php check_old_movie($movie["year"]) ?> </h2>
                <p class="description mb-3"><?php echo $movie["plot"] ?></p>
                <p class="mb-3">Directed By: <span class="movie-info-bold"><?php echo $movie["director"] ?></span></p>
                <p class="mb-3">Runtime: <span class="movie-info-bold"><?php echo runtime_prettier($movie["runtime"]) ?></span></p>
                <h4>Cast:</h4>
                <ul class="customIndent">
                    <?php
                    // in array actorii sunt listati sub forma de "string", de aceea trebuie sa folosim explode ca o modalitate de a-i separa, inlaturand virgula
                    $actors = explode(",", $movie["actors"]);

                    foreach ($actors as $actor) {
                        echo "<li>$actor</li>";
                    }
                    ?>
                </ul>
                <h4>Genres:</h4>
                <!-- Varianta 1 -->
                <!-- <p><?php echo implode(", ", $movie["genres"]) ?></p> -->

                <!-- Varianta 2 -->
                <!-- <p><?php
                        $arr = $movie["genres"];
                        $gens = "";
                        foreach ($arr as $gen) {
                            $gens = $gens . $gen . ", ";
                        }
                        echo rtrim($gens, ", ");
                        ?></p> -->

                <!-- Varianta 3 -->
                <p>
                    <?php
                    $arr = $movie["genres"];
                    $first_genre = $movie['genres'][0];
                    $gens = "";
                    foreach ($arr as $gen) {
                        if ($gen !== $first_genre) {
                            $gens = $gens . ", " . $gen;
                        }
                    }
                    echo $first_genre . $gens;
                    ?>
                </p>
            </div>

            <h4>Review Movie</h4>
            <form action="" method="post">
                <input class="form-control mb-3" type="text" id="name" placeholder="name" required>

                <input class="form-control" type="email" id="email" placeholder="email@example.com" required><br>

                <textarea class="form-control" name="review" id="review" rows="4" cols="0" placeholder="e.g. I like this movie because..." required></textarea>

                <div class="input-group mb-3 mt-3">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" id="accept" type="checkbox" value="Yes" aria-label="Checkbox for following text input">
                    </div>
                    <label for="accept" class="form-control">I agree to the processing of personal data.</label>
                </div>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verificăm dacă cheia 'personal-data' există în $_POST
                if (isset($_POST['personal-data']) && $_POST['personal-data'] == 'Yes') {
                    echo "Your review message was sent successfully!";
                } else {
                    echo "You need to agree!";
                }
            }
            ?>
        </div>

    <?php
    } else { ?>
        <h2>Film not found...Go back</h2>
        <a href="movies.php" class="btn btn-primary">Movie Page</a>

    <?php }
} else { ?>
    <h2>Invalid movie ID...Go back</h2>
    <a href="movies.php" class="btn btn-primary">Movie Page</a>
<?php }
?>

<?php require_once('./includes/footer.php') ?>