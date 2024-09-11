<div class="card">
    <img src="<?php echo $movie["image"] ?>" class="card-img-top" alt="titanic image">
    <div class="card-body">
        <h5 class="card-title"><?php echo $movie["title"] ?></h5>
        <p class="card-text"><?php echo $movie["info"] . "..."  ?></p>
        <a href="./movie-<?php echo $i ?>.php" class="btn btn-primary">Read more</a>
    </div>
</div>