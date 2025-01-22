<?php require_once('./includes/header.php') ?>


<?php
if (!empty($_GET) && isset($_GET["search"])) {
    $search_value = $_GET["search"];

    if (strlen($search_value) < 3) {
        echo "<h2>Error: Search term must be at least 3 characters long.</h2>";
        echo "<p>Please enter a longer search term.</p>";
    } else { ?>
        <h2>Search results for: <?php echo $search_value ?></h2>
        <?php include('./includes/search-form.php') ?>

        <?php
        $filtered_movies = array_filter($movies, function ($movie) use ($search_value) {
            return stripos($movie["title"], $search_value) !== false;
        });

        if (!empty($filtered_movies)) {
            echo "<div class='row'>";
            foreach ($filtered_movies as $movie) { ?>
                <div class='col-md-4 mb-4'>
                    <?php require("./includes/archive-movie.php") ?>
                </div>
    <?php }
            echo "</div>";
        } else {
            // Dacă nu găsim niciun film potrivit
            echo "<p>No movies found with the title.</p>";
        }
    } ?>
<?php } else { ?>
    <h2>You entered here by accident.</h2>
    <p>Please search for a movie.</p>
<?php } ?>




<?php require_once('./includes/footer.php') ?>