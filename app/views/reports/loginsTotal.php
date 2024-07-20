<?php require_once 'app/views/templates/header.php' ?>
<div style="display: flex; align-items: center; justify-content: center;"> 
<h1>Total logins by username report</h1>
</div>
<div class="container">
<div class="row justify-content-center">
  <div class="col-lg-12">
    <table class="table">
      <thead>
      <tr>
        <th>Username</th>
        <th>Total logins</th>
      </tr>
      </thead>
    <tbody>
      <?php foreach ($data['logins'] as $login) { ?>
        <tr>
          <td><?= htmlspecialchars($login['username']) ?></td>
          <td><?= $login['login_count'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
    </table>
</div>
<div style="display: flex; justify-content: center;">
  <div style="width: 2000px; height 2000px;">
<canvas id="loginsTotalChart"></canvas>
  </div>
</div>
<script>
  const ctx = document.getElementById('loginsTotalChart');
  chart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: <?php echo json_encode(array_column($data['logins'], 'username')); ?>,
      datasets: [{
        label: 'Total Logins',
        data: <?php echo json_encode(array_column($data['logins'], 'login_count')); ?>,
        borderWidth: 1
      }]
    },
    options: {
      maintainAspectRatio: false,
      reponsive: true
    }
  });
</script>
<?php require_once 'app/views/templates/footer.php' ?>