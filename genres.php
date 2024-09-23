<?php require_once('./includes/header.php') ?>


<?php
$genres = json_decode(file_get_contents("./assets/movies-list-db.json"), true)["genres"];
?>

<div class="d-flex gap-2 justify-content-center py-5">
    <?php foreach ($genres as $gen) { ?>
        <a href="movies.php?genre=<?php echo urlencode($gen); ?>">
            <span class="badge bg-primary-subtle border border-primary-subtle text-primary-emphasis rounded-pill"><?php echo $gen ?></span>
        </a>
    <?php } ?>
</div>

<?php require_once('./includes/footer.php') ?>