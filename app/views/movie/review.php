<?php require_once 'app/views/templates/headerMovie.php'?>
<h1>Review for <?= htmlspecialchars($data['movieName']) ?></h1>
<div class="card">
  <div class="card-body">
    <?= n12br(htmlspecialchars($data['review']))?>
</div>
</div>
<a href="/movie" class="btn btn-dark">Return to Search</a>
<?php require_once 'app/views/templates/footer.php'?>