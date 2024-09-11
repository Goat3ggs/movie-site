<?php require_once('./includes/header.php') ?>

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
  // 3. Generaza ID unic folosind $i pentru a incrementa.

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

<?php require_once('./includes/footer.php') ?>