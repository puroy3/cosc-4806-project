<?php require_once 'app/views/templates/headerMovie.php'?>
<?php if (isset($data['movie']) && is_array($data['movie'])): ?>
<h1><?= htmlspecialchars($data['movie']['Title'])?> (<?= htmlspecialchars($data['movie']['Year']) ?>)</h1>
<div class="row">
  <div class="col-md-3">
    <img src="<?= htmlspecialchars($data['movie']['Poster'])?>" alt="Movie Poster" class="img-fluid">
</div>
  <div class="col-md-7">
    <p>Year: <?= htmlspecialchars($data['movie']['Year'])?></p>
    <p>Released:</p> <?= htmlspecialchars($data['movie']['Released'])?></p>
    <p>Director: <?= htmlspecialchars($data['movie']['Director'])?></p>
    <p>Writer:</p> <?= htmlspecialchars($data['movie']['Writer'])?></p>
    <p>Actors:</p> <?= htmlspecialchars($data['movie']['Actors'])?></p>
    <p>Rated:</p> <?= htmlspecialchars($data['movie']['Rated'])?></p>
    <p>Runtime:</p> <?= htmlspecialchars($data['movie']['Runtime'])?></p
    <p>Genre:</p> <?= htmlspecialchars($data['movie']['Genre'])?></p>
    <p>Countries:</p> <?= htmlspecialchars($data['movie']['Country'])?></p>
    <p>Language:</p> <?= htmlspecialchars($data['movie']['Language'])?></p>
    <p>Awards:</p> <?= htmlspecialchars($data['movie']['Awards'])?></p>
    <p>Box Office: <?= htmlspecialchars($data['movie']['BoxOffice']) ?></p>
    <p>Plot Summary: <?= htmlspecialchars($data['movie']['Plot'])?></p>
    <h3>Ratings</h3>
    <?php if (isset($data['movie']['Ratings']) && is_array($data['movie']['Ratings'])): ?>
      <ul>
        <?php foreach ($data['movie']['Ratings'] as $rating): ?>
          <li><?= htmlspecialchars($rating['Source']) ?>: <?= htmlspecialchars($rating['Value']) ?></li>
        <?php endforeach; ?>
      </ul>
  <?php endif; ?>
  </div>
</div>
<?php if (isset($_SESSION['auth'])): ?>
<h2>Rate this movie</h2>
<form action="/movie/rate" method="POST">
  <input type="hidden" name="movie_name" value="<?= htmlspecialchars($data['movie']['Title'])?>">
      <select class="form-select" name="rating" required>
        <option value="">Select rating</option>
        <option value="1">1 Star</option>
        <option value="2">2 Stars</option>
        <option value="3">3 Stars</option>
        <option value="4">4 Stars</option>
        <option value="5">5 Stars</option>
      </select>
  <br>
  <button type="submit" class="btn btn-dark">Submit Rating</button>
</form>
<?php else: ?>
  <p><a href="/login">Login</a> to rate movies.</p>
<?php endif; ?>
<br>
<h2>Get an AI-generated Review</h2>
<form action="/movie/review" method="POST">
    <input name="movie_name" type="hidden" value="<?= htmlspecialchars($data['movie']['Title'])?>">
    <div class="form-group">
      <label for="review-rating">Rating for Review:</label>
      <select class="form-select" name="rating" id="review-rating" required>
        <option value="">Select rating</option>
        <option value="1">1 Star</option>
        <option value="2">2 Stars</option>
        <option value="3">3 Stars</option>
        <option value="4">4 Stars</option>
        <option value="5">5 Stars</option>
      </select>
    </div>
    <br>
    <button type="submit" class="btn btn-dark">Get a Review</button>
</form>
  <?php else: ?>
    <p>No data is available for this movie.</p>
  <?php endif; ?>
<?php require_once 'app/views/templates/footer.php'?>