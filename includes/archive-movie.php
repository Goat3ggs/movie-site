<?php include_once('functions.php'); ?>
<div class="card">
    <img
        class="card-img-top movie-poster"
        src="<?php echo check_poster($movie['posterUrl']);  ?>" alt="<?php echo $movie['title'] ?> image">
    <div class="card-body">
        <h5 class="card-title"><?php echo $movie["title"] ?></h5>
        <p class="card-text">
            <?php
            $plot = $movie["plot"];
            if (strlen($plot) > 100) {
                echo substr($movie["plot"], 0, 100) . "...";
            } else {
                echo $plot;
            }
            ?>
        </p>
        <a href="movie.php?movie_id=<?php echo $movie["id"] ?>" class="btn btn-primary">Read more</a>
    </div>
</div>