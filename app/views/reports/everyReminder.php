<?php require_once 'app/views/templates/header.php' ?>
<div style="display: flex; align-items: center; justify-content: center;"> 
<h1>All reminders report</h1>
</div>
<table class="table">
  <thead>
    <tr>
      <th>Username</th>
      <th>Subject</th>
      <th>Created At</th>
      <th>Completed</th>
      <th>Deleted</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['reminders'] as $reminder) { ?>
    <tr>
      <td><?= htmlspecialchars($reminder['username']) ?></td>
      <td><?= htmlspecialchars($reminder['subject']) ?></td>
      <td><?= htmlspecialchars($reminder['created_at']) ?></td>
      <td>
        <?php if ($reminder['completed']): ?>
          <span class="badge bg-success">Complete</span>
        <?php else: ?>
          <span class="badge bg-warning text-dark">Incomplete</span>
        <?php endif; ?>
      </td>
      <td>
        <?php if ($reminder['deleted']): ?>
          <span class="badge bg-danger">Deleted</span>
        <?php else: ?>
          <span class="badge bg-success">Active</span>
        <?php endif; ?>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php require_once 'app/views/templates/footer.php' ?>