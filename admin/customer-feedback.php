<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Feedback | Afyako</title>
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
                  <h4 class="card-title">Customer Feedback</h4>
                  <p class="card-description">Messages & reviews from customers</p>

                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Customer</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Rating</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Jane Doe</td>
                          <td>jane@mail.com</td>
                          <td>Late delivery</td>
                          <td>
                            <i class="mdi mdi-star text-warning"></i>
                            <i class="mdi mdi-star text-warning"></i>
                            <i class="mdi mdi-star-outline"></i>
                            <i class="mdi mdi-star-outline"></i>
                            <i class="mdi mdi-star-outline"></i>
                          </td>
                          <td>12 Dec 2025</td>
                          <td><label class="badge badge-warning">Pending</label></td>
                          <td>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewFeedbackModal">
                              View
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>

          </div>

          <!-- View  Feedback Modal -->
          <div class="modal fade" id="viewFeedbackModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Feedback Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <strong>Customer:</strong>
                      <p>Jane Doe</p>
                    </div>
                    <div class="col-md-6">
                      <strong>Email:</strong>
                      <p>jane@mail.com</p>
                    </div>
                  </div>

                  <div class="mb-3">
                    <strong>Subject:</strong>
                    <p>Late delivery</p>
                  </div>

                  <div class="mb-3">
                    <strong>Rating:</strong>
                    <p>
                      <i class="mdi mdi-star text-warning"></i>
                      <i class="mdi mdi-star text-warning"></i>
                      <i class="mdi mdi-star-outline"></i>
                      <i class="mdi mdi-star-outline"></i>
                      <i class="mdi mdi-star-outline"></i>
                    </p>
                  </div>

                  <div class="mb-3">
                    <strong>Message:</strong>
                    <p class="text-muted">
                      My order arrived later than expected. Please improve delivery timelines.
                    </p>
                  </div>

                  <div class="mb-3">
                    <strong>Status:</strong>
                    <select class="form-select">
                      <option selected>Pending</option>
                      <option>Resolved</option>
                      <option>Ignored</option>
                    </select>
                  </div>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary">Update Status</button>
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