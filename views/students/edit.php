<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Edit Student</h2>
<?php if (!empty($errors)): ?>
  <div class="alert alert-danger"><ul class="mb-0"><?php foreach($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul></div>
<?php endif; ?>
<form method="POST" onsubmit="return validateStudent()" class="col-md-6">
  <div class="mb-3"><label class="form-label">Name</label>
    <input type="text" name="name" id="name" class="form-control"
           value="<?= htmlspecialchars($student['name']) ?>" required></div>
  <div class="mb-3"><label class="form-label">IC</label>
    <input type="text" name="ic" id="ic" class="form-control"
           value="<?= htmlspecialchars($student['ic']) ?>" required></div>
  <div class="mb-3"><label class="form-label">Marks</label>
    <input type="number" name="marks" id="marks" class="form-control"
           value="<?= $student['marks'] ?>" min="0" max="100" required></div>
  <button class="btn btn-primary">Update</button>
  <a href="index.php?page=students" class="btn btn-secondary">Cancel</a>
</form>
<?php require __DIR__ . '/../layouts/footer.php'; ?>