<?php
session_start();
require_once('../dist/config.php');

// Admin only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

// Validate user ID
$userId = $_GET['id'] ?? null;
if (!$userId || !is_numeric($userId)) {
    header('Location: users.php');
    exit();
}

// Fetch user
$stmt = $pdo->prepare("
    SELECT 
    u.id,
    u.full_name,
    u.email,
    u.phone,
    u.profile_pic,
    u.status,
    u.created_at,
    r.role_name
    FROM users u
    LEFT JOIN roles r ON r.id = u.role_id
    WHERE u.id = ?
    LIMIT 1
    ");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$defaultAvatar = '../dist/assets/images/profilepics/user_69468bb69a1644.28368973.png';
$profilePic   = $user['profile_pic'] ?? null;
$profilePath  = '../dist/assets/images/profilepics/' . $profilePic;

if (!empty($profilePic) && file_exists($profilePath)) {
    $avatar = $profilePath;
} else {
    $avatar = $defaultAvatar;
}

if (!$user) {
    header('Location: users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User View | Afyako</title>
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
            </ol>
        </nav>
    </div>

    <div class="row">

        <!-- USER CARD -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-center">

                    <img src="<?= htmlspecialchars($avatar) ?>" alt="<?= htmlspecialchars($user['full_name']) ?>" class="img-lg rounded-circle mb-3"/>

                    <h4 class="card-title mb-1"><?= htmlspecialchars($user['full_name']) ?></h4>
                    <p class="text-muted mb-2"><?= htmlspecialchars($user['email']) ?></p>

                    <span class="badge <?= $user['status'] === 'active' ? 'bg-success' : 'bg-secondary' ?>"><?= ucfirst($user['status']) ?></span>

                    <div class="mt-4 d-grid gap-2">
                        <a href="user-edit.php?id=<?= $user['id'] ?>" class="btn btn-outline-primary btn-sm">
                            <i class="mdi mdi-pencil"></i> Edit User
                        </a>
                        <a href="users-list.php" class="btn btn-light btn-sm">
                            Back to Users
                        </a>
                    </div>

                </div>
            </div>
        </div>

<!-- USER DETAILS -->
<div class="col-md-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">User Information</h4>
            <p class="card-description">Account details and role information</p>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="text-muted">Full Name</label>
                    <div class="fw-bold"><?= htmlspecialchars($user['full_name']) ?></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="text-muted">Email Address</label>
                    <div class="fw-bold"><?= htmlspecialchars($user['email']) ?></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="text-muted">Phone Number</label>
                    <div class="fw-bold"><?= htmlspecialchars($user['phone'] ?? '-') ?></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="text-muted">Role</label>
                    <div class="fw-bold text-capitalize"><?= htmlspecialchars($user['role_name']) ?></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="text-muted">Account Status</label>
                    <div class="fw-bold">
                        <?= ucfirst($user['status']) ?>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="text-muted">Date Created</label>
                    <div class="fw-bold">
                        <?= date('d M Y, H:i', strtotime($user['created_at'])) ?>
                    </div>
                </div>

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