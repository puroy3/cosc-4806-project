<?php require_once 'app/views/templates/headerMovie.php'?>
<h1>Your Ratings</h1>
<table class="table">
  <thead>
    <tr>
      <th>Movie</th>
      <th>Rating</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['ratings'] as $rating) { ?>
        <tr>
          <td><?= htmlspecialchars($rating['movie_name']) ?></td>
          <td><?= htmlspecialchars($rating['rating']) ?>/5</td>
        </tr>
    <?php }; ?>
  </tbody>
</table>
<?php require_once 'app/views/templates/footer.php'?>