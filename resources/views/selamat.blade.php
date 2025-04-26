<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bank Sampah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/fontawesome.min.css">
    <style>
        footer {
            margin-top: auto;
        }

        .brand-carousel {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 4rem 0;
        }

        .brand-item {
            text-align: center;
            padding: 1.5rem;
            transition: transform 0.3s;
        }

        .brand-item:hover {
            transform: translateY(-5px);
        }

        .brand-item img {
            max-height: 100px;
            width: auto;
            object-fit: contain;
            margin-bottom: 1rem;
            filter: grayscale(30%);
            transition: filter 0.3s;
        }

        .brand-item:hover img {
            filter: grayscale(0%);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 100% 100%;
            width: 2.5rem;
            height: 2.5rem;
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%230d6efd' viewBox='0 0 8 8'%3E%3Cpath d='M5.5 0L4.09 1.41 6.67 4 4.09 6.59 5.5 8l4-4-4-4z' transform='rotate(180 4 4)'/%3E%3C/svg%3E");
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%230d6efd' viewBox='0 0 8 8'%3E%3Cpath d='M5.5 0L4.09 1.41 6.67 4 4.09 6.59 5.5 8l4-4-4-4z'/%3E%3C/svg%3E");
        }

        /* Hero Section Enhancements */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/Background_Bsampah.jpg');
            ;
            background-size: cover;
            background-position: center;
            color: white;
            padding: 6rem 0;
            position: relative;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        /* Features Section Enhancements */
        .feature-card {
            transition: all 0.3s;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }

        /* Testimonial Enhancements */
        .testimonial-card {
            border-radius: 10px;
            transition: all 0.3s;
            border: none;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Footer Enhancements */
        footer {
            background: linear-gradient(135deg, #0d6efd 0%, #084298 100%);
        }

        .footer-link {
            transition: all 0.2s;
            display: inline-block;
        }

        .footer-link:hover {
            color: #fff !important;
            transform: translateX(5px);
            text-decoration: underline !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Section Headings */
        .section-heading {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .section-heading:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background: #0d6efd;
            bottom: -10px;
            left: 25%;
            border-radius: 3px;
        }

        /* Navbar Enhancements */
        .navbar {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1rem;
            background: linear-gradient(135deg, #0d6efd 0%, #084298 100%) !important;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white;
        }

        .navbar-nav .nav-link:hover:after,
        .navbar-nav .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 15%;
            width: 70%;
            height: 2px;
            background-color: white;
            transform: scaleX(1);
            transition: transform 0.3s ease;
        }

        .navbar-nav .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 15%;
            width: 70%;
            height: 2px;
            background-color: white;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            padding-left: 1.75rem;
        }

        .user-avatar {
            transition: all 0.3s;
        }

        .category-card {
            transition: all 0.3s;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15);
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .category-card .card-body {
            padding: 2rem 1rem;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
        }

        /* Rest of your existing styles... */
        .brand-carousel {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 4rem 0;
        }
    </style>
</head>

<body class="bg-white text-dark">

    <!-- Enhanced Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #343a40;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <img src="/images/Logo_Bsampah2.png" alt="Logo" class="img-fluid me-2" style="height: 40px;" />
                <span>ecoBank</span>
            </a>
    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                </ul>
    
                @if (Route::has('login'))
                    <div class="d-flex align-items-center gap-2">
                        @auth
                            <!-- User sudah login -->
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-light">Dashboard</a>
    
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-light">Logout</button>
                            </form>
                        @else
                            <!-- User belum login -->
                            <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-light">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>
    


        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="display-4 fw-bold mb-4 animate_animated animate_fadeInDown">Pengelolaan Bank Sampah
                        </h1>
                        <p class="lead mb-5 fs-4">
                            Mengelola sampah Anda dengan mudah dan efisien
                        </p>
                        <a href="{{route('login')}}" class="btn btn-primary btn-lg px-4 py-3">Login Now<i
                                class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Brands Carousel Section -->
        <section class="brand-carousel py-5 bg-white">
            <div class="container">
                <h2 class="text-center mb-5 fw-bold section-heading text-primary">documentary</h2>
                <div id="brandsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <!-- Slide 1 -->
                        <div class="carousel-item active">
                            <div class="row justify-content-center align-items-center gx-4">
                                <div class="col-md-6 mb-4 text-center">
                                    <img src="images/pict_6.jpg" alt="AREI" class="brand-img">
                                </div>
                                <div class="col-md-6 mb-4 text-center">
                                    <img src="images/pict_2.jpg" alt="Consina" class="brand-img">
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="carousel-item">
                            <div class="row justify-content-center align-items-center gx-4">
                                <div class="col-md-6 mb-4 text-center">
                                    <img src="images/pict_3.jpg" alt="Aerostreet" class="brand-img">
                                </div>
                                <div class="col-md-6 mb-4 text-center">
                                    <img src="images/pict_4.jpg" alt="Osprey" class="brand-img">
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="carousel-item">
                            <div class="row justify-content-center align-items-center gx-4">
                                <div class="col-md-6 mb-4 text-center">
                                    <img src="images/pict_5.jpg" alt="Antarestar" class="brand-img">
                                </div>
                                <div class="col-md-6 mb-4 text-center">
                                    <img src="images/pict_7.jpg" alt="Big Armour" class="brand-img">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#brandsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#brandsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <style>
            .brand-img {
                max-height: 300px;
                width: 100%;
                object-fit: cover;
                border-radius: 15px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                transition: transform 0.4s ease;
            }

            .brand-img:hover {
                transform: scale(1.05);
            }

            @media (max-width: 768px) {
                .brand-img {
                    max-height: 200px;
                }
            }

            @media (max-width: 576px) {
                .brand-img {
                    max-height: 180px;
                }
            }
        </style>


        {{-- <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-4">Tentang GoCamps</h1>
                    <p class="lead mb-5 fs-4">
                        Menyediakan peralatan outdoor berkualitas untuk petualangan tak terlupakan Anda
                    </p>
                </div>
            </div>
        </div>
    </section> --}}

        <!-- About Section -->
        <section class="about-section py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h2 class="fw-bold text-primary section-heading">Siapa Kami</h2>
                        <p class="lead">ecoBank adalah platform digital yang menghubungkan Bank Sampah di seluruh Indonesia. Melalui ecoBank, pengelolaan sampah menjadi lebih mudah, transparan, dan terintegrasi, mendukung terciptanya lingkungan yang lebih bersih dan berkelanjutan.


                        </p>
                        <p>Bank Sampah adalah fasilitas untuk mengelola sampah dengan prinsip 3R (Reduce, Reuse, dan
                            Recycle), sebagai sarana edukasi, perubahan perilaku dalam pengelolaan sampah, dan pelaksanaan
                            ekonomi sirkular, yang dibentuk dan dikelola oleh masyarakat, badan usaha, dan/atau pemerintah
                            daerah (Peraturan Menteri LH No. 14 Tahun 2021).</p>
                        {{-- <a href="#" class="btn btn-primary mt-3">Lihat Katalog Kami</a> --}}
                    </div>
                    <div class="col-lg-4 ps-lg-5 mt-4 mt-lg-0">
                        <img src="/images/pict_1.png" alt="Our Team" class="img-fluid rounded-3 shadow">
                    </div>
                </div>
            </div>
        </section>


        <!-- Mission Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-primary section-heading">Visi & Misi Kami</h2>
                    <p class="text-muted">Landasan yang memandu setiap langkah kami</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card mission-card h-100">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <i class="fas fa-binoculars fa-3x text-primary"></i>
                                </div>
                                <h3 class="text-center fw-bold mb-3">Visi</h3>
                                <p class="text-center">Mewujudkan sinergitas program pengelolaan sampah yang ramah
                                    lingkungan dan untuk meningkatkan kesadaran dan partisipasi masyarakat dalam pengelolaan
                                    sampah, serta menciptakan lingkungan yang bersih dan berkelanjutan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mission-card h-100">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <i class="fas fa-bullseye fa-3x text-primary"></i>
                                </div>
                                <h3 class="text-center fw-bold mb-3">Misi</h3>
                                <ul>
                                    <li class="mb-2">Mengajak masyarakat untuk peduli terhadap lingkungan.
                                    </li>
                                    <li class="mb-2">Memberikan edukasi dan sosialisasi tentang pengelolaan sampah.</li>
                                    <li class="mb-2">Memfasilitasi pencatatan dan pengolahan data sampah secara digital.
                                    </li>
                                    <li>Mendorong praktik daur ulang dan pemanfaatan kembali sampah.</li>
                                    <li>Meningkatkan jumlah nasabah bank sampah.</li>
                                    <li>Menguatkan kelembagaan dan administrasi bank sampah.</li>
                                    <li>Membangun sinergi dengan berbagai pihak terkait pengelolaan sampah.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-primary section-heading">Tim Kami</h2>
                    <p class="text-muted">Orang-orang di balik kesuksesan ecoBank</p>
                </div>
                <div class="row justify-content-center g-4">

                    <!-- CARD TEMPLATE -->
                    <div class="col-lg-3 col-md-6">
                        <div class="team-card shadow-lg rounded-4 overflow-hidden h-100 text-center bg-white">
                            <img src="images/Kamto_P.jpg" alt="Ridho" class="w-100 team-img">
                            <div class="p-3">
                                <h5 class="fw-bold mb-1">RIDHO TRI HARYANTO</h5>
                                <p class="text-muted mb-2">Backend</p>
                                <div class="social-icons d-flex justify-content-center gap-3">
                                    <a href="https://www.instagram.com/kamazto/" class="text-dark fs-5"><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- IQBAL -->
                    <div class="col-lg-3 col-md-6">
                        <div class="team-card shadow-lg rounded-4 overflow-hidden h-100 text-center bg-white">
                            <img src="images/Iqbal_P2.jpg" alt="Iqbal" class="w-100 team-img">
                            <div class="p-3">
                                <h5 class="fw-bold mb-1">MUHAMMAD IQBAL P</h5>
                                <p class="text-muted mb-2">UNIVERSITAS MANCING SEDUNIA</p>
                                <div class="social-icons d-flex justify-content-center gap-3">
                                    <a href="https://www.instagram.com/ball_pmks/" class="text-dark fs-5"><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SHALSABILA -->
                    <div class="col-lg-3 col-md-6">
                        <div class="team-card shadow-lg rounded-4 overflow-hidden h-100 text-center bg-white">
                            <img src="images/Shalsa_P2.jpg" alt="Shalsabila" class="w-100 team-img">
                            <div class="p-3">
                                <h5 class="fw-bold mb-1">SHALSABILA SUCI R</h5>
                                <p class="text-muted mb-2">UI/UX</p>
                                <div class="social-icons d-flex justify-content-center gap-3">
                                    <a href="https://www.instagram.com/shalsassr/" class="text-dark fs-5"><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BAYU -->
                    <div class="col-lg-3 col-md-6">
                        <div class="team-card shadow-lg rounded-4 overflow-hidden h-100 text-center bg-white">
                            <img src="images/Bayy_P2.jpg" alt="Bayu" class="w-100 team-img">
                            <div class="p-3">
                                <h5 class="fw-bold mb-1">BAYU GALIH R</h5>
                                <p class="text-muted mb-2">UI/UX</p>
                                <div class="social-icons d-flex justify-content-center gap-3">
                                    <a href="https://www.instagram.com/rsxbayy/" class="text-dark fs-5"><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <style>
            .team-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .team-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            }

            .team-img {
                height: 300px;
                object-fit: cover;
            }

            .social-icons a:hover {
                color: #0d6efd;
            }

            @media (max-width: 768px) {
                .team-img {
                    height: 250px;
                }
            }

            @media (max-width: 576px) {
                .team-img {
                    height: 200px;
                }
            }
        </style>


        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-md-3">
                        <h5 class="fw-bold mb-3"><i class="fa fa-recycle me-2"></i>BankSampah</h5>
                        <p class="mb-4">melayani anda dengan cepat dan ramah</p>
                        <p class="mb-1 fw-semibold">Ikuti Media Sosial Kami:</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i
                                    class="fab fa-tiktok"></i></a>
                            <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i
                                    class="fab fa-youtube"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <h6 class="fw-bold mb-3">Tautan Penting</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#"
                                    class="text-white text-decoration-none footer-link">Ketentuan Penggunaan</a></li>
                            <li class="mb-2"><a href="#"
                                    class="text-white text-decoration-none footer-link">Kebijakan Privasi Aplikasi</a>
                            </li>
                            <li class="mb-2"><a href="#"
                                    class="text-white text-decoration-none footer-link">Kebijakan Privasi Website</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h6 class="fw-bold mb-3">Basecamp Nusa</h6>
                        <p class="mb-3"><i class="fas fa-map-marker-alt me-2"></i>Panjang Jiwo, Tenggilis Mejoyo,
                            Surabaya, Indonesia, 60299</p>
                        <h6 class="fw-bold mb-3">Jam Operasional</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2"><i class="far fa-clock me-2"></i><strong>Sabtu –
                                    Minggu</strong><br>08.00 — 22.00 WIB</li>
                            {{-- <li class="mb-2"><i class="far fa-clock me-2"></i><strong>Jumat</strong><br>13.00 —
                            22.00 WIB</li> --}}
                            <li class="mb-0"><i class="fas fa-info-circle me-2"></i>Istirahat 15 Menit setiap Waktu
                                Shalat</li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h6 class="fw-bold mb-3">Bank sampah</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none footer-link"><i
                                        class="fas fa-info-circle me-2"></i>Tentang Kami</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none footer-link"><i
                                        class="fas fa-envelope me-2"></i>Kontak Kami</a></li>
                        </ul>
                    </div>
                </div>
                <div class="text-center small pt-3">
                    <p class="mb-0">Bank Sampah – Mengambil Sampah Anda</p>
                    <p>© 2025 All rights reserved</p>
                </div>
            </div>
        </footer>
    </body>

    </html>
