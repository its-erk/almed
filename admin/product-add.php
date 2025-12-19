<?php
session_start();
require_once('../dist/config.php');

// Admin only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name        = trim($_POST['name'] ?? '');
  $category_id = (int)($_POST['category_id'] ?? 0);
  $price       = (float)($_POST['price'] ?? 0);
  $stock       = (int)($_POST['stock'] ?? 0);
  $status      = $_POST['status'] ?? 'active';
  $description = trim($_POST['description'] ?? '');

    // ---------- Validation ----------
  if ($name === '') {
    $error = "Product name is required.";
  } elseif ($category_id <= 0) {
    $error = "Please select a valid category.";
  } elseif ($price <= 0) {
    $error = "Invalid product price.";
  } elseif ($stock < 0) {
    $error = "Invalid stock quantity.";
  } elseif (!in_array($status, ['active', 'inactive'])) {
    $error = "Invalid status selected.";
  }

    // ---------- Fetch Category Code ----------
  if (!$error) {
    $catStmt = $pdo->prepare("
      SELECT code 
      FROM categories 
      WHERE id = :id AND status = 'active'
      LIMIT 1
      ");
    $catStmt->execute(['id' => $category_id]);
    $category = $catStmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
      $error = "Invalid or inactive category selected.";
    }
  }

    // ---------- Generate SKU ----------
  if (!$error) {
    $prefix = strtoupper($category['code']);

    $skuStmt = $pdo->prepare("
      SELECT sku 
      FROM products 
      WHERE sku LIKE :prefix
      ORDER BY id DESC
      LIMIT 1
      ");
    $skuStmt->execute(['prefix' => $prefix . '-%']);
    $lastSku = $skuStmt->fetchColumn();

    $next = $lastSku
    ? ((int)substr($lastSku, strrpos($lastSku, '-') + 1) + 1)
    : 1;

    $sku = sprintf('%s-%04d', $prefix, $next);
  }

  // ---------- Image Upload ----------
  $imageName = null;

  if (!empty($_FILES['image']['name'])) {
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
      $error = "Invalid image format. JPG, PNG, or WEBP only.";
    } elseif ($_FILES['image']['size'] > 2 * 1024 * 1024) {
      $error = "Image size must be less than 2MB.";
    } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
      $error = "Upload error code: " . $_FILES['image']['error'];
    } else {
        // Correct upload directory
      $uploadDir = __DIR__ . '/../dist/assets/images/products/';

        // Ensure directory exists
      if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
          $error = "Failed to create upload directory. Check server permissions.";
        }
      }

      if (!$error) {
        $imageName = uniqid('product_', true) . '.' . $ext;
        $uploadPath = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
          $error = "Failed to move uploaded file. Check folder permissions.";
        }
      }
    }
  }

  // ---------- Insert Product ----------
  if (!$error) {
    try {
      $stmt = $pdo->prepare("
        INSERT INTO products
        (name, sku, category_id, price, stock, status, description, image)
        VALUES
        (:name, :sku, :category_id, :price, :stock, :status, :description, :image)
        ");

      $stmt->execute([
        'name'        => $name,
        'sku'         => $sku,
        'category_id' => $category_id,
        'price'       => $price,
        'stock'       => $stock,
        'status'      => $status,
        'description' => $description,
        'image'       => $imageName
      ]);

      $success = "Product added successfully.";
    } catch (PDOException $e) {
      error_log("Product insert error: " . $e->getMessage());
      $error = "Database error occurred.";
    }
  }
}


// Fetch active categories
try {
  $stmt = $pdo->prepare("
    SELECT id, name 
    FROM categories 
    WHERE status = 'active'
    ORDER BY name ASC
    ");
  $stmt->execute();
  $categories = $stmt->fetchAll();
} catch (PDOException $e) {
  error_log("Failed to fetch categories: " . $e->getMessage());
  $categories = [];
}
?>

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

          <!-- Alerts -->
          <?php if(!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($error) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php elseif(!empty($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($success) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
          
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <h4 class="card-title">Add New Product</h4>
                  <p class="card-description">Fill in the product details below</p>

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">

                    <!-- Product Name -->
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" name="name" class="form-control" placeholder="e.g. Digital Glucometer" required>
                    </div>

                    <!-- SKU + Category -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Category</label>
                          <select name="category_id" id="categorySelect" class="form-select" required>
                            <option value="">Select category</option>

                            <?php foreach ($categories as $category): ?>
                              <option value="<?= (int)$category['id'] ?>">
                                <?= htmlspecialchars($category['name']) ?>
                              </option>
                            <?php endforeach; ?>

                          </select>
                        </div>

                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>SKU</label>
                          <input type="text" id="skuPreview" class="form-control" placeholder="Auto-generated" readonly>
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
                    <!-- <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                      </select>
                    </div> -->

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
                    <button type="reset" class="btn btn-light me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                    
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
  <script src="../dist/assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../dist/assets/vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../dist/assets/js/off-canvas.js"></script>
  <script src="../dist/assets/js/template.js"></script>
  <script src="../dist/assets/js/settings.js"></script>
  <script src="../dist/assets/js/hoverable-collapse.js"></script>
  <script src="../dist/assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../dist/assets/js/file-upload.js"></script>
  <script src="../dist/assets/js/typeahead.js"></script>
  <script src="../dist/assets/js/select2.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script>
    document.getElementById('categorySelect').addEventListener('change', function () {
      const categoryId = this.value;
      const skuInput = document.getElementById('skuPreview');

      skuInput.value = '';

      if (!categoryId) return;

      fetch('../ajax/preview-sku.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'category_id=' + encodeURIComponent(categoryId)
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          skuInput.value = data.sku;
        } else {
          skuInput.value = '—';
          console.error(data.message);
        }
      })
      .catch(() => {
        skuInput.value = 'Error';
      });
    });
  </script>

  <!-- End custom js for this page-->
</body>
</html>