<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BIMBEL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="pendaftar/assets/img/favicon.png" rel="icon">
    <link href="pendaftar/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="pendaftar/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="pendaftar/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="pendaftar/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="pendaftar/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="pendaftar/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="pendaftar/assets/css/main.css" rel="stylesheet">


</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="pendaftar/assets/img/logo.png" alt="">
                <h1 class="sitename">FlexStart</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home<br></a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Programme</a></li>
                    <li><a href="#team">Team</a></li>
                    <!-- <li><a href="blog-details.html">Blog</a></li> -->
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted flex-md-shrink-0" href="{{route('login')}}">Login</a>
            <a style="margin-left: .3cm;" class="btn btn btn-outline-primary" href="{{route('register')}}">Daftar</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                            class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        @if (session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @elseif (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('proses-login') }}" method="POST">
                            @csrf
                            <!-- Email input -->
                            <label class="form-label" for="form3Example3">Email address</label>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="form3Example3" class="form-control form-control-lg"
                                    placeholder="Enter a valid email address" name="email" />
                                @error('email')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <label class="form-label" for="form3Example4">Password</label>
                            <div data-mdb-input-init class="form-outline mb-3">
                                <input type="password" id="form3Example4" class="form-control form-control-lg"
                                    placeholder="Enter password" name="password" />
                                @error('password')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <input type="submit" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;"
                                    value="Login"></button>
                                <p style="font-size: large;" class="fw-bold mt-2 pt-1 mb-0">Lupa Password? <a
                                        href="#" class="link-danger">Reset Password</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">BIMBEL</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">FlexStart</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="pendaftar/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="pendaftar/assets/vendor/php-email-form/validate.js"></script>
    <script src="pendaftar/assets/vendor/aos/aos.js"></script>
    <script src="pendaftar/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="pendaftar/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="pendaftar/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="pendaftar/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="pendaftar/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="pendaftar/assets/js/main.js"></script>

</body>

</html>
