<?php require_once 'app/views/templates/headerMovie.php'?>
<h1><?= htmlspecialchars($data['movie']['Title'])?></h1>
<img src="<?= htmlspecialchars($data['movie']['Poster'])?>" alt="Movie Poster" class="img-fluid">
<p>Year: <?= htmlspecialchars($data['movie']['Year']?></p>
<p>Director: <?= htmlspecialchars($data['movie']['Director']?></p>
<p>Plot Summary: <?= htmlspecialchars($data['movie']['Plot']?></p>
<h2>Rate this movie</h2>
<form action="/movies/rate" method="POST">
  <input name="movie_name" type="hidden" value="<?= htmlspecialchars($data['movie']['Title'])?>"
    <div>
      <select class="form-select" name="rating" required>
        <option value="">Select rating</option>
        <option value="1">1 Star</option>
        <option value="2">2 Stars</option>
        <option value="3">3 Stars</option>
        <option value="4">4 Stars</option>
        <option value="5">5 Stars</option>
      </select>
    </div>
  <button type="submit" class="btn btn-dark">Submit Rating</button>
</form>
<h2>Get Review</h2>
<form action="/movies/getReview" method="POST">
  <input name="movie_name" type="hidden" value="<?= htmlspecialchars($data['movie']['Title'])?>">
    <button type="submit" class="btn btn-dark">Get Review</button>
</form>
<?php require_once 'app/views/templates/footer.php'?>