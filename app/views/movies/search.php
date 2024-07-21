<?php require_once 'app/views/templates/headerMovie.php'?>
<h1>Search for a Movie</h1>
<form action="/movies/search" method="POST">
  <div>
    <input name="title" class="form-control" type="text" required>
  </div>
  <button type="submit" class="btn btn-dark">Search</button>
</form>
<?php require_once 'app/views/templates/footer.php'?>