<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>View Order | Afyako</title>
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
                      <h4 class="card-title">Order Details</h4>
                      <p class="card-description">Order #ORD-1023</p>
                    </div>

                    <a href="orders-list.php" class="btn btn-light btn-sm">
                      <i class="ti-arrow-left"></i> Back to Orders
                    </a>
                  </div>

                  <!-- Order Summary -->
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <h6 class="fw-bold">Customer Information</h6>
                      <p class="mb-1"><strong>Name:</strong> John Mwangi</p>
                      <p class="mb-1"><strong>Phone:</strong> 0723 456 789</p>
                      <p class="mb-1"><strong>Email:</strong> john@example.com</p>
                      <p class="mb-0"><strong>Address:</strong> Nairobi, Kenya</p>
                    </div>

                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                      <h6 class="fw-bold">Order Info</h6>
                      <p class="mb-1"><strong>Order Date:</strong> 15 Mar 2025</p>
                      <p class="mb-1"><strong>Payment Status:</strong>
                        <span class="badge badge-success">Paid</span>
                      </p>
                      <p class="mb-1"><strong>Order Status:</strong>
                        <span class="badge badge-warning">Processing</span>
                      </p>
                    </div>
                  </div>

                  <!-- Products Table -->
                  <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Product</th>
                          <th>Price (KES)</th>
                          <th>Qty</th>
                          <th>Subtotal (KES)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Digital Glucometer</td>
                          <td>2,999</td>
                          <td>1</td>
                          <td>2,999</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>BP Monitor</td>
                          <td>2,499</td>
                          <td>1</td>
                          <td>2,499</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <!-- Order Totals -->
                  <div class="row justify-content-end">
                    <div class="col-md-5">
                      <table class="table">
                        <tr>
                          <th>Subtotal</th>
                          <td class="text-end">5,498</td>
                        </tr>
                        <tr>
                          <th>Delivery</th>
                          <td class="text-end">0</td>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <td class="text-end fw-bold">5,498</td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <!-- Actions -->
                  <div class="text-end mt-4">
                    <button class="btn btn-outline-primary btn-sm">Mark as Completed</button>
                    <button class="btn btn-outline-danger btn-sm">Cancel Order</button>
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