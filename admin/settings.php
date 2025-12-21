<?php
session_start();
require_once('../dist/config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cleanup_profile_pics'])) {

  $dir = __DIR__ . '/../dist/assets/images/profilepics/';

  // Fetch all profile pics in use
  $stmt = $pdo->query("SELECT profile_pic FROM users WHERE profile_pic IS NOT NULL");
  $usedImages = $stmt->fetchAll(PDO::FETCH_COLUMN);

  $files = scandir($dir);
  $deleted = 0;

  foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;

    if (!in_array($file, $usedImages)) {
      if (unlink($dir . $file)) {
        $deleted++;
      }
    }
  }

  $_SESSION['success'] = "$deleted unused profile pictures deleted.";
  header("Location: settings.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Settings | Afyako</title>
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

          <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($_SESSION['error']) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
          <?php endif; ?>

          <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($_SESSION['success']) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
          <?php endif; ?>



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
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">General Settings</h4>
                  <p class="card-description">Update system and account settings</p>

                  <form>
                    <!-- Site Name -->
                    <div class="mb-3">
                      <label for="siteName" class="form-label">Site Name</label>
                      <input type="text" class="form-control" id="siteName" placeholder="Enter site name" value="Afyako">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                      <label for="adminEmail" class="form-label">Admin Email</label>
                      <input type="email" class="form-control" id="adminEmail" placeholder="Enter admin email" value="support@afyako.com">
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                      <label for="phone" class="form-label">Phone</label>
                      <input type="text" class="form-control" id="phone" placeholder="Enter phone number" value="+254 728 407 599">
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                      <label for="address" class="form-label">Address</label>
                      <textarea class="form-control" id="address" rows="2">Nairobi, Kenya</textarea>
                    </div>

                    <!-- Currency -->
                    <div class="mb-3">
                      <label for="currency" class="form-label">Currency</label>
                      <select class="form-select" id="currency">
                        <option selected>KES</option>
                        <option>USD</option>
                        <option>EUR</option>
                      </select>
                    </div>

                    <!-- Default Payment Method -->
                    <div class="mb-3">
                      <label for="defaultPayment" class="form-label">Default Payment Method</label>
                      <select class="form-select" id="defaultPayment">
                        <option selected>Mpesa</option>
                        <option>Cash</option>
                        <option>Bank Transfer</option>
                      </select>
                    </div>

                    <!-- Enable Notifications -->
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" id="notifications" checked>
                      <label class="form-check-label" for="notifications">
                        Enable notifications
                      </label>
                    </div>

                    <!-- Buttons -->
                    <div class="text-end">
                      <button type="reset" class="btn btn-light">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <form action="cleanup-profile-pics.php" method="POST"
            onsubmit="return confirm('Delete unused profile pictures? This action cannot be undone.')">
            <button type="submit" class="btn btn-danger">
              Delete Unused Profile Pictures
            </button>
          </form>

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