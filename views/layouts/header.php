<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PSP Student Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="index.php?page=profile">🎓 PSP Portal</a>
    <div class="navbar-nav ms-auto">
      <?php if (isset($_SESSION['user_id'])): ?>
        <a class="nav-link" href="index.php?page=profile">Profile</a>
        <a class="nav-link" href="index.php?page=students">Students</a>
        <a class="nav-link" href="index.php?page=password">Change Password</a>
        <a class="nav-link text-warning" href="index.php?page=logout">Logout</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<main class="container my-4">