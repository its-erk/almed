<?php
require_once 'dist/config.php';

// Get product ID from URL
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($productId <= 0) header('Location: index.php');

// Fetch product
try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id AND status='active' LIMIT 1");
    $stmt->execute(['id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) header('Location: index.php');

    // Fetch related products
    $stmt = $pdo->prepare("SELECT * FROM products WHERE status='active' AND id != :id ORDER BY id DESC LIMIT 4");
    $stmt->execute(['id' => $productId]);
    $related = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log("Failed to fetch product: " . $e->getMessage());
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($product['name']) ?> | Afyako</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="shortcut icon" href="dist/assets/images/favicon.ico" />
<style>
body { background: #f8f9fc; }
.product-img { border-radius: 1rem; }
.btn-primary, .btn-outline-secondary { border-radius: 50px; }
.price { font-size: 1.6rem; color: #0d6efd; font-weight: 700; }
.card-related img { border-radius: 1rem; height: 180px; object-fit: cover; }
.footer { background: #111; color: #d1d1d1; }
.footer a { color: #d1d1d1; text-decoration: none; }
.footer a:hover { color: #fff; }
.social-icons a { width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; background: #222; border-radius: 50%; margin: 0 5px; font-size: 18px; transition: 0.3s; }
.social-icons a:hover { background: #0d6efd; color: #fff; }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php"><img src="dist/assets/images/afyako-logo.svg" alt="Afyako logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#products">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- PRODUCT DETAIL -->
<section class="py-5 mt-5">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-md-6">
        <div class="card shadow-sm border-0 p-3">
          <img src="dist/assets/images/products/<?= htmlspecialchars($product['image'] ?? 'placeholder.jpg') ?>" class="img-fluid product-img" alt="<?= htmlspecialchars($product['name']) ?>">
        </div>
      </div>
      <div class="col-md-6">
        <h2><?= htmlspecialchars($product['name']) ?></h2>
        <div class="price mb-3">KES <?= number_format($product['price']) ?></div>
        <p class="text-muted"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
        <div class="d-flex gap-2 mt-4">
          <button class="btn btn-primary flex-grow-1"><i class="bi bi-cart-plus me-2"></i>Add to Cart</button>
          <a href="index.php#products" class="btn btn-outline-secondary flex-grow-1">Back to Products</a>
        </div>
      </div>
    </div>

    <!-- RELATED PRODUCTS -->
    <?php if (!empty($related)): ?>
    <div class="mt-5">
      <h4 class="fw-bold mb-4">You Might Also Like</h4>
      <div class="row g-3">
        <?php foreach ($related as $rel): ?>
        <div class="col-6 col-md-3">
          <div class="card card-related shadow-sm border-0 overflow-hidden text-center">
            <img src="dist/assets/images/products/<?= htmlspecialchars($rel['image'] ?? 'placeholder.jpg') ?>" alt="<?= htmlspecialchars($rel['name']) ?>">
            <div class="card-body">
              <h6 class="fw-bold mb-1"><?= htmlspecialchars($rel['name']) ?></h6>
              <div class="text-primary fw-bold mb-2">KES <?= number_format($rel['price']) ?></div>
              <a href="product.php?id=<?= (int)$rel['id'] ?>" class="btn btn-outline-primary rounded-pill btn-sm">View</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer pt-5">
  <div class="container">
    <div class="row text-center text-md-start">
      <div class="col-md-4 mb-4">
        <h5 class="fw-bold text-white">Afyako</h5>
        <p>Diagnostics made simple and dependable.</p>
        <div class="social-icons mt-3">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="https://wa.me/254728407599" target="_blank"><i class="bi bi-whatsapp"></i></a>
          <a href="#"><i class="bi bi-twitter"></i></a>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <h6 class="fw-bold text-white mb-3">Quick Links</h6>
        <ul class="list-unstyled">
          <li><a href="#products">Shop Products</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-4">
        <h6 class="fw-bold text-white mb-3">Get in Touch</h6>
        <p>Email: support@afyako.com</p>
        <p>Phone: +254 728 407 599</p>
        <p>Nairobi, Kenya</p>
      </div>
    </div>
    <div class="text-center border-top border-secondary mt-4 py-3">
      <small>© 2025 Afyako. All rights reserved.</small>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>