<?php
session_start();
require_once('../dist/config.php');

// Check authentication and role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit();
}

// Fetch all users
try {
  $stmt = $pdo->query("
    SELECT u.*, r.role_name 
    FROM users u
    LEFT JOIN roles r ON u.role_id = r.id
    ORDER BY u.created_at DESC
    ");
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  error_log("Failed to fetch users: " . $e->getMessage());
  $users = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Users List | Afyako</title>
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
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                 <!-- Header -->
                 <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <h4 class="card-title">Users</h4>
                    <p class="card-description">Registered system users</p>
                  </div>

                  <a href="user-add.php" class="btn btn-primary btn-sm rounded-pill">
                    <i class="ti-plus me-1"></i> Add User
                  </a>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                  <table class="table table-hover align-middle">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th class="text-end">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($users): ?>
                        <?php foreach ($users as $index => $user): ?>
                          <tr>
                            <td><?= $index + 1 ?></td>
                            <td><strong><?= htmlspecialchars($user['full_name'] ?: $user['username']) ?></strong></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['role_name'] ?? 'N/A') ?></td>
                            <td>
                              <?php
                              $statusClass = match($user['status'] ?? '') {
                                'active' => 'badge-success',
                                'inactive' => 'badge-secondary',
                                'suspended' => 'badge-danger',
                                default => 'badge-light'
                              };
                              ?>
                              <span class="badge <?= $statusClass ?>"><?= ucfirst($user['status'] ?? 'Unknown') ?></span>
                            </td>
                            <td><?= !empty($user['created_at']) ? date('d M Y', strtotime($user['created_at'])) : '-' ?></td>
                            <td class="text-end">
                              <a href="user-edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                              <a href="user-view.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="8" class="text-center">No users found.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>

                </div>

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