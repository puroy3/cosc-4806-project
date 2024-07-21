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
}