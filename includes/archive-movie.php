<div class="card">
    <img src="<?php echo $movie["posterUrl"] ?>" class="card-img-top" alt="titanic image">
    <div class="card-body">
        <h5 class="card-title"><?php echo $movie["title"] ?></h5>
        <p class="card-text"><?php echo $movie["plot"] . "..."  ?></p>
        <a href="./movie-<?php echo $movie["id"] ?>.php" class="btn btn-primary">Read more</a>
    </div>
</div>