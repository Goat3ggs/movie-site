<?php require_once('./includes/header.php'); ?>

<?php
$pageTitle = "Movies"; // Titlu implicit

// Verificăm dacă parametrul 'genre' este setat în URL
if (isset($_GET['genre'])) {
  $selectedGenre = $_GET['genre'];

  // Filtrăm filmele care conțin genul selectat
  $filteredMovies = array_filter($movies, function ($movie) use ($selectedGenre) {
    return isset($movie['genres']) && is_array($movie['genres']) && in_array($selectedGenre, $movie['genres']);
  });

  // Setăm titlul paginii pe baza genului selectat
  if (!empty($filteredMovies)) {
    $pageTitle = htmlspecialchars($selectedGenre) . " Movies"; // Titlu dinamic
  } else {
    $pageTitle = "No movies found in this genre"; // Titlu pentru cazul fără rezultate
  }
}
?>

<h1><?php echo $pageTitle; ?></h1> <!-- Titlul este acum la începutul paginii -->

<div class="row">

  <?php
  // Afișăm filmele filtrate sau toate filmele
  if (
    isset($filteredMovies) &&
    !empty($filteredMovies)
  ) {
    foreach ($filteredMovies as $movie) { ?>
      <div class="col-12 col-md-6 col-lg-4 mb-4" id="movie-<?php echo $movie["id"]; ?>">
        <?php require("./includes/archive-movie.php"); ?>
      </div>
    <?php }
    // Verificăm dacă există filme filtrate
    if (empty($filteredMovies)) {
      echo "<p>No movies found in this genre.</p>";
    }
  } else {
    // Afișăm toate filmele dacă nu este setat un gen
    foreach ($movies as $movie) { ?>
      <div class="col-md-4 mb-4" id="movie-<?php echo $movie["id"]; ?>">
        <?php require("./includes/archive-movie.php"); ?>
      </div>
  <?php }
  }
  ?>

</div>

<?php require_once('./includes/footer.php'); ?>