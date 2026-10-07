<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card shadow">
      <div class="card-body">
        <h3 class="mb-3">Login</h3>
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" onsubmit="return validateLogin()" autocomplete="off">
          <div class="mb-3">
            <label class="form-label">NRIC</label>
            <input type="text" name="nric" id="nric" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
              <input type="password" name="password" id="password" class="form-control" required>
              <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>
          <button class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>