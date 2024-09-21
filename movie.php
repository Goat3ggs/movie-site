<?php require_once('./includes/header.php'); ?>

<?php

/* Primul "if" verifica:
    1. daca "movie_id" exista,
    2. iar daca exista verifica daca NU este gol:
        - in cazul in care NU este gol, defineste variabila
        $movie_id care sa tina id-ul fiecarui film luat prin metoda GET.
In interiorul if-ului avem variabila $filtered_movies
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
                    <li>Leonardo DiCaprio</li>
                    <li>Kate Winslet</li>
                    <li>Billy Zane</li>
                    <li>Kathy Bates</li>
                </ul>
            </div>
        </div>

<?php
    } else {
        echo "Film not found.";
    }
} else {
    echo "Invalid movie ID.";
}
?>

<?php require_once('./includes/footer.php') ?>