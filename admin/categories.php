<?php
session_start();
require_once('../dist/config.php');

// Only allow admin users
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $status = $_POST['status'] ?? 'active';
  $cat_id = $_POST['category_id'] ?? null;

  if (empty($name)) {
    $error = "Category name is required.";
  } elseif (!in_array($status, ['active', 'inactive'])) {
    $error = "Invalid status selected.";
  } else {
    try {
      if ($cat_id) {
                // Editing existing category
        $stmt = $pdo->prepare("UPDATE categories SET name = :name, description = :description, status = :status WHERE id = :id");
        $stmt->execute([
          'name' => $name,
          'description' => $description,
          'status' => $status,
          'id' => $cat_id
        ]);
        $success = "Category '$name' updated successfully!";
      } else {
                // Adding new category
        $stmt = $pdo->prepare("SELECT id FROM categories WHERE name = :name LIMIT 1");
        $stmt->execute(['name' => $name]);
        if ($stmt->fetch()) {
          $error = "Category with this name already exists.";
        } else {
          $insert = $pdo->prepare("
            INSERT INTO categories (name, description, status)
            VALUES (:name, :description, :status)
            ");
          $insert->execute([
            'name' => $name,
            'description' => $description,
            'status' => $status
          ]);
          $success = "Category '$name' added successfully!";
        }
      }
    } catch (PDOException $e) {
      error_log("Category error: " . $e->getMessage());
      $error = "An internal error occurred. Please try again later.";
    }
  }
}

// Fetch all categories
try {
  $stmt = $pdo->query("SELECT * FROM categories ORDER BY created_at DESC");
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                        <?php if (!empty($categories)): ?>
                          <?php foreach ($categories as $index => $cat): ?>
                            <tr>
                              <td><?= $index + 1 ?></td>
                              <td><strong><?= htmlspecialchars($cat['name']) ?></strong></td>
                              <td><?= htmlspecialchars($cat['description']) ?></td>
                              <td>
                                <?php if ($cat['status'] === 'active'): ?>
                                  <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                  <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                              </td>
                              <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary"
                                onclick="editCategory('<?= $cat['id'] ?>', '<?= htmlspecialchars($cat['name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($cat['description'], ENT_QUOTES) ?>', '<?= $cat['status'] ?>')">
                                Edit
                              </button>

                              <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="5" class="text-center">No categories found.</td>
                        </tr>
                      <?php endif; ?>
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
                <h5 class="modal-title" id="categoryModalTitle">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                <form method="POST">

                  <input type="hidden" name="category_id" class="form-control" id="category_id">

                  <div class="form-group mb-3">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Monitoring Devices" required>
                  </div>

                  <div class="form-group mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Short category description"></textarea>
                  </div>

                  <div class="form-group mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                      <option value="active">Active</option>
                      <option value="inactive">Inactive</option>
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
<!-- Frontend: Populate Modal with JS -->
<script>
  function editCategory(id = null, name = '', description = '', status = 'active') {
    const modalTitle = document.getElementById('categoryModalTitle');
    const modal = new bootstrap.Modal(document.getElementById('addCategoryModal'));

    if (id) {
        // Editing
      modalTitle.textContent = 'Edit Category';
      document.getElementById('category_id').value = id;
    } else {
        // Adding
      modalTitle.textContent = 'Add Category';
      document.getElementById('category_id').value = '';
    }

    // Fill form fields
    document.querySelector('input[name="name"]').value = name;
    document.querySelector('textarea[name="description"]').value = description;
    document.querySelector('select[name="status"]').value = status;

    modal.show();
  }
</script>
<!-- End custom js for this page-->
</body>
</html>