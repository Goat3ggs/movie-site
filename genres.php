<?php require_once('./includes/header.php') ?>

<h1>Genres</h1>
<?php
?>

<div class="row">
    <?php foreach ($genres as $gen) { ?>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <a href="movies.php?genre=<?php echo $gen ?>" class="btn btn-outline-primary d-block h-100 d-flex align-items-center justify-content-center rounded-pill">
                <?php echo $gen ?>
            </a>
        </div>

    <?php } ?>
</div>

<?php require_once('./includes/footer.php') ?>