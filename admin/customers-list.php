<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Customers List | Afyako</title>
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

                  <h4 class="card-title">Customers</h4>
                  <p class="card-description">Registered customers</p>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Total Orders</th>
                          <th>Total Spent (KES)</th>
                          <th>Status</th>
                          <th>Joined</th>
                          <th class="text-end">Actions</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>
                            <strong>John Mwangi</strong>
                          </td>
                          <td>0723 456 789</td>
                          <td>john@example.com</td>
                          <td>5</td>
                          <td>18,495</td>
                          <td>
                            <span class="badge badge-success">Active</span>
                          </td>
                          <td>10 Feb 2025</td>
                          <td class="text-end">
                            <a href="view-customer.php" class="btn btn-sm btn-outline-primary">View</a>
                          </td>
                        </tr>

                        <tr>
                          <td>2</td>
                          <td>
                            <strong>Mary Wanjiku</strong>
                          </td>
                          <td>0711 234 567</td>
                          <td>mary@example.com</td>
                          <td>2</td>
                          <td>5,498</td>
                          <td>
                            <span class="badge badge-secondary">Inactive</span>
                          </td>
                          <td>05 Mar 2025</td>
                          <td class="text-end">
                            <a href="view-customer.php" class="btn btn-sm btn-outline-primary">View</a>
                          </td>
                        </tr>

                        <tr>
                          <td>3</td>
                          <td>
                            <strong>Peter Otieno</strong>
                          </td>
                          <td>0700 987 654</td>
                          <td>peter@example.com</td>
                          <td>1</td>
                          <td>7,200</td>
                          <td>
                            <span class="badge badge-warning">Suspended</span>
                          </td>
                          <td>01 Mar 2025</td>
                          <td class="text-end">
                            <a href="view-customer.php" class="btn btn-sm btn-outline-primary">View</a>
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