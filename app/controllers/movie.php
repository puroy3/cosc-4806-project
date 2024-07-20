<?php

class Movie extends Controller {

  public function index() {
    $this->view('movie/index');
  }

  public function search() {
    if(!isset($_REQUEST['movie'])) {
      // redirect to /movie
    }

    $api = $this->model('Api');

    $movie_title = $_REQUEST['movie'];
    $movie = $api->search_movie($movie_title);

    $this->view('movie/results', ['movie' => $movie]);

    COSC Project
      movie[search...]
    [SEARCH BUTTON]

    // Just a link, not a form. Grab barbie as parameter 1, and grab 1 as parameter 2, make sure that the number value is correct (not decimal, not a letter, not above 5, not below 1), put that into the database (username, session variable, movie name, and rating), the username is tracked by a session variable. Alternatively use bootstrap for getting reviews, could use a javascript library to get ratings.
    Barbie Rating: 1 (a href="/movie/review/barbie/1") 2 3 4 5
  }

  public function review($movie_title = '', $rating = '') {
    // if rating isn't 1,2,3,4,5... etc.
  }
}