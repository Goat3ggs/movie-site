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
        array("nume" => "Genres", "link" => "genres.php"),
        array("nume" => "Contact", "link" => "contact.php"),
    );

    define("LOGO", "GS");

    // Obtine fisierul curent folosind basename
    $current_page = basename($_SERVER['PHP_SELF']);
    // var_dump($current_page)
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

        <?php        // creaza if si incapsuleaza array-ul de $movies
        // verifica ince fisier te afli in momentul de fata.
        // DACA esti in index.php/contact.php NU incarca array-ul
        // Obtine fisierul curent folosind basename
        // $current_page = basename($_SERVER['PHP_SELF']);
        // chack for the function in_array
        if ($current_page === "index.php" || $current_page === "contact.php" || $current_page === "genres.php") {
            echo "";
        } else {
            $movies = json_decode(file_get_contents("assets/movies-list-db.json"), true)['movies'];
        }

        $genres = json_decode(file_get_contents("./assets/movies-list-db.json"), true)["genres"];


        include("functions.php");
