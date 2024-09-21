<?php require_once('./includes/header.php') ?>

<h1>Movies</h1>

<div class="row">

  <?php

  // 1. Itereaza peste matrice;
  // 2. Creaza html pentru fiecare obiect;
  // Pentru a adauga html in functie trebuie sa inchidem codul de php astfel - dupa acolada deschisa inchidem/ deschidem inainte de acolada inchisa;
  // 3. Generaza ID unic folosind $i pentru a incrementa.
  foreach ($movies as $movie) { ?>

    <div class="col-md-4 mb-4" id="movie-<?php echo  $movie["id"] ?>">
      <?php require("./includes/archive-movie.php") ?>
    </div>
  <?php $movie["id"]++;
  } ?>

</div>

<?php require_once('./includes/footer.php') ?>