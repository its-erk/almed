<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Products List | Afyako</title>
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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <!-- Header -->
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                      <h4 class="card-title">Products</h4>
                      <p class="card-description">Manage available products</p>
                    </div>

                    <a href="add-product.php" class="btn btn-primary btn-sm rounded-pill">
                      <i class="ti-plus me-1"></i> Add Product
                    </a>
                  </div>

                  <!-- Table -->
                  <div class="table-responsive">
                    <table class="table table-hover align-middle">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Product</th>
                          <th>SKU</th>
                          <th>Category</th>
                          <th>Price (KES)</th>
                          <th>Stock</th>
                          <th>Status</th>
                          <th class="text-end">Actions</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>
                            <strong>Digital Glucometer</strong><br>
                            <small class="text-muted">Accurate blood sugar monitoring</small>
                          </td>
                          <td>GLU-001</td>
                          <td>Monitoring</td>
                          <td>2,999</td>
                          <td>
                            <span class="text-success fw-bold">45</span>
                          </td>
                          <td>
                            <span class="badge bg-success">Active</span>
                          </td>
                          <td class="text-end">
                            <a href="edit-product.php?id=1" class="btn btn-sm btn-outline-primary">Edit</a>
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                          </td>
                        </tr>

                        <tr>
                          <td>2</td>
                          <td>
                            <strong>BP Monitor</strong><br>
                            <small class="text-muted">Automatic blood pressure monitor</small>
                          </td>
                          <td>BP-002</td>
                          <td>Monitoring</td>
                          <td>2,499</td>
                          <td>
                            <span class="text-danger fw-bold">5</span>
                          </td>
                          <td>
                            <span class="badge bg-warning text-dark">Low Stock</span>
                          </td>
                          <td class="text-end">
                            <a href="edit-product.php?id=2" class="btn btn-sm btn-outline-primary">Edit</a>
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
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