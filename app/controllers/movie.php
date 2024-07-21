<?php

class Movie extends Controller {
  public function __construct() {
    }
  public function index() {
    $this->view('movie/index');
  }

  public function search() {
    if(!isset($_REQUEST['movie'])) {
      $this->view('movie/index');
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
  public function rate($movie_title = '', $rating = '') {
    if(!isset($_SESSION['auth'])) {
      $_SESSION['redirect'] = "/movie/rate/$movie_title/$rating";
      header('Location: /login');
      exit;
    }
    if (!in_array($rating, ['1', '2', '3', '4', '5'])) {
      $_SESSION['error'] = "Rating must be between 1 and 5, please try again.";
      header('Location: /movie/search?movie=' . urlencode($movie_title));
      exit;
    }
    $user_id = $_SESSION['user_id'];
    $rating_model = $this->model('Rating');
    $rating_model->saveRating($user_id, $movie_title, $rating);
    $_SESSION['success'] = "The rating was saved successfully!";
    header('Location: /movie/review/' . urlencode($movie_title) . '/' . $rating);
    exit;
  }
    
    /*COSC Project
      movie[search...]
    [SEARCH BUTTON]
    */
    // Just a link, not a form. Grab barbie as parameter 1, and grab 1 as parameter 2, make sure that the number value is correct (not decimal, not a letter, not above 5, not below 1), put that into the database (username, session variable, movie name, and rating), the username is tracked by a session variable. Alternatively use bootstrap for getting reviews, could use a javascript library to get ratings.

  public function review($movie_title = '', $rating = '') {
    // if rating isn't 1,2,3,4,5... etc.
    if(!in_array($rating, ['1', '2', '3', '4', '5'])) {
      $_SESSION['error'] = "Rating must be between 1 and 5, please try again.";
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