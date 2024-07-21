<?php
class Rating {
  public function saveRating($userId, $movieName, $rating) {
    $db = db_connect();
    $statement = $db->prepare("insert into ratings (user_id, movie_name, rating) values (:userId, :movieName, :rating)");
    return $statement->execute([':userId' => $userId, ':movieName' => $movieName, ':rating' => $rating]);
  }
  public function getUserRatings($userId) {
    $db = db_connect();
    $statement = $db->prepare("select * from ratings where user_id = :userId");
    $statement->execute([':userId' => $userId]);
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
  public function getMovieRatings($movieName) {
    $db = db_connect();
    $statement = $db->prepare("select ratings.rating, users.username from ratings join users on ratings.user_id = users.id where movie_name = :movieName order by ratings.created_at desc");
    $statement->execute([':movieName' => $movieName]);
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
}