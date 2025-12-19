<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Categories | Afyako</title>
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

                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                      <h4 class="card-title">Categories</h4>
                      <p class="card-description">Product categories</p>
                    </div>

                    <button class="btn btn-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                      <i class="ti-plus me-1"></i> Add Category
                    </button>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Category Name</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th class="text-end">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td><strong>Monitoring Devices</strong></td>
                          <td>Blood pressure & glucose monitoring tools</td>
                          <td><span class="badge bg-success">Active</span></td>
                          <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary">Edit</button>
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                          </td>
                        </tr>

                        <tr>
                          <td>2</td>
                          <td><strong>Diagnostic Kits</strong></td>
                          <td>Rapid diagnostic and test kits</td>
                          <td><span class="badge bg-secondary">Inactive</span></td>
                          <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary">Edit</button>
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

          <!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form>

          <div class="form-group mb-3">
            <label>Category Name</label>
            <input type="text" class="form-control" placeholder="e.g. Monitoring Devices">
          </div>

          <div class="form-group mb-3">
            <label>Description</label>
            <textarea class="form-control" rows="3" placeholder="Short category description"></textarea>
          </div>

          <div class="form-group mb-3">
            <label>Status</label>
            <select class="form-select">
              <option>Active</option>
              <option>Inactive</option>
            </select>
          </div>

          <div class="text-end">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Category</button>
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