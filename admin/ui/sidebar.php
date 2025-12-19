<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="dashboard.php">
        <i class="mdi mdi-view-dashboard menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Products -->
    <li class="nav-item nav-category">Shop Management</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
        <i class="menu-icon mdi mdi-tag-multiple"></i>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="products-list.php">All Products</a></li>
          <li class="nav-item"><a class="nav-link" href="add-product.php">Add Product</a></li>
          <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
        </ul>
      </div>
    </li>

    <!-- Orders -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
        <i class="menu-icon mdi mdi-cart"></i>
        <span class="menu-title">Orders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="orders">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="orders-list.php">All Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="orders-pending.php">Pending</a></li>
          <li class="nav-item"><a class="nav-link" href="orders-completed.php">Completed</a></li>
          <li class="nav-item"><a class="nav-link" href="orders-cancelled.php">Cancelled</a></li>
        </ul>
      </div>
    </li>

    <!-- Customers -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#customers" aria-expanded="false" aria-controls="customers">
        <i class="menu-icon mdi mdi-account-group"></i>
        <span class="menu-title">Customers</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="customers">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="customers-list.php">All Customers</a></li>
          <li class="nav-item"><a class="nav-link" href="customer-feedback.php">Feedback</a></li>
        </ul>
      </div>
    </li>

    <!-- Inventory -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#inventory" aria-expanded="false" aria-controls="inventory">
        <i class="menu-icon mdi mdi-warehouse"></i>
        <span class="menu-title">Inventory</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="inventory">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="stock-levels.php">Stock Levels</a></li>
          <li class="nav-item"><a class="nav-link" href="stock-in.php">Stock In</a></li>
          <li class="nav-item"><a class="nav-link" href="stock-out.php">Stock Out</a></li>
        </ul>
      </div>
    </li>

    <!-- Payments -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#payments" aria-expanded="false" aria-controls="payments">
        <i class="menu-icon mdi mdi-cash-multiple"></i>
        <span class="menu-title">Payments</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="payments">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="payments-list.php">All Payments</a></li>
          <li class="nav-item"><a class="nav-link" href="refunds.php">Refunds</a></li>
        </ul>
      </div>
    </li>

    <!-- Reports -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Reports</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="reports">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="sales-report.php">Sales</a></li>
          <li class="nav-item"><a class="nav-link" href="inventory-report.php">Inventory</a></li>
          <li class="nav-item"><a class="nav-link" href="customers-report.php">Customers</a></li>
        </ul>
      </div>
    </li>

    <!-- Users -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
        <i class="menu-icon mdi mdi-account-cog"></i>
        <span class="menu-title">Users</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="users">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="users-list.php">All Users</a></li>
          <li class="nav-item"><a class="nav-link" href="user-add.php">Add User</a></li>
          <li class="nav-item"><a class="nav-link" href="roles.php">Roles & Permissions</a></li>
        </ul>
      </div>
    </li>

    <!-- Settings -->
    <li class="nav-item">
      <a class="nav-link" href="settings.php">
        <i class="menu-icon mdi mdi-cog-outline"></i>
        <span class="menu-title">Settings</span>
      </a>
    </li>

  </ul>
</nav>