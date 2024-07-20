<?php
if (!isset($_SESSION['auth'])) {
    header('Location: /login');
}
  require_once 'app/views/components/breadcrumb.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <link rel="stylesheet" href="/css/styles.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="icon" href="/favicon.png">
        <title>COSC 4806</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
          <a class="nav-link active" aria-current="page" href="/home">Home</a>
        </li>
  <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reminders
        </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
      <li><a class="dropdown-item" href="/reminders">Reminders Page</a></li>
      <li><a class="dropdown-item" href="/reminders/create">Create Reminder</a></li>
  </ul>
  </li>                                         
        <li class="nav-item">
        <?php if ($_SESSION['is_admin'] == 1 && isset($_SESSION['is_admin'])) { ?>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reports
        </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
      <li><a class="dropdown-item" href="/reports">Reports Page</a></li>
      <li><a class="dropdown-item" href="/reports/everyReminder">All Reminders</a></li>
      <li><a class="dropdown-item" href="/reports/mostRemindersPerson">User with Most Reminders</a></li>
      <li><a class="dropdown-item" href="/reports/loginsTotal">Total Logins per user</a></li>
  </ul>
  </li>                                         
          <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="/logout">Logout</a>
        </li>
    </div>
  </div>
</nav>
<div class="container">
  <?php
  $itemsForBreadcrumb = [
    ['title' => 'Home', 'link' => '/home']
  ];
  if ($_SESSION['controller'] !== 'home') {
    $itemsForBreadcrumb[] = ['title' => ucfirst($_SESSION['controller']), 'link' => '/' . $_SESSION['controller']];
  }
    if ($_SESSION['method'] !== 'index' && isset($_SESSION['method'])) {
      $itemsForBreadcrumb[] = ['title' => ucfirst($_SESSION['method']), 'link' => '#'];
    }
      breadCrumb($itemsForBreadcrumb);
?>
</div>
<main class="container">