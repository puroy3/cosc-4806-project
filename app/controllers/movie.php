<?php

class Movie extends Controller {
  public function __construct() {
    }
  public function index() {
    $this->view('movie/index', []);
  }

  public function search() {
    if(isset($_GET['movie']) && $_SERVER['REQUEST_METHOD'] === 'GET') {
      $movie_title = $_GET['movie'];
    }
    else if(isset($_POST['movie']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $movie_title = $_POST['movie'];
    }
    else {
      header('Location: /movie');
      exit;
    }  
    $omdb = $this->model('Omdb');
    $movie = $omdb->search_movie($movie_title);

    if(isset($movie['Response']) && $movie['Response'] === 'True' && $movie) {
      // Get the user ratings for the specific movie.
      $rating_model = $this->model('Rating');
      $user_ratings = $rating_model->getMovieRatings($movie['Title']);
      $this->view('movie/result', ['movie' => $movie, 'user_ratings' => $user_ratings]);
    }
    else {
      $this->view('movie/index', ['error' => 'The movie was not found']);
    }
  }
  public function rate() {
    if(!isset($_SESSION['auth'])) {
      $_SESSION['error'] = "Login to rate movies.";
      header('Location: /login');
      exit;
    }
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /movie');
      exit;
    }
    $movie_name = $_POST['movie_name'] ?? '';
    $rating = $_POST['rating'] ?? '';
    if (!in_array($rating, ['1', '2', '3', '4', '5']) || empty($movie_name) || empty($rating)) {
      $_SESSION['error'] = "Rating must be between 1 and 5, please try again. The movie name or rating cannot be blank.";
      header('Location: /movie');
      exit;
    }
    $user_id = $_SESSION['user_id'];
    $rating_model = $this->model('Rating');
    if ($rating_model->saveRating($user_id, $movie_name, $rating)) {
      $_SESSION['success'] = "The rating was saved successfully!";
    }
    else {
      $_SESSION['error'] = "The rating was not saved!";
    }
    header('Location: /movie');
    exit;
  }
    
    /*COSC Project
      movie[search...]
    [SEARCH BUTTON]
    */
    // Just a link, not a form. Grab barbie as parameter 1, and grab 1 as parameter 2, make sure that the number value is correct (not decimal, not a letter, not above 5, not below 1), put that into the database (username, session variable, movie name, and rating), the username is tracked by a session variable. Alternatively use bootstrap for getting reviews, could use a javascript library to get ratings.

  public function review() {
    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /movie');
      exit;
    }
    $movie_title = $_POST['movie_name'] ?? '';
    $rating = $_POST['rating'] ?? '';
    if (empty($movie_title) || !in_array($rating, ['1', '2', '3', '4', '5'])) {
      $_SESSION['error'] = "A movie title and rating is required to generate a review.";
      header('Location: /movie');
      exit;
    }
    $gemini = $this->model('Gemini');
    $review = $gemini->generate_review($movie_title, $rating);
    $this->view('movie/review', ['movie_title' => $movie_title, 'rating' => $rating, 'review' => $review]);
  }
  public function ratings() {
    if(!isset($_SESSION['auth'])) {
      header('Location: /login');
      exit;
    }
    $user_id = $_SESSION['user_id'] ?? 0;
    $rating_model = $this->model('Rating');
    $ratings = $rating_model->getUserRatings($user_id);
    $this->view('movie/ratings', ['ratings' => $ratings]);
  }
}