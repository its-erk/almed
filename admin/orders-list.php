<?php
session_start();
require_once('../dist/config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Orders List | Afyako</title>
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

      <h4 class="card-title">Orders</h4>
      <p class="card-description">Recent customer orders</p>

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Phone</th>
              <th>Total (KES)</th>
              <th>Payment</th>
              <th>Status</th>
              <th>Date</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>1</td>
              <td><strong>#ORD-1023</strong></td>
              <td>John Mwangi</td>
              <td>0723 456 789</td>
              <td>5,498</td>
              <td>
                <span class="badge badge-success">Paid</span>
              </td>
              <td>
                <span class="badge badge-warning">Processing</span>
              </td>
              <td>15 Mar 2025</td>
              <td class="text-end">
                <a href="view-order.php" class="btn btn-sm btn-outline-primary">View</a>
              </td>
            </tr>

            <tr>
              <td>2</td>
              <td><strong>#ORD-1022</strong></td>
              <td>Mary Wanjiku</td>
              <td>0711 234 567</td>
              <td>2,999</td>
              <td>
                <span class="badge badge-success">Paid</span>
              </td>
              <td>
                <span class="badge badge-success">Completed</span>
              </td>
              <td>14 Mar 2025</td>
              <td class="text-end">
                <a href="view-order.php" class="btn btn-sm btn-outline-primary">View</a>
              </td>
            </tr>

            <tr>
              <td>3</td>
              <td><strong>#ORD-1021</strong></td>
              <td>Peter Otieno</td>
              <td>0700 987 654</td>
              <td>7,200</td>
              <td>
                <span class="badge badge-danger">Unpaid</span>
              </td>
              <td>
                <span class="badge badge-danger">Pending</span>
              </td>
              <td>14 Mar 2025</td>
              <td class="text-end">
                <a href="view-order.php" class="btn btn-sm btn-outline-primary">View</a>
              </td>
            </tr>

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