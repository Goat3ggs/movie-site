<?php require_once('./includes/header.php'); ?>

<?php

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
if (!empty($_GET) && isset($_GET["movie_id"])) {
    // Extrage ID-ul din URL
    $movie_id = $_GET["movie_id"];

    // Filtrăm array-ul $movies pentru a găsi filmul care are ID-ul egal cu $movie_id
    $filtered_movies = array_filter($movies, function ($movie) use ($movie_id) {
        return $movie['id'] == $movie_id;
    });

    // Extragem primul rezultat din array-ul filtrat
    $movie = reset($filtered_movies); // reset() returnează primul element din array

    // Verificăm dacă există filmul
    if ($movie) {
?>
        <h1><?php echo $movie["title"] ?></h1>
        <div class="row">
            <div class="col-3">
                <img src="<?php echo $movie["posterUrl"] ?>" alt="poster for <?php echo $movie["title"] ?>" class="card-img-top">
            </div>
            <div class="col-9">
                <h2><?php echo $movie["year"] ?> <?php check_old_movie($movie["year"]) ?> </h2>
                <p><?php echo $movie["plot"] ?></p>
                <p>Directed By: <span class="movie-info-bold"><?php echo $movie["director"] ?></span></p>
                <p>Runtime: <span class="movie-info-bold"><?php echo runtime_prettier($movie["runtime"]) ?></span></p>
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