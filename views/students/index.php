<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex justify-content-between mb-3">
  <h2>Student List</h2>
  <a href="index.php?page=student_create" class="btn btn-success">+ Add Student</a>
</div>

<?php if (isset($_GET['msg'])): ?>
  <div class="alert alert-info">Record <?= htmlspecialchars($_GET['msg']) ?> successfully.</div>
<?php endif; ?>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr><th>ID</th><th>Name</th><th>IC</th><th>Marks</th><th>Actions</th></tr>
  </thead>
  <tbody>
    <?php foreach ($students as $s): ?>
    <tr>
      <td><?= $s['id'] ?></td>
      <td><?= htmlspecialchars($s['name']) ?></td>
      <td><?= htmlspecialchars($s['ic']) ?></td>
      <td><?= $s['marks'] ?></td>
      <td>
        <a href="index.php?page=student_edit&id=<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="index.php?page=student_delete&id=<?= $s['id'] ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>