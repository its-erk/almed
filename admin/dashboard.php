<?php
session_start();
require_once('../dist/config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

// Fetch product summaries
$totalProducts     = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$activeProducts    = $pdo->query("SELECT COUNT(*) FROM products WHERE status='active'")->fetchColumn();
$inactiveProducts  = $pdo->query("SELECT COUNT(*) FROM products WHERE status='inactive'")->fetchColumn();
$lowStockProducts  = $pdo->query("SELECT COUNT(*) FROM products WHERE stock < 10")->fetchColumn();
$totalStock        = $pdo->query("SELECT SUM(stock) FROM products")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard | Afyako</title>
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
            <!-- Products Card -->
            <div class="col-3 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <h4 class="card-title">Products</h4>
                  <ul class="list-group list-group-flush mt-3">

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-cube-outline text-primary me-2"></i>Total Products</span>
                      <span class="badge bg-primary rounded-pill"><?= $totalProducts ?></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-check-circle-outline text-success me-2"></i>Active Products</span>
                      <span class="badge bg-success rounded-pill"><?= $activeProducts ?></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-close-circle-outline text-danger me-2"></i>Inactive Products</span>
                      <span class="badge bg-danger rounded-pill"><?= $inactiveProducts ?></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-alert-circle-outline text-warning me-2"></i>Low Stock</span>
                      <span class="badge bg-warning text-dark rounded-pill"><?= $lowStockProducts ?></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-warehouse text-info me-2"></i>Total Stock</span>
                      <span class="badge bg-info rounded-pill"><?= $totalStock ?></span>
                    </li>

                  </ul>
                </div>
              </div>
            </div>

            <!-- Orders Card -->
            <div class="col-3 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <h4 class="card-title">Orders</h4>
                  <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-cart-outline text-primary me-2"></i>Total Orders</span>
                      <span class="badge bg-primary rounded-pill">75</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-check-circle-outline text-success me-2"></i>Completed</span>
                      <span class="badge bg-success rounded-pill">60</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-clock-outline text-warning me-2"></i>Pending</span>
                      <span class="badge bg-warning text-dark rounded-pill">15</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Customers Card -->
            <div class="col-3 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <h4 class="card-title">Customers</h4>
                  <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-account-outline text-primary me-2"></i>Total Customers</span>
                      <span class="badge bg-primary rounded-pill">50</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-check-circle-outline text-success me-2"></i>Active</span>
                      <span class="badge bg-success rounded-pill">45</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-close-circle-outline text-danger me-2"></i>Inactive</span>
                      <span class="badge bg-danger rounded-pill">5</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Payments Card -->
            <div class="col-3 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <h4 class="card-title">Payments</h4>
                  <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-cash-multiple text-primary me-2"></i>Total Payments</span>
                      <span class="badge bg-primary rounded-pill">85</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-check-circle-outline text-success me-2"></i>Completed</span>
                      <span class="badge bg-success rounded-pill">70</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><i class="mdi mdi-alert-circle-outline text-warning me-2"></i>Pending</span>
                      <span class="badge bg-warning text-dark rounded-pill">15</span>
                    </li>
                  </ul>
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