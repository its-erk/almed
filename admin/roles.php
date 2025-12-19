<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Roles | Afyako</title>
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
                    <h4 class="card-title">Roles & Permissions</h4>
                    <p class="card-description">Manage user roles and their access levels</p>
                  </div>

                  <a href="add-product.php" class="btn btn-primary btn-sm rounded-pill">
                    <i class="ti-plus me-1"></i> Add Role
                  </a>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                  <table class="table table-hover align-middle">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Description</th>
                        <th>Permissions</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Administrator</td>
                        <td>Full access to all modules</td>
                        <td>
                          Users, Orders, Products, Payments, Feedback
                        </td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td class="text-end">
                          <button class="btn btn-sm btn-outline-primary">Edit</button>
                        </td>
                      </tr>

                      <tr>
                        <td>2</td>
                        <td>Sales</td>
                        <td>Manage orders and customer interactions</td>
                        <td>
                          Orders, Payments, Customers
                        </td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td class="text-end">
                          <button class="btn btn-sm btn-outline-primary">Edit</button>
                        </td>
                      </tr>

                      <tr>
                        <td>3</td>
                        <td>Support</td>
                        <td>Handle customer feedback and inquiries</td>
                        <td>
                          Feedback, Customers
                        </td>
                        <td><span class="badge badge-warning">Limited</span></td>
                        <td class="text-end">
                          <button class="btn btn-sm btn-outline-primary">Edit</button>
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