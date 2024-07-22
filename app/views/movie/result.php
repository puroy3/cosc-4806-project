<?php require_once 'app/views/templates/headerMovie.php'?>
<?php if (isset($data['movie']) && is_array($data['movie'])): ?>
<h1 class="text-center"><?= htmlspecialchars($data['movie']['Title'])?> (<?= htmlspecialchars($data['movie']['Year']) ?>)</h1>
<div class="row">
  <div class="col-md-3">
    <img src="<?= htmlspecialchars($data['movie']['Poster'])?>" alt="Movie Poster" class="img-fluid">
</div>
  <div class="col-md-7">
    <p>Year: <?= htmlspecialchars($data['movie']['Year'])?></p>
    <p>Released: <?= htmlspecialchars($data['movie']['Released'])?></p>
    <p>Director(s): <?= htmlspecialchars($data['movie']['Director'])?></p>
    <p>Writer(s): <?= htmlspecialchars($data['movie']['Writer'])?></p>
    <p>Actor(s): <?= htmlspecialchars($data['movie']['Actors'])?></p>
    <p>Rated: <?= htmlspecialchars($data['movie']['Rated'])?></p>
    <p>Runtime: <?= htmlspecialchars($data['movie']['Runtime'])?></p
    <p>Genre(s): <?= htmlspecialchars($data['movie']['Genre'])?></p>
    <p>Countries: <?= htmlspecialchars($data['movie']['Country'])?></p>
    <p>Language(s): <?= htmlspecialchars($data['movie']['Language'])?></p>
    <p>Award(s): <?= htmlspecialchars($data['movie']['Awards'])?></p>
    <p>Box Office Amount: <?= htmlspecialchars($data['movie']['BoxOffice']) ?></p>
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
<h3 class="text-center">User Ratings</h3>
<div class="container">
  <div class="row justify-content-center">
<?php if (!empty($data['user_ratings'])): ?>
  <ul class="list-group text-center">
    <?php foreach ($data['user_ratings'] as $rating): ?>
      <li class="list-group-item">
        <?= htmlspecialchars($rating['username'])?>: 
        <?= str_repeat('⭐', $rating['rating']) . str_repeat('☆', 5 - $rating['rating']) ?>
        (<?= $rating['rating'] ?>/5)
      </li>
    <?php endforeach; ?>
  </ul>
  <?php else: ?>
  <p class="text-center">No user ratings available.</p>
  <?php endif; ?>
  </div>
</div>
  <br>
  <div class="text-center">
  <p>Average User Rating:
  <?php
    if(!empty($data['user_ratings'])) {
      $average = array_sum(array_column($data['user_ratings'], 'rating')) / count($data['user_ratings']);
      echo number_format($average, 1) . '/5';
    }
    else {
      echo 'N/A';
    }
    ?>
  </p>
  </div>
<?php if (isset($_SESSION['auth'])): ?>
<h2 class="text-center">Rate this movie</h2>
<form action="/movie/rate" method="POST">
  <input type="hidden" name="movie_name" value="<?= htmlspecialchars($data['movie']['Title'])?>">
  <div class="btn-group d-flex justify-content-center" aria-label="Movie Rating" role="group">    
  <?php
  $ratings = [1 => '⭐☆☆☆☆ (1/5)', 2 => '⭐⭐☆☆☆ (2/5)', 3 => '⭐⭐⭐☆☆ (3/5)', 4 => '⭐⭐⭐⭐☆ (4/5)', 5 => '⭐⭐⭐⭐⭐ (5/5)'];
  foreach ($ratings as $value => $label):
  ?>
    <input type="radio" name="rating" class="btn-check" id="rating<?= $value ?>" value="<?= $value ?>" required>
    <label class="btn btn-outline-dark" for="rating<?= $value ?>"><?= $label ?></label>
    <?php endforeach; ?>
  </div>
  <br>
  <div class="text-center">
  <button type="submit" class="btn btn-dark">Submit Rating</button>
  </div>
</form>
<?php else: ?>
  <p class="text-center"><a href="/login">Login</a> to rate movies.</p>
<?php endif; ?>
<br>
<h2 class="text-center">Get an AI-generated Review</h2>
<form action="/movie/review" method="POST">
    <input name="movie_name" type="hidden" value="<?= htmlspecialchars($data['movie']['Title'])?>">
    <div class="form-group">
      <label for="review-rating">Rating for Review:</label>
      <select class="form-select" name="rating" id="review-rating" required>
        <option value="">Select a rating</option>
        <option value="1">⭐☆☆☆☆ (1/5)</option>
        <option value="2">⭐⭐☆☆☆ (2/5)</option>
        <option value="3">⭐⭐⭐☆☆ (3/5)</option>
        <option value="4">⭐⭐⭐⭐☆ (4/5)</option>
        <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
      </select>
    </div>
    <br>
    <div class="text-center">
    <button type="submit" class="btn btn-dark">Get a Review</button>
    </div>
</form>
  <?php else: ?>
    <p>No data is available for this movie.</p>
  <?php endif; ?>
<?php require_once 'app/views/templates/footer.php'?>