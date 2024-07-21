<?php require_once 'app/views/templates/headerMovie.php'?>
<?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<h1>Search for a Movie</h1>
<?php if (isset($data['error'])): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($data['error'])?></div>
<?php endif; ?>
<form action="/movie/search" method="POST">
  <div class="form-group">
    <input name="movie" class="form-control" type="text" required>
  </div>
  <br>
  <button type="submit" class="btn btn-dark">Search</button>
</form>
<?php require_once 'app/views/templates/footer.php'?>