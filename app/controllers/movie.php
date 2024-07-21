<?php

class Movie extends Controller {
  public function __construct() {
    }
  public function index() {
    $this->view('movie/index', []);
  }

  public function search() {
    if(!isset($_REQUEST['movie'])) {
      $this->view('movie/index', ['error' => 'A movie title was not provided.']);
      return;
    }
    
    $omdb = $this->model('Omdb');

    $movie_title = $_REQUEST['movie'];
    $movie = $omdb->search_movie($movie_title);

    if(isset($movie['Response']) && $movie['Response'] === 'True' && $movie) {
      $this->view('movie/result', ['movie' => $movie]);
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
      $_SESSION['error'] = "Rating must be between 1 and 5, please try again.";
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
    header('Location: /movie/search?movie=' . urlencode($movie_name) . '/' . $rating);
    exit;
  }
    
    /*COSC Project
      movie[search...]
    [SEARCH BUTTON]
    */
    // Just a link, not a form. Grab barbie as parameter 1, and grab 1 as parameter 2, make sure that the number value is correct (not decimal, not a letter, not above 5, not below 1), put that into the database (username, session variable, movie name, and rating), the username is tracked by a session variable. Alternatively use bootstrap for getting reviews, could use a javascript library to get ratings.

  public function review() {
    // if rating isn't 1,2,3,4,5... etc.
    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /movie');
      exit;
    }
    $movie_title = $_POST['movie_name'] ?? '';
    $rating = $_POST['rating'] ?? '4';
    if (empty($movie_title)) {
      $_SESSION['error'] = "A movie title is required to generate a review.";
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