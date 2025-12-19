<?php
require_once 'dist/config.php';

// Fetch active products
try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE status='active' ORDER BY id DESC LIMIT 6");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Failed to fetch products: " . $e->getMessage());
    $products = [];
}

function short_description($text, $max = 80) {
    $text = strip_tags($text); // remove HTML if any
    if (strlen($text) <= $max) return $text;

    // Cut to max length and avoid breaking words
    $text = substr($text, 0, $max);
    $lastSpace = strrpos($text, ' ');
    if ($lastSpace !== false) {
        $text = substr($text, 0, $lastSpace);
    }
    return $text . '…';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karibu | Afyako</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" href="dist/assets/images/favicon.ico" />

    <style>
        body {
            background: #f8f9fc;
        }
        
        .hero {
            height: 100vh;
            background-image: url('assets/img/close-up-medic-expert-using-glucometer-sugar-level-measurements.jpg');
            background-position: center top;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: scroll;
            display: flex;
            align-items: center;
            position: relative;
            color: #fff;
            overflow: hidden;
            will-change: background-position;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            height: 100%; width: 100%;
            background: rgba(0,0,0,0.45);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            margin: auto;
        }

        .product-card:hover {
            transform: translateY(-5px);
            transition: 0.3s ease;
        }

        .wishlist-btn {
            background: rgba(255, 255, 255, 0.9);
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
        }

        .wishlist-btn:hover {
            background: #ff4d6d;
            color: #fff;
            transition: 0.3s;
        }

        .footer {
            background: #111;
            color: #d1d1d1;
        }

        .footer a {
            color: #d1d1d1;
            text-decoration: none;
        }

        .footer a:hover {
            color: #fff;
        }

        .social-icons a {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #222;
            border-radius: 50%;
            margin: 0 5px;
            font-size: 18px;
            transition: 0.3s;
        }

        .social-icons a:hover {
            background: #0d6efd;
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><img src="dist/assets/images/afyako-logo.svg" alt="Afyako logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#shop">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero text-center">
        <div class="container hero-content">
            <h1 class="fw-bold display-4">Reliable Monitoring Kits For A Healthy You</h1>
            <p class="lead mt-3">
                Affordable. Accurate. Trusted by individuals and health facilities.
            </p>
            <a href="#shop" class="btn btn-light rounded-pill btn-lg mt-4 px-4">Browse Products</a>
        </div>
    </section>

    <!-- PRODUCTS -->
    <section id="shop" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-center">Featured Products</h2>
                <p class="text-muted text-center">
                    Trusted, reliable, and affordable healthcare tools designed to keep you and your loved ones healthy.
                </p>
            </div>
            <div class="row g-3 justify-content-center">

                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="card product-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                                <div class="ratio ratio-1x1 position-relative">
                                    <img src="dist/assets/images/products/<?= htmlspecialchars($product['image'] ?? 'placeholder.jpg') ?>" 
                                    class="card-img-top object-fit-cover" 
                                    alt="<?= htmlspecialchars($product['name']) ?>">
                                    <button class="wishlist-btn position-absolute top-0 end-0 m-2 rounded-circle border-0">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>
                                <div class="card-body text-center d-flex flex-column">
                                    <h6 class="fw-bold mb-1"><?= htmlspecialchars($product['name']) ?></h6>
                                    <p class="text-muted small flex-grow-1"><?= htmlspecialchars(short_description($product['description'])) ?></p>
                                    <div class="fw-bold text-primary fs-6 mb-2">KES <?= number_format($product['price']) ?></div>
                                    <button class="btn btn-primary rounded-pill w-100 mb-2">
                                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                    </button>
                                    <a href="product.php?id=<?= (int)$product['id'] ?>" class="btn btn-outline-primary rounded-pill w-100">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted">No products available at the moment.</p>
                <?php endif; ?>

            </div>

        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Get in Touch</h2>
                <p class="text-muted mx-auto" style="max-width:600px;">
                    Have questions or need support? Our team is ready to assist you with trusted healthcare tools and guidance.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 rounded-4 p-4">
                        <form action="send_message.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control rounded-pill" name="name" placeholder="John Doe" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control rounded-pill" name="email" placeholder="you@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Message</label>
                                <textarea class="form-control rounded-3" name="message" rows="5" placeholder="Write your message..." required></textarea>
                            </div>
                            <button class="btn btn-primary rounded-pill w-100 fw-bold">
                                <i class="bi bi-envelope-fill me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer pt-5">
        <div class="container">

            <div class="row text-center text-md-start">

                <!-- Brand -->
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

                <!-- Quick Links -->
                <div class="col-md-4 mb-4">
                    <h6 class="fw-bold text-white mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="#shop">Shop Products</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Contact -->
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
    <script>
        const hero = document.querySelector('.hero');

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            hero.style.backgroundPosition = `center ${scrollY * 0.4}px`;
        });
    </script>
</body>
</html>