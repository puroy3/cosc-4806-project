<?php
if (isset($_SESSION['auth']) == 1) {
    header('Location: /home');
}
  require_once 'app/views/components/breadcrumb.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="/favicon.png">
    <title>COSC 4806</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">COSC 4806</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/Login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/create">Signup</a>
            </li>
        </div>
      </div>
    </nav>
<div class="container">
  <?php
  $itemsForBreadcrumb = [
      ['title' => 'Home', 'link' => '/']
  ];
  if ($_SESSION['controller'] !== 'home') {
      $itemsForBreadcrumb[] = ['title' => ucfirst($_SESSION['controller']), 'link' => '#'];
}
breadCrumb($itemsForBreadcrumb);
?>
</div>
<main class="container">