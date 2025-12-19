<?php
session_start();
require_once('../dist/config.php');

// Check authentication and role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit();
}

// Fetch user details
try {
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
  $stmt->execute(['id' => $_SESSION['user_id']]);
  $user = $stmt->fetch();
  if (!$user) {
        // If somehow user not found, log out
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
  }
} catch (PDOException $e) {
  error_log("Profile fetch error: " . $e->getMessage());
  die("An internal error occurred.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profile | Afyako</title>
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
          <div class="row">

            <!-- Profile Card -->
            <div class="col-lg-4 grid-margin">
              <div class="card">
                <div class="card-body text-center">
                  <img src="../dist/assets/images/faces/face1.jpg" alt="profile" class="img-lg rounded-circle mb-3">
                  <h4 class="card-title"><?= htmlspecialchars($user['full_name'] ?: $user['username']) ?></h4>
                  <p class="text-muted"><?= ucfirst($user['role']) ?></p>
                  <a href="profile-edit.php" class="btn btn-primary btn-sm">Edit Profile</a>
                  <a href="change-password.php" class="btn btn-outline-secondary btn-sm">Change Password</a>
                </div>
              </div>
            </div>

            <!-- Account Details Card -->
            <div class="col-lg-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Account Details</h4>
                  <p class="card-description">Update your personal and contact information</p>

                  <form method="POST" action="profile-update.php">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
                      </div>

                      <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                      </div>

                      <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                      </div>

                      <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                      </div>

                      <div class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                      </div>

                      <div class="col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role">
                          <?php 
                          $roles = ['admin' => 'Administrator', 'user' => 'User', 'customer' => 'Customer'];
                          foreach ($roles as $key => $label): ?>
                            <option value="<?= $key ?>" <?= ($user['role'] === $key) ? 'selected' : '' ?>><?= $label ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                          <?php 
                          $statuses = ['active' => 'Active', 'inactive' => 'Inactive', 'suspended' => 'Suspended'];
                          foreach ($statuses as $key => $label): ?>
                            <option value="<?= $key ?>" <?= ($user['status'] === $key) ? 'selected' : '' ?>><?= $label ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                    </div>

                    <div class="mt-4 text-end">
                      <button type="reset" class="btn btn-light">Cancel</button>
                      <button type="submit" class="btn btn-primary">Update Profile</button>
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
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../dist/assets/js/off-canvas.js"></script>
  <script src="../dist/assets/js/template.js"></script>
  <script src="../dist/assets/js/settings.js"></script>
  <script src="../dist/assets/js/hoverable-collapse.js"></script>
  <script src="../dist/assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>
</html>