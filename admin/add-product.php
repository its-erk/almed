<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Add Product | Afyako</title>
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

                  <h4 class="card-title">Add New Product</h4>
                  <p class="card-description">Fill in the product details below</p>

                  <form class="forms-sample" method="POST" action="store-product.php" enctype="multipart/form-data">

                    <!-- Product Name -->
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" name="name" class="form-control" placeholder="e.g. Digital Glucometer" required>
                    </div>

                    <!-- SKU + Category -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>SKU</label>
                          <input type="text" name="sku" class="form-control" placeholder="GLU-001" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Category</label>
                          <select name="category" class="form-select" required>
                            <option value="">Select category</option>
                            <option value="Monitoring">Monitoring</option>
                            <option value="Diagnostics">Diagnostics</option>
                            <option value="Accessories">Accessories</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Price + Stock -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Price (KES)</label>
                          <input type="number" name="price" class="form-control" placeholder="2999" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Stock Quantity</label>
                          <input type="number" name="stock" class="form-control" placeholder="50" required>
                        </div>
                      </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                      </select>
                    </div>

                    <!-- Product Image -->
                    <div class="form-group">
                      <label>Product Image</label>
                      <input type="file" name="image" class="file-upload-default" accept="image/*">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload product image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                      <label>Product Description</label>
                      <textarea name="description" class="form-control" rows="4" placeholder="Short description of the product"></textarea>
                    </div>

                    <!-- Actions -->
                    <button type="submit" class="btn btn-primary me-2">Save Product</button>
                    <a href="products.php" class="btn btn-light">Cancel</a>

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