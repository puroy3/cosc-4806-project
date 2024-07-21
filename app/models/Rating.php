<?php
class Rating {
  public function saveRating($userId, $movieName, $rating) {
    $db = db_connect();
    $statement = $db->prepare("insert into ratings (user_id, movie_name, rating) values (:userId, :movieName, :rating)");
    $statement->execute();
  }
  public function getUserRatings($userId) {
    $db = db_connect();
    $statement = $db->prepare("select * from ratings where user_id = :userI");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
}