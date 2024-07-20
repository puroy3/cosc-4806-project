<?php
class Reports extends Controller {
  public function __construct() {
    if (!isset($_SESSION['is_admin']) || !isset($_SESSION['auth']) || $_SESSION['auth'] != 1 || $_SESSION['is_admin'] != 1) {
      header('Location: /login');
      exit;
    }
  }
  public function index() {		
    $this->view('reports/index');
  }
  public function everyReminder() {
    $reminder = $this->model('Reminder');
    $reminders = $reminder->getEveryReminder();
    $this->view('reports/everyReminder', ['reminders' => $reminders]);
  }

  public function mostRemindersPerson() {
    $reminder = $this->model('Reminder');
    $users = $reminder->getUserMostReminders();
    $this->view('reports/mostRemindersPerson', ['users' => $users]);
  }

  public function loginsTotal() {
    $user = $this->model('User');
    $logins = $user->getLoginsTotal();
    $this->view('reports/loginsTotal', ['logins' => $logins]);
  }
}