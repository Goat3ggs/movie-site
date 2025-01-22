<?php
// session_start(); // Începe sesiunea pentru a putea stoca mesajele

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
        <div class="flex mt-4">
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
                    class="card-img-top mb-4"
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


            <?php
            $conn = connectToDatabase();

            $sql = "CREATE TABLE IF NOT EXISTS review (
                review_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                movie_name VARCHAR(255) NOT NULL,
                review_auth VARCHAR(255) NOT NULL,
                review_email VARCHAR(320) NOT NULL,
                review_msg TEXT NOT NULL
            )";

            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . mysqli_error($conn);
            }

            $form_submitted = false; // de aici controlam vizibilitatea formularului
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["review"])) {

                // Verificăm dacă id-ul 'accept' există în $_POST
                if (isset($_POST['accept']) && $_POST['accept'] == 'Yes') {
                    // Preluam datele din formular
                    $movie_name = mysqli_real_escape_string($conn, $_GET["movie_id"]);
                    $review_author = mysqli_real_escape_string($conn, $_POST["name"]);
                    $review_email = mysqli_real_escape_string($conn, $_POST["email"]);
                    $review_msg = mysqli_real_escape_string($conn, $_POST["review_msg"]);

                    $show_resuts = "SELECT review_ID, review_email FROM review WHERE movie_name = $movie_name";
                    $email_exists = mysqli_query($conn, $show_resuts);

                    // Construieste interogarea SQL pentru inserare 
                    $sql2 = "INSERT INTO review(movie_name, review_auth, review_email, review_msg)VALUES ('$movie_name', '$review_author', '$review_email', '$review_msg')";


                    // Verifica daca email-ul exista si a trimis un review
                    // Daca exista NU salva datele si arunca o eroare
                    if (mysqli_num_rows($email_exists) > 0) {
                        $form_submitted = true;
                        echo '<div class="alert alert-danger" role="alert">
                            It seems that you have already left a review for this movie. You cannot leave multiple reviews for the same movie.
                        </div>';
                    } else {
                        // In cazul in care nu exista finalizeaza trimiterea formularului
                        // Executa interogarea 
                        if (mysqli_query($conn, $sql2)) {
                            $form_submitted = true; // Formularul trimis cu succes
                            echo '<div class="alert alert-success" role="alert">
                                    Your review was sent successfully!
                                </div>';
                        } else {
                            "Error: " . $sql2 . "<br>" . mysqli_error($conn);
                        }
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                            Select the check box!
                        </div>';
                }
            }

            if (!$form_submitted): ?>
                <h4>Review Movie</h4>
                <form class="mb-4" action="" method="post">
                    <input class="form-control mb-3" type="text" name="name" id="name" placeholder="name" required>

                    <input class="form-control" type="email" name="email" id="email" placeholder="email@example.com"><br>

                    <textarea class="form-control" name="review_msg" id="review_msg" rows="4" cols="0" placeholder="e.g. I like this movie because..." required></textarea>

                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" name="accept" id="accept" type="checkbox" value="Yes" aria-label="Checkbox for following text input">
                        </div>
                        <label for="accept" class="form-control">I agree to the processing of personal data.</label>
                    </div>

                    <input type="submit" name="review" value="Submit">
                </form>
            <?php endif; ?>

            <?php
            $movie_name = mysqli_real_escape_string($conn, $_GET["movie_id"]);
            $show_resuts = "SELECT review_auth, review_msg FROM review WHERE movie_name = $movie_name";
            $result = mysqli_query($conn, $show_resuts);

            if (mysqli_num_rows($result) > 0) {
                echo "<h4>Reviews</h4>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    
                    <div class="card mb-4" ">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["review_auth"] . '</h5>
                            <p class="card-text">' . $row["review_msg"] . ' </p>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '
                <h5>Reviews</h5>
                <p>Be the first to leave a review for this movie!</p>';
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