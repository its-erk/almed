<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{Customer} Details  | Afyako</title>
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
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                      <h4 class="card-title">Customer Details</h4>
                      <p class="card-description">John Mwangi</p>
                    </div>

                    <a href="customers-list.php" class="btn btn-light btn-sm">
                      <i class="ti-arrow-left"></i> Back to Customers
                    </a>
                  </div>

                  <!-- Customer Info -->
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <h6 class="fw-bold">Personal Information</h6>
                      <p class="mb-1"><strong>Name:</strong> John Mwangi</p>
                      <p class="mb-1"><strong>Phone:</strong> 0723 456 789</p>
                      <p class="mb-1"><strong>Email:</strong> john@example.com</p>
                      <p class="mb-0"><strong>Address:</strong> Nairobi, Kenya</p>
                    </div>

                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                      <h6 class="fw-bold">Account Summary</h6>
                      <p class="mb-1"><strong>Status:</strong>
                        <span class="badge badge-success">Active</span>
                      </p>
                      <p class="mb-1"><strong>Joined:</strong> 10 Feb 2025</p>
                      <p class="mb-0"><strong>Total Orders:</strong> 5</p>
                    </div>
                  </div>

                  <!-- Order Stats -->
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <div class="card border">
                        <div class="card-body text-center">
                          <h5 class="mb-1">KES 18,495</h5>
                          <small class="text-muted">Total Spent</small>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card border">
                        <div class="card-body text-center">
                          <h5 class="mb-1">5</h5>
                          <small class="text-muted">Orders Placed</small>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card border">
                        <div class="card-body text-center">
                          <h5 class="mb-1">3</h5>
                          <small class="text-muted">Completed Orders</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Customer Orders -->
                  <h5 class="mb-3">Order History</h5>

                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Order ID</th>
                          <th>Total (KES)</th>
                          <th>Status</th>
                          <th>Date</th>
                          <th class="text-end">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td><strong>#ORD-1023</strong></td>
                          <td>5,498</td>
                          <td><span class="badge badge-warning">Processing</span></td>
                          <td>15 Mar 2025</td>
                          <td class="text-end">
                            <a href="view-order.html" class="btn btn-sm btn-outline-primary">View</a>
                          </td>
                        </tr>

                        <tr>
                          <td>2</td>
                          <td><strong>#ORD-1022</strong></td>
                          <td>2,999</td>
                          <td><span class="badge badge-success">Completed</span></td>
                          <td>14 Mar 2025</td>
                          <td class="text-end">
                            <a href="view-order.html" class="btn btn-sm btn-outline-primary">View</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <!-- Actions -->
                  <div class="text-end mt-4">
                    <button class="btn btn-outline-warning btn-sm">Suspend Customer</button>
                    <button class="btn btn-outline-danger btn-sm">Delete Customer</button>
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