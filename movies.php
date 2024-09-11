<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movies</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">GS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./movies.php">Movies</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./contact.php">Contact</a>
          </li>
      </div>
    </div>
  </nav>

  <div class="container">
    <h1>Movies</h1>

    <div class="row">

      <?php

      $movies = array(
        array(
          "image" => "https://m.media-amazon.com/images/I/71uoicxpqoS._AC_UF1000,1000_QL80_.jpg",
          "title" => "Titanic",
          "info" => "James Cameron's \"Titanic\" is an epic, action-packed romance set against the ill-fated maiden voyage of the R.M.S"
        ),
        array(
          "image" => "https://image.tmdb.org/t/p/original/unbrtK8zEjPANvNkbwhjpSxYWzN.jpg",
          "title" => "Avatar",
          "info" => "James Cameron's Academy Award®-winning 2009 epic adventure \"Avatar\", returns to theaters September 23"
        ),
        array(
          "image" => "https://m.media-amazon.com/images/M/MV5BMGU2NzRmZjUtOGUxYS00ZjdjLWEwZWItY2NlM2JhNjkxNTFmXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg",
          "title" => "Terminator 2: Judgment Days",
          "info" => "In this sequel set eleven years after \"The Terminator\", young John Connor"
        )
      );



      // 1. Itereaza peste matrice;
      // 2. Creaza html pentru fiecare obiect;
      // Pentru a adauga html in functie trebuie sa inchidem codul de php astfel - dupa acolada deschisa inchidem/ deschidem inainte de acolada inchisa;
      // 3. Generaza ID unic folosind fct. "uniqid()";

      $i = 1;

      foreach ($movies as $movie) { ?>

        <div class="col-md-4 mb-4" id="<?php echo $i ?>">
          <div class="card">
            <img src="<?php echo $movie["image"] ?>" class="card-img-top" alt="titanic image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $movie["title"] ?></h5>
              <p class="card-text"><?php echo $movie["info"] . "..."  ?></p>
              <a href="./movie-1.php" class="btn btn-primary">Read more</a>
            </div>
          </div>
        </div>
      <?php $i++;
      } ?>

    </div>
  </div>

  <div class="footer">
    Copyright. Toate drepturile rezervate.
  </div>
</body>

</html>