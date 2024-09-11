<?php require_once('./includes/header.php') ?>

<h1>Movies</h1>

<div class="row">

  <?php require_once("./includes/header.php");

  // 1. Itereaza peste matrice;
  // 2. Creaza html pentru fiecare obiect;
  // Pentru a adauga html in functie trebuie sa inchidem codul de php astfel - dupa acolada deschisa inchidem/ deschidem inainte de acolada inchisa;
  // 3. Generaza ID unic folosind $i pentru a incrementa.


  foreach ($movies as $movie) {
    $i = $movie["id"]; ?>

    <div class="col-md-4 mb-4" id="<?php echo $i ?>">
      <div class="card">
        <img src="<?php echo $movie["image"] ?>" class="card-img-top" alt="titanic image">
        <div class="card-body">
          <h5 class="card-title"><?php echo $movie["title"] ?></h5>
          <p class="card-text"><?php echo $movie["info"] . "..."  ?></p>
          <a href="./movie-<?php echo $i ?>.php" class="btn btn-primary">Read more</a>
        </div>
      </div>
    </div>
  <?php $i++;
  } ?>

</div>

<?php require_once('./includes/footer.php') ?>