<?php
session_start();
require_once('../dist/config.php');

// Check authentication and role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit();
}

$filter = $_GET['filter'] ?? 'total';

$where = '';
$params = [];

switch ($filter) {
  case 'active':
  $where = "WHERE p.status = ?";
  $params[] = 'active';
  break;

  case 'inactive':
  $where = "WHERE p.status = ?";
  $params[] = 'inactive';
  break;

  case 'low-stock':
  $where = "WHERE p.stock <= ?";
  $params[] = 5;
  break;

  case 'total':
  default:
    // no filter
  break;
}

// Fetch products with category name
$sql = "
SELECT 
p.id, p.name, p.sku, p.price, p.stock, p.status,
p.description, p.image,
c.name AS category_name
FROM products p
LEFT JOIN categories c ON c.id = p.category_id
$where
ORDER BY p.id ASC
";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

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
                      <p class="card-description">
                        <?php
                        echo match ($filter) {
                          'active'     => 'Showing active products',
                          'inactive'   => 'Showing inactive products',
                          'low-stock'  => 'Showing low stock products',
                          default      => 'Showing all products',
                        };
                        ?>
                      </p>

                    </div>

                    <a href="product-add.php" class="btn btn-primary btn-sm rounded-pill">
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
                        <?php foreach ($products as $index => $p): ?>
                          <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                              <div class="d-flex ">
                                <img src="../dist/assets/images/products/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                                <div>
                                  <h6><?= htmlspecialchars($p['name']) ?></h6>
                                  <p class="text-muted"><?= htmlspecialchars(strlen($p['description']) > 50 ? substr($p['description'], 0, 50) . '…' : $p['description']) ?></p>
                                </div>
                              </div>
                            </td>
                            <td><?= htmlspecialchars($p['sku']) ?></td>
                            <td><?= htmlspecialchars($p['category_name'] ?? '-') ?></td>
                            <td><?= number_format($p['price'], 0) ?></td>
                            <td>
                              <?php if ($p['stock'] <= 5): ?>
                                <span class="text-danger fw-bold"><?= $p['stock'] ?></span>
                              <?php else: ?>
                                <span class="text-success fw-bold"><?= $p['stock'] ?></span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($p['status'] === 'active'): ?>
                                <span class="badge bg-success">Active</span>
                              <?php else: ?>
                                <span class="badge bg-secondary">Inactive</span>
                              <?php endif; ?>
                            </td>
                            <td class="text-end">
                              <a href="product-edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                              <form action="product-delete.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this product?');">Delete</button>
                              </form>
                            </td>
                          </tr>
                        <?php endforeach; ?>
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