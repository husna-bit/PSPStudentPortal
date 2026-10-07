<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Change Password</h2>
<?php if ($message): ?>
  <div class="alert alert-<?= $messageType ?>"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
<form method="POST" onsubmit="return validatePassword()" class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Old Password</label>
    <div class="input-group">
      <input type="password" name="old_password" id="old_password" class="form-control" required>
      <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('old_password', this)">
        <i class="bi bi-eye"></i>
      </button>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">New Password</label>
    <div class="input-group">
      <input type="password" name="new_password" id="new_password" class="form-control" required>
      <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password', this)">
        <i class="bi bi-eye"></i>
      </button>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <div class="input-group">
      <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
      <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password', this)">
        <i class="bi bi-eye"></i>
      </button>
    </div>
  </div>
  <button class="btn btn-primary">Update Password</button>
</form>
<?php require __DIR__ . '/../layouts/footer.php'; ?>