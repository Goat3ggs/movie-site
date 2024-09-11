<?php require_once('./includes/header.php') ?>

<h1>Titanic</h1>
<div class="row">
  <div class="col-3">
    <img src="https://m.media-amazon.com/images/I/71uoicxpqoS._AC_UF1000,1000_QL80_.jpg" alt="Titanic cover image" class="card-img-top">
  </div>
  <div class="col-9">
    <h2>1997</h2>
    <p>James Cameron's "Titanic" is an epic, action-packed romance set against the ill-fated maiden voyage of the R.M.S. Titanic; the pride and joy of the White Star Line and, at the time, the largest moving object ever built. She was the most luxurious liner of her era -- the "ship of dreams" -- which ultimately carried over 1,500 people to their death in the ice cold waters of the North Atlantic in the early hours of April 15, 1912.</p>
    <p>Directed By: <span class="movie-info-bold">James Cameron</span></p>
    <p>Runtime: <span class="movie-info-bold"><?php echo runtime_prettier(146) ?></span></p>
    <h4>Cast:</h4>
    <ul class="customIndent">
      <li>Leonardo DiCaprio</li>
      <li>Kate Winslet</li>
      <li>Billy Zane</li>
      <li>Kathy Bates</li>
    </ul>
  </div>
</div>

<?php require_once('./includes/footer.php') ?>