<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ str_replace('_', ' ', config('app.name')) }} | Dashboard User </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Honda Motorcycle Recommendation System" name="description" />
    <meta content="Honda" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico.png') }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<style>
    :root {
        --honda-red: #CC0000;
        --honda-red-dark: #A60000;
        --honda-red-light: #FF3333;
        --honda-black: #1A1A1A;
        --honda-gray: #2D2D2D;
        --honda-silver: #C0C0C0;
        --honda-white: #FFFFFF;
        --honda-gold: #FFD700;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    /* Hero Welcome Section */
    .hero-section {
        background: linear-gradient(135deg, var(--honda-red) 0%, var(--honda-red-dark) 100%);
        border-radius: 24px;
        padding: 3rem 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: 0 20px 60px rgba(204, 0, 0, 0.3);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    }

    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.95;
        line-height: 1.6;
    }

    .hero-image {
        position: relative;
        z-index: 3;
        animation: bikeFloat 3s ease-in-out infinite;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
    }

    @keyframes bikeFloat {
        0%, 100% { transform: translateY(0px) translateX(0px); }
        50% { transform: translateY(-15px) translateX(5px); }
    }

    /* Feature Cards */
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        height: 90%;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--honda-red), var(--honda-red-light));
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(204, 0, 0, 0.2);
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--honda-red), var(--honda-red-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 10px 25px rgba(204, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 15px 35px rgba(204, 0, 0, 0.4);
    }

    .feature-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--honda-black);
        margin-bottom: 1rem;
    }

    .feature-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .feature-btn {
        background: linear-gradient(135deg, var(--honda-red), var(--honda-red-dark));
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(204, 0, 0, 0.3);
        text-decoration: none;
        display: inline-block;
    }

    .feature-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(204, 0, 0, 0.4);
        color: white;
    }

    /* Quick Stats */
    .stat-box {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 4px solid var(--honda-red);
    }

    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(204, 0, 0, 0.15);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--honda-red);
        margin-bottom: 0.5rem;
        display: block;
    }

    .stat-label {
        color: #666;
        font-size: 0.95rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Info Banner */
    .info-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        color: white;
        margin-top: 2rem;
        position: relative;
        overflow: hidden;
    }

    .info-banner::before {
        content: '🏍️';
        position: absolute;
        right: 2rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 5rem;
        opacity: 0.2;
    }

    .info-banner h4 {
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .info-banner p {
        margin: 0;
        opacity: 0.95;
    }

    /* Timeline / Recent Activity */
    .activity-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border-left: 4px solid var(--honda-red);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .activity-card:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 25px rgba(204, 0, 0, 0.15);
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--honda-red), var(--honda-red-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .activity-time {
        color: #999;
        font-size: 0.85rem;
    }

    /* Section Title */
    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--honda-black);
        margin-bottom: 1.5rem;
        position: relative;
        padding-left: 1rem;
    }

    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 70%;
        background: linear-gradient(180deg, var(--honda-red), var(--honda-red-dark));
        border-radius: 10px;
    }

    /* Badge */
    .badge-honda {
        background: linear-gradient(135deg, var(--honda-red), var(--honda-red-dark));
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        box-shadow: 0 4px 12px rgba(204, 0, 0, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 1.8rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .feature-card {
            margin-bottom: 1.5rem;
        }

        .stat-box {
            margin-bottom: 1rem;
        }
    }

    /* Animation Delays */
    .feature-card:nth-child(1) { animation-delay: 0.1s; }
    .feature-card:nth-child(2) { animation-delay: 0.2s; }
    .feature-card:nth-child(3) { animation-delay: 0.3s; }
    .feature-card:nth-child(4) { animation-delay: 0.4s; }

    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<body>
    <div id="layout-wrapper">
        <x-header></x-header>
        <x-sidebar></x-sidebar>

        <div class="main-content">
            <div class="page-wrapper">
                <div class="page-content p-4">

                    <!-- Hero Welcome Section -->
                    <div class="hero-section fade-in-up" style="margin-top: 70px;">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="hero-content">
                                    <h1 class="hero-title">
                                        Selamat Datang, {{ Auth::user()->name }}! 👋
                                    </h1>
                                    <p class="hero-subtitle">
                                        Temukan motor Honda impian Anda dengan sistem rekomendasi pintar kami.
                                        Kami siap membantu Anda menemukan motor yang sempurna sesuai kebutuhan dan gaya hidup Anda.
                                    </p>
                                    <div class="mt-4">
                                        <span class="badge-honda me-2">
                                            <i class="fas fa-check-circle me-1"></i> Sistem Terpercaya
                                        </span>
                                        <span class="badge-honda">
                                            <i class="fas fa-award me-1"></i> Rekomendasi Akurat
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <img src="assets/images/honda-bulat.png" height="200" alt="Honda" class="hero-image">
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    {{-- <div class="row mb-4">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="stat-box fade-in-up" style="animation-delay: 0.2s;">
                                <span class="stat-number">50+</span>
                                <div class="stat-label">Model Motor</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="stat-box fade-in-up" style="animation-delay: 0.3s;">
                                <span class="stat-number">1000+</span>
                                <div class="stat-label">Pengguna Puas</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="stat-box fade-in-up" style="animation-delay: 0.4s;">
                                <span class="stat-number">98%</span>
                                <div class="stat-label">Akurasi</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="stat-box fade-in-up" style="animation-delay: 0.5s;">
                                <span class="stat-number">24/7</span>
                                <div class="stat-label">Layanan</div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Main Features -->
                    <div class="row mb-2">
                        <!-- Feature 1: Rekomendasi Motor -->
                        <div class="col-lg-6 col-md-6 mb-4">
                            <div class="card feature-card fade-in-up">
                                <div class="feature-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h5 class="feature-title">Cari Rekomendasi</h5>
                                <p class="feature-description">
                                    Dapatkan rekomendasi motor Honda yang tepat berdasarkan kriteria dan kebutuhan Anda.
                                </p>
                            </div>
                        </div>

                        <!-- Feature 2: Riwayat -->
                        <div class="col-lg-6 col-md-6 mb-4">
                            <div class="card feature-card fade-in-up">
                                <div class="feature-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <h5 class="feature-title">Riwayat Pencarian</h5>
                                <p class="feature-description">
                                    Lihat kembali hasil rekomendasi motor yang pernah Anda cari sebelumnya.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <x-footer></x-footer>
        </div>

        <x-toast></x-toast>
    </div>

    <x-right-sidebar></x-right-sidebar>
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/libs/pace-js/pace.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = `fadeInUp 0.6s ease forwards`;
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });

        // Add click animation to feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.classList.contains('feature-btn')) {
                    const btn = this.querySelector('.feature-btn');
                    if (btn) {
                        btn.click();
                    }
                }
            });
        });

        // Add hover effect to activity cards
        document.querySelectorAll('.activity-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.borderLeftWidth = '6px';
            });
            card.addEventListener('mouseleave', function() {
                this.style.borderLeftWidth = '4px';
            });
        });
    </script>

</body>

</html>
