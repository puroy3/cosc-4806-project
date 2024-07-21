<?php require_once 'app/views/templates/headerMovie.php'?>
<h1>Review for <?= htmlspecialchars($data['movie_title']) ?></h1>
<h2>Rating: <?= htmlspecialchars($data['rating']) ?>/5</h2>
<div class="card">
  <div class="card-body">
    <?= nl2br(htmlspecialchars($data['review']))?>
</div>
</div>

<?php require_once 'app/views/templates/footer.php'?>