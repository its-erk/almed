<?php
session_start();
require_once('../dist/config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$userId = $_GET['id'] ?? null;
if (!$userId || !is_numeric($userId)) {
  header('Location: users.php');
  exit();
}

$error = '';
$success = '';

/* Fetch user */
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  header('Location: users.php');
  exit();
}

/* Fetch roles */
$roles = $pdo->query("SELECT id, role_name FROM roles WHERE status='Active' ORDER BY role_name")->fetchAll(PDO::FETCH_ASSOC);

/* Handle update */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $fullName = trim($_POST['fullName']);
  $username = trim($_POST['username']);
  $email    = trim($_POST['email']);
  $role_id  = $_POST['role'] ?? null;
  $status   = $_POST['status'] ?? 'Active';
  $password = $_POST['password'] ?? '';
  $confirm  = $_POST['confirmPassword'] ?? '';

  if (!$fullName || !$username || !$email || !$role_id) {
    $error = "Required fields missing.";
  }

  /* Password (optional) */
  if (!$error && $password !== '') {
    if ($password !== $confirm) {
      $error = "Passwords do not match.";
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }
  }

  /* Profile picture (optional) */
  $profilePic = $user['profile_pic'];

  if (!$error && !empty($_FILES['profilePic']['name'])) {

    $allowed = ['jpg','jpeg','png','webp'];
    $ext = strtolower(pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
      $error = "Invalid image format.";
    } else {
      $uploadDir = __DIR__ . '/../dist/assets/images/profilepics/';
      if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

      $profilePic = uniqid('user_', true) . '.' . $ext;
      move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadDir . $profilePic);
    }
  }

  /* Update */
  if (!$error) {

    $sql = "UPDATE users SET 
    full_name=?, username=?, email=?, role_id=?, status=?, profile_pic=?";

    $params = [$fullName, $username, $email, $role_id, $status, $profilePic];

    if (!empty($hashedPassword)) {
      $sql .= ", password=?";
      $params[] = $hashedPassword;
    }

    $sql .= " WHERE id=?";
    $params[] = $userId;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $success = "User updated successfully.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit User: <?= htmlspecialchars($user['full_name']) ?> | Afyako</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../dist/assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="../dist/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../dist/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../dist/assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../dist/assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../dist/assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../dist/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../dist/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../dist/assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../dist/assets/images/favicon.ico" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:ui/_navbar.html -->
    <?php include 'ui/navbar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:ui/_sidebar.html -->
      <?php include 'ui/sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <!-- Alerts -->
          <?php if(!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($error) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php elseif(!empty($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($success) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit User: <?= htmlspecialchars($user['full_name']) ?></h4>
                  <p class="card-description">Update user details below</p>

                  <form method="POST" enctype="multipart/form-data">

                    <div class="form-group mb-3">
                      <label>Full Name</label>
                      <input type="text" name="fullName" class="form-control"
                      value="<?= htmlspecialchars($user['full_name']) ?>" required>
                    </div>

                    <div class="form-group mb-3">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control"
                      value="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>

                    <div class="form-group mb-3">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control"
                      value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>

                    <div class="form-group mb-3">
                      <label>Role</label>
                      <select name="role" class="form-select" required>
                        <?php foreach ($roles as $role): ?>
                          <option value="<?= $role['id'] ?>"
                            <?= $role['id'] == $user['role_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['role_name']) ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="form-group mb-3">
                      <label>Status</label>
                      <select name="status" class="form-select">
                        <option value="Active" <?= $user['status']=='Active'?'selected':'' ?>>Active</option>
                        <option value="Inactive" <?= $user['status']=='Inactive'?'selected':'' ?>>Inactive</option>
                      </select>
                    </div>

                    <div class="form-group mb-3">
                      <label>New Password (leave blank to keep)</label>
                      <input type="password" name="password" class="form-control" placeholder="New Password">
                    </div>

                    <div class="form-group mb-3">
                      <label>Confirm Password</label>
                      <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password">
                    </div>

                    <div class="form-group mb-4">
                      <label>Profile Picture</label>
                      <input type="file" name="profilePic" class="file-upload-default">
                      <div class="input-group">
                        <input type="text" class="form-control file-upload-info" value="<?= htmlspecialchars($user['profile_pic']) ?>" placeholder="Profile Picture" disabled>
                        <button class="btn btn-primary file-upload-browse" type="button">Upload</button>
                      </div>
                    </div>

                    <div class="d-flex gap-2">
                      <a href="users.php" class="btn btn-light">Cancel</a>
                      <button type="submit" class="btn btn-primary">Update User</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:ui/_footer.html -->
        <?php include 'ui/footer.php'; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../dist/assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../dist/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../dist/assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../dist/assets/vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../dist/assets/js/off-canvas.js"></script>
  <script src="../dist/assets/js/template.js"></script>
  <script src="../dist/assets/js/settings.js"></script>
  <script src="../dist/assets/js/hoverable-collapse.js"></script>
  <script src="../dist/assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../dist/assets/js/file-upload.js"></script>
  <script src="../dist/assets/js/typeahead.js"></script>
  <script src="../dist/assets/js/select2.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>
</html>