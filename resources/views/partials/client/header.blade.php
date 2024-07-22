
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BIMBEL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('pendaftar') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('pendaftar') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Vendor CSS Files -->
    <link href="{{ asset('pendaftar') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('pendaftar') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('pendaftar') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('pendaftar') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('pendaftar') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('pendaftar') }}/assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page d-flex flex-column min-vh-100" style="background-color: #f4f5f7">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('pendaftar') }}/assets/img/logo.png" alt="">
                <h1 class="sitename">BIMBEL'</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{route('client.home')}}">Home<br></a></li>
                    <li><a href="#services">Programme</a></li>
                    <li><a href="#team">Team</a></li>
                    <!-- <li><a href="blog-details.html">Blog</a></li> -->
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="{{route('client.transaction')}}">Transaction</a></li>
                    @if (auth()->user())
                    <li class="dropdown"><a href="{{route('client.profile')}}" class="{{Route::is('client.*') ? 'active':''}}"><span> | Profile</span></i></a>
                    @endif
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            @if (!auth()->user())
            <a class="btn-getstarted flex-md-shrink-0" href="login1.html">Login</a>
            <a class="btn-getstarted flex-md-shrink-0" href="login1.html">Daftar</a>
            @else
            <a class="btn-getstarted flex-md-shrink-0" href="{{route('logout')}}">Logout</a>
            @endif

        </div>
    </header>

    <main style="margin-top: 3cm;" class="main" >
        <!-- Hero Section -->
        @yield('content')
        
        <!-- /Hero Section -->

    </main>

    @include('partials.client.footer')
    @yield('js')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('pendaftar') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('pendaftar') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('pendaftar') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('pendaftar') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('pendaftar') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('pendaftar') }}/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('pendaftar') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('pendaftar') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('pendaftar') }}/assets/js/main.js"></script>

</body>

</html>