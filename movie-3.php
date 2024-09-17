<?php require_once('./includes/header.php') ?>

<h1>Terminator 2: Judgment day</h1>
<div class="row">
  <div class="col-3">
    <img src="https://m.media-amazon.com/images/M/MV5BMGU2NzRmZjUtOGUxYS00ZjdjLWEwZWItY2NlM2JhNjkxNTFmXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg" alt="Terminator 2 cover image" class="card-img-top">
  </div>
  <div class="col-9">
    <h2>1991 <?php check_old_movie(1991) ?></h2>
    <p>In this sequel set eleven years after "The Terminator," young John Connor (Edward Furlong), the key to civilization's victory over a future robot uprising, is the target of the shape-shifting T-1000 (Robert Patrick), a Terminator sent from the future to kill him. Another Terminator, the revamped T-800 (Arnold Schwarzenegger), has been sent back to protect the boy. As John and his mother (Linda Hamilton) go on the run with the T-800, the boy forms an unexpected bond with the robot.</p>
    <p>Directed By: <span class="movie-info-bold">James Cameron</span></p>
    <p>Runtime: <span class="movie-info-bold"><?php echo runtime_prettier(136) ?></span></p>
    <h4>Cast:</h4>
    <ul class="customIndent">
      <li>Arnold Schwarzenegger</li>
      <li>Linda Hamilton</li>
      <li>Edward Furlong</li>
      <li>Robert Patrick</li>
    </ul>
  </div>
</div>
<?php require_once('./includes/footer.php') ?>