<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grigore Stefania</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php
    $navbar = array(
        array("nume" => "Home", "link" => "index.php"),
        array("nume" => "Movies", "link" => "movies.php"),
        array("nume" => "Contact", "link" => "contact.php"),
    );

    define("LOGO", "GS");

    // Obtine fisierul curent folosind basename
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a
                class="navbar-brand"
                href="/index.php"><?php echo LOGO ?>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php foreach ($navbar as $nav) {
                // Verificam daca pagina coincide cu link-ul din meniu
                $active_class = ($current_page === basename($nav["link"])) ? "active" : "";
            ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a
                                class="nav-link <?php echo $active_class; ?>"
                                aria-current="page"
                                href="<?php echo $nav["link"] ?>">
                                <?php echo $nav["nume"] ?>
                            </a>
                        </li>
                    </ul>
                <?php }
            include("search-form.php") ?>
                </div>
        </div>
    </nav>
    <div class="container">

        <?php
        // creaza if si incapsuleaza array-ul de $movies
        // verifica ince fisier te afli in momentul de fata.
        // DACA esti in index.php/contact.php NU incarca array-ul
        // Obtine fisierul curent folosind basename
        // $current_page = basename($_SERVER['PHP_SELF']);

        if ($current_page === "index.php" || $current_page === "contact.php") {
            echo "<h4>Welcome to our site! Please visit the Movie page for more information.</h4>";
        } else {
            $movies = array(
                array(
                    "id" => 1,
                    "image" => "https://m.media-amazon.com/images/I/71uoicxpqoS._AC_UF1000,1000_QL80_.jpg",
                    "title" => "Titanic",
                    "info" => "James Cameron's \"Titanic\" is an epic, action-packed romance set against the ill-fated maiden voyage of the R.M.S"
                ),
                array(
                    "id" => 2,
                    "image" => "https://image.tmdb.org/t/p/original/unbrtK8zEjPANvNkbwhjpSxYWzN.jpg",
                    "title" => "Avatar",
                    "info" => "James Cameron's Academy Award®-winning 2009 epic adventure \"Avatar\", returns to theaters September 23"
                ),
                array(
                    "id" => 3,
                    "image" => "https://m.media-amazon.com/images/M/MV5BMGU2NzRmZjUtOGUxYS00ZjdjLWEwZWItY2NlM2JhNjkxNTFmXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg",
                    "title" => "Terminator 2: Judgment Days",
                    "info" => "In this sequel set eleven years after \"The Terminator\", young John Connor"
                )
            );
        }

        include("functions.php");
