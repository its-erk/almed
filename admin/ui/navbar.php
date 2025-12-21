<?php 

// Fetch loggedInUser details
try {
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
  $stmt->execute(['id' => $_SESSION['user_id']]);
  $loggedInUser = $stmt->fetch();
  if (!$loggedInUser) {
        // If somehow loggedInUser not found, log out
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
  }
} catch (PDOException $e) {
  error_log("Profile fetch error: " . $e->getMessage());
  die("An internal error occurred.");
}
?>
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <a class="navbar-brand brand-logo" href="dashboard.php">
        <img src="../dist/assets/images/afyako-logo.svg" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="dashboard.php">
        <img src="../dist/assets/images/afyako-logo-mini.svg" alt="logo" />
      </a>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item fw-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold"><?= htmlspecialchars($loggedInUser['full_name'] ?: $loggedInUser['username']) ?></span></h1>
        <h3 class="welcome-sub-text">Your performance summary this week </h3>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <form class="search-form" action="#">
          <i class="icon-search"></i>
          <input type="search" class="form-control" placeholder="Search Here" title="Search here">
        </form>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="icon-bell"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
          <a class="dropdown-item py-3 border-bottom">
            <p class="mb-0 fw-medium float-start">You have 4 new notifications </p>
            <span class="badge badge-pill badge-primary float-end">View all</span>
          </a>
          <a class="dropdown-item preview-item py-3">
            <div class="preview-thumbnail">
              <i class="mdi mdi-alert m-auto text-primary"></i>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
              <p class="fw-light small-text mb-0"> Just now </p>
            </div>
          </a>
          <a class="dropdown-item preview-item py-3">
            <div class="preview-thumbnail">
              <i class="mdi mdi-lock-outline m-auto text-primary"></i>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
              <p class="fw-light small-text mb-0"> Private message </p>
            </div>
          </a>
          <a class="dropdown-item preview-item py-3">
            <div class="preview-thumbnail">
              <i class="mdi mdi-airballoon m-auto text-primary"></i>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
              <p class="fw-light small-text mb-0"> 2 days ago </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="../dist/assets/images/profilepics/<?= htmlspecialchars($loggedInUser['profile_pic']); ?>" alt="Profile image"> </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              <img class="img-xs rounded-circle" src="../dist/assets/images/profilepics/<?= htmlspecialchars($loggedInUser['profile_pic']); ?>" alt="Profile image">
              <p class="mb-1 mt-3 fw-semibold"><?= htmlspecialchars($loggedInUser['full_name'] ?: $loggedInUser['username']) ?></p>
              <p class="fw-light text-muted mb-0"><?= htmlspecialchars($loggedInUser['email']); ?></p>
            </div>
            <a href="profile.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <!-- <span class="badge badge-pill badge-danger">1</span> --></a>
            <a href="../auth/logout.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>