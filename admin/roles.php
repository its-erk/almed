<?php
session_start();
require_once('../dist/config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $role_id = $_POST['role_id'] ?? null;
  $role_name = trim($_POST['role_name'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $permissions = $_POST['permissions'] ?? [];
  $status = $_POST['status'] ?? 'active';

  if (empty($role_name)) {
    $error = "Role name is required.";
  } elseif (!in_array($status, ['active', 'inactive'])) {
    $error = "Invalid status selected.";
  } elseif (empty($permissions)) {
    $error = "Select at least one permission.";
  } else {
    try {
      $permissions_csv = implode(',', $permissions);

      if ($role_id) {
                // Update existing role
        $stmt = $pdo->prepare("UPDATE roles SET role_name = :role_name, description = :description, permissions = :permissions, status = :status WHERE id = :id");
        $stmt->execute([
          'role_name' => $role_name,
          'description' => $description,
          'permissions' => $permissions_csv,
          'status' => $status,
          'id' => $role_id
        ]);
        $success = "Role '$role_name' updated successfully!";
      } else {
        // Check for duplicate role name
        $stmt = $pdo->prepare("SELECT id FROM roles WHERE role_name = :role_name LIMIT 1");
        $stmt->execute(['role_name' => $role_name]);
        if ($stmt->fetch()) {
          $error = "Role with this name already exists.";
        } else {
          $stmt = $pdo->prepare("INSERT INTO roles (role_name, description, permissions, status) VALUES (:role_name, :description, :permissions, :status)");
          $stmt->execute([
            'role_name' => $role_name,
            'description' => $description,
            'permissions' => $permissions_csv,
            'status' => $status
          ]);
          $success = "Role '$role_name' added successfully!";
        }
      }
    } catch (PDOException $e) {
      error_log("Role save error: " . $e->getMessage());
      $error = "An internal error occurred. Please try again later.";
    }
  }
}

// Fetch roles for table
try {
  $stmt = $pdo->query("SELECT * FROM roles ORDER BY id ASC");
  $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  error_log("Failed to fetch roles: " . $e->getMessage());
  $roles = [];
}
?>

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

                 <!-- Header -->
                 <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <h4 class="card-title">Roles & Permissions</h4>
                    <p class="card-description">Manage user roles and their access levels</p>
                  </div>

                  <button class="btn btn-primary btn-sm rounded-pill" onclick="openRoleModal()">
                    <i class="ti-plus me-1"></i> Add Role
                  </button>

                </div>

                <!-- Table -->
                <div class="table-responsive">
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
                        <?php if (!empty($roles)): ?>
                          <?php foreach ($roles as $index => $role): ?>
                            <tr>
                              <td><?= $index + 1 ?></td>
                              <td><strong><?= htmlspecialchars($role['role_name']) ?></strong></td>
                              <td><?= htmlspecialchars($role['description']) ?></td>
                              <td>
                                <?php
                // Convert CSV permissions into badges
                                $perms = explode(',', $role['permissions']);
                                foreach ($perms as $perm) {
                                  echo '<span class="badge bg-info me-1">'.htmlspecialchars(trim($perm)).'</span>';
                                }
                                ?>
                              </td>
                              <td>
                                <?php
                                switch ($role['status']) {
                                  case 'active':
                                  echo '<span class="badge bg-success">Active</span>';
                                  break;
                                  case 'limited':
                                  echo '<span class="badge bg-warning text-dark">Limited</span>';
                                  break;
                                  default:
                                  echo '<span class="badge bg-secondary">Inactive</span>';
                                }
                                ?>
                              </td>
                              <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary"
                                onclick="openRoleModal(
                                  <?= $role['id'] ?>,
                                  '<?= htmlspecialchars($role['role_name'], ENT_QUOTES) ?>',
                                  '<?= htmlspecialchars($role['description'], ENT_QUOTES) ?>',
                                  [<?= "'" . implode("','", explode(',', $role['permissions'])) . "'" ?>],
                                  '<?= $role['status'] ?>'
                                  )">
                                  Edit
                                </button>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="6" class="text-center">No roles found.</td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>

                </div>

              </div>
            </div>
          </div>


        </div>

        <!-- Add/Edit Role Modal -->
        <div class="modal fade" id="roleModal" tabindex="-1">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="roleModalTitle">Add Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <form id="roleForm" method="POST">
                  <input type="hidden" name="role_id" id="role_id">

                  <div class="form-group mb-3">
                    <label>Role Name</label>
                    <input type="text" name="role_name" class="form-control" placeholder="e.g. Sales" required>
                  </div>

                  <div class="form-group mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Short description"></textarea>
                  </div>

                  <div class="form-group mb-3">
                    <label>Permissions</label>
                    <select name="permissions[]" class="form-select" multiple>
                      <option value="Users">Users</option>
                      <option value="Orders">Orders</option>
                      <option value="Products">Products</option>
                      <option value="Payments">Payments</option>
                      <option value="Feedback">Feedback</option>
                      <option value="Customers">Customers</option>
                    </select>
                    <small class="text-muted">Hold Ctrl (Cmd on Mac) to select multiple</small>
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
                    <button type="submit" class="btn btn-primary">Save Role</button>
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
<!-- JS: Open Modal Dynamically -->
<script>
  function openRoleModal(id = null, role_name = '', description = '', permissions = [], status = 'Active') {
    const modalTitle = document.getElementById('roleModalTitle');
    const form = document.getElementById('roleForm');
    const roleIdInput = document.getElementById('role_id');
    const permissionsSelect = form.querySelector('select[name="permissions[]"]');

    // Set modal title
    modalTitle.textContent = id ? 'Edit Role' : 'Add Role';

    // Set hidden ID
    roleIdInput.value = id || '';

    // Set text fields
    form.querySelector('input[name="role_name"]').value = role_name;
    form.querySelector('textarea[name="description"]').value = description;
    form.querySelector('select[name="status"]').value = status;

    // Reset all permissions first
    Array.from(permissionsSelect.options).forEach(option => {
      option.selected = permissions.includes(option.value);
    });

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('roleModal'));
    modal.show();
  }
</script>

<!-- End custom js for this page-->
</body>
</html>