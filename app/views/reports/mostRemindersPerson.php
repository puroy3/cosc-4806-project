<?php require_once 'app/views/templates/header.php' ?>
<div style="display: flex; align-items: center; justify-content: center;"> 
<h1>User with the most reminders report</h1>
</div>
<?php
$maximumReminders = 0;
$userWithTheMostReminders = null;
foreach ($data['users'] as $user) {
  if ($user['reminder_count'] > $maximumReminders) {
    $maximumReminders = $user['reminder_count'];
    $userWithTheMostReminders = $user;
  }
}
?>
<div style="display: flex; justify-content: center;">
  <h4>Most: <?= htmlspecialchars($userWithTheMostReminders['username']) ?> with <?= $userWithTheMostReminders['reminder_count'] ?> reminders</h4>
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <table class="table">
        <thead>
        <tr>
          <th>Username</th>
          <th>Number of Reminders</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach ($data['users'] as $user) { ?>
          <tr>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= $user['reminder_count'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
</div>
</div>
</div>
<br>
<div style="display: flex; justify-content: center;">
  <div style="width: 500px; height: 500px;">
    <canvas id="mostRemindersPersonChart"></canvas>
</div>
</div>
<script>
  const ctx = document.getElementById('mostRemindersPersonChart');
  chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode(array_column($data['users'], 'username')) ?>,
      datasets: [{
        label: 'Number of reminders',
        data: <?= json_encode(array_column($data['users'], 'reminder_count')) ?>,
        borderWidth: 1
          }]
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
        }
      });
    </script>
    <?php require_once 'app/views/templates/footer.php' ?>