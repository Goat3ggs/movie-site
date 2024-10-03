<?php
// example
// $vizite = 0;
// if(isset($_COOKIE["vizite"])) {
//     $vizite = $_COOKIE["vizite"];
// }

// setcookie("vizite", $vizite, time()+60*60*24*365);
?>

<?php require_once('./includes/header.php'); ?>

<!-- Ai vizitat aceasta pagina de <?php echo $_COOKIE["vizite"]?> ori. -->

<?php
// Verificam daca s-a trimis formularul si preluam actiunea:
$is_already_favorite = false;


/* 
Primul "if" verifica:
    1. daca "movie_id" exista,
    2. iar daca exista verifica daca NU este gol:
        - in cazul in care NU este gol, defineste variabila
        $movie_id care sa tina id-ul fiecarui film luat prin metoda GET.

In interiorul if-ului avem variabila $filtered_movies:
    Aceasta ia ca si parametrii:
    1. array => in cazul nostru array-ul de filme "$movies";
    2. callback function => o functie anonima cu parametrul "$movie";
    se foloseste de variabila "$movie_id" (look for "Inheriting variables from the parent scope"):
        - folosim keyword-ul "use" pentru a "mosteni" variabila setata in domeniul parental AKA parent scope.
*/

// Verificăm dacă s-a trimis formularul și preluăm acțiunea

$is_already_favorite = false; // Simulăm că inițial filmul nu este în favorite

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["favorite"])) {
    $is_favorite = intval($_POST["favorite"]); // 1 pentru adaugare, 0 pentru stergere

    // Actualizăm starea variabilei după trimiterea formularului
    if ($is_favorite === 1) {
        $is_already_favorite = true; // Filmul e in favorite
        echo "<p>Movie was added to favorite.</p>";
    } else {
        $is_already_favorite = false; // Filmul e sters din favorite
        echo "<p>Movie was removed to favorite.</p>";
    }
}

if (!empty($_GET) && isset($_GET["movie_id"])) {
    // Extrage ID-ul din URL
    $movie_id = intval($_GET["movie_id"]);

    // Filtrăm array-ul $movies pentru a găsi filmul care are ID-ul egal cu $movie_id
    $filtered_movies = array_filter($movies, function ($movie) use ($movie_id) {
        return $movie['id'] === $movie_id;
    });

    // Extragem primul rezultat din array-ul filtrat
    $movie = reset($filtered_movies); // reset() returnează primul element din array

    // Verificăm dacă există filmul
    if ($movie) {
        // Schimbam textul butonului și valoarea în funcție de starea filmului
        $button_text = $is_already_favorite ? "Remove from Favorite" : "Add to Favorite";
        $favorite_value = $is_already_favorite ? 0 : 1;
?>
        <div class="flex">
            <h1><?php echo $movie["title"] ?></h1>
            <form action="" method="POST">
                <input type="hidden" name="favorite" value="<?php echo $favorite_value ?>">
                <button class="btn btn-outline-dark" type="submit">
                    <?php echo $button_text ?>
                </button>
            </form>
        </div>


        <div class="row">
            <div class="col-md-4 col-lg-3">
                <img
                    class="card-img-top"
                    src="<?php echo $movie["posterUrl"] ?>"
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