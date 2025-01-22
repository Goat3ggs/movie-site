<?php
if (is_active_sidebar('footer-widgets')) { ?>
    <div div class="container footer-container" id="footer-sidebar">
        <div class="row row-cols-1 row-cols-md-3">
            <?php dynamic_sidebar('footer-widgets'); ?>
        </div>
    </div>
<?php }
?>