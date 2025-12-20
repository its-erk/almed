<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> | Afyako</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="dist/assets/images/favicon.ico" />

    <!-- Afyako CSS -->
    <link rel="stylesheet" href="dist/assets/css/afyako.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif; 
            background: #f8f9fc;
        }

        .hero {
            height: 75vh;
            background: url('assets/img/older-person-checking-their-blood-pressure-with-tensiometer.jpg') center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            color: #fff;
        }
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.55);
        }
        .hero-content { position: relative; z-index: 2; }


        .about-section { padding: 80px 0; }
        .about-card {
            background: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.05);
        }


        .stats {
            background: #fff;
            padding: 60px 0;
        }
        .stat-box {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 6px 25px rgba(0,0,0,0.05);
        }
        .stat-box h3 { font-size: 42px; }
        .stat-box {
            background-color: rgba(255, 255, 255, 0.05);
            transition: transform 0.3s ease;
        }
        .stat-box:hover {
            transform: translateY(-5px);
        }
        .values-section { padding: 80px 0; }
        .value-icon {
            font-size: 36px;
            color: #00baba;
            margin-bottom: 15px;
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

            background-color: var(--brand-soft);
            color: var(--brand-dark);

            border-radius: 50%;
            margin: 0 6px;
            font-size: 18px;

            transition: background-color 0.25s ease,
            color 0.25s ease,
            transform 0.2s ease;
        }

        .social-icons a:hover,
        .social-icons a:focus {
            background-color: var(--brand);
            color: #fff;
            transform: translateY(-2px);
        }

        .social-icons a:focus-visible {
            outline: 2px solid var(--brand);
            outline-offset: 3px;
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
                    <li class="nav-item"><a class="nav-link" href="index.php#products">Shop</a></li>
                    <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero text-center d-flex">
        <div class="container hero-content">
            <h1 class="fw-bold display-5">Your Health. Our Priority.</h1>
            <p class="lead mt-3">Smart, reliable monitoring devices that put control back in your hands.</p>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h2 class="fw-bold mb-3">Who We Are</h2>
                            <p class="text-muted">We provide high‑grade diagnostic devices engineered for both home users and healthcare facilities. Our commitment is simple, dependable accuracy without inflated costs.</p>
                            <p class="text-muted">Everything we supply is carefully vetted from reputable manufacturers, tested for precision, and supported by responsive after‑sales assistance. Whether for clinics or individuals, we stay focused on reliability.</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="assets/img/medic-patient-looking-human-body-analysis.jpg" class="img-fluid" style="max-width:420px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="stats bg-dark py-5">
        <div class="container">
            <div class="row text-center text-white g-4">
                <div class="col-md-4">
                    <div class="stat-box py-4 px-3 rounded-4 shadow-sm">
                        <h3 class="fw-bold display-6">10K+</h3>
                        <p class="mb-0">Satisfied Users</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box py-4 px-3 rounded-4 shadow-sm">
                        <h3 class="fw-bold display-6">50+</h3>
                        <p class="mb-0">Partner Clinics</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box py-4 px-3 rounded-4 shadow-sm">
                        <h3 class="fw-bold display-6">7+</h3>
                        <p class="mb-0">Years of Trust</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>

    </style>


<!-- OUR VALUES -->
<section class="values-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">What Drives Us</h2>
            <p class="text-muted">A clear set of values keeps us focused on delivering dependable healthcare tools.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                <h5 class="fw-bold">Accuracy</h5>
                <p class="text-muted">We only stock devices that meet strict quality and precision benchmarks.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="value-icon"><i class="bi bi-people"></i></div>
                <h5 class="fw-bold">Customer First</h5>
                <p class="text-muted">We prioritize support and guidance long after a purchase is made.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="value-icon"><i class="bi bi-globe2"></i></div>
                <h5 class="fw-bold">Accessibility</h5>
                <p class="text-muted">Reliable health monitoring shouldn’t be expensive; we keep it fair.</p>
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
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-4 mb-4">
                    <h6 class="fw-bold text-white mb-3">Get in Touch</h6>
                    <p>
                      Email:
                      <a href="mailto:support@afyako.com" target="_blank" rel="noopener">
                        support@afyako.com
                    </a>
                </p>

                <p>
                  Phone:
                  <a href="tel:+254728407599" target="_blank" rel="noopener">
                    +254 728 407 599
                </a>
            </p>

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