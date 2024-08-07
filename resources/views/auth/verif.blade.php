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

    <style>
        .otp-form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            text-align: center;
        }
        .otp-inputs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .otp-inputs input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 1.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .submit-btn, .resend-btn {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }
        .submit-btn button, .resend-btn button {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            position: relative;
        }
        .submit-btn button:disabled, .resend-btn button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .otp-message {
            margin-bottom: 20px;
            font-size: 1rem;
            color: #333;
        }
        .alert1 {
            display: none;
            margin-bottom: 20px;
            font-size: 1rem;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #dc3545;
        }
        .alert-success {
            background-color: #28a745;
        }
        .loader {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #007bff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container-fluid h-custom">

                <div class="row d-flex justify-content-center align-items-center h-100">

                    <div class="col-md-12 col-lg-12 ">
                        <div class="otp-form">
                            @if (session('message'))
                                <div class="alert alert-danger" id="sessionAlert">
                                    {{ session('message') }}
                                </div>
                            @elseif (session('success'))
                                <div class="alert alert-success" id="sessionAlert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="alert1 alert-success" id="otpAlert">
                                OTP has been sent. Please check your email. The code is valid for only 5 minutes.
                            </div>
                            <p class="otp-message">Please enter the code sent to your email to verify your account</p>
                            <form action="" method="POST">
                                @csrf
                                <div class="otp-inputs">
                                    <input type="text" maxlength="1" name="otp[]" required>
                                    <input type="text" maxlength="1" name="otp[]" required>
                                    <input type="text" maxlength="1" name="otp[]" required>
                                    <input type="text" maxlength="1" name="otp[]" required>
                                    <input type="text" maxlength="1" name="otp[]" required>
                                    <input type="text" maxlength="1" name="otp[]" required>
                                </div>
                                <div class="submit-btn">
                                    <button type="submit">Submit</button>
                                </div>
                            </form>
                            <div class="resend-btn">
                                <button id="resendOtp" disabled>
                                    <span id="resendText">Resend OTP (<span id="timer">60</span>s)</span>
                                    <div class="loader" id="resendLoader" style="display: none;"></div>
                                </button>
                            </div>
                        </div>
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
                        <li><i class="bi bi-chevron-right"></i> <a href="/">Home</a></li>
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
            <p>© <span>Copyright</span> <strong class="px-1 sitename">BIMBEL</strong> <span>All Rights
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
    <script>
        // Initialize timer
        let timer = 60;
        const timerElement = document.getElementById('timer');
        const resendButton = document.getElementById('resendOtp');
        const resendText = document.getElementById('resendText');
        const resendLoader = document.getElementById('resendLoader');
        const otpAlert = document.getElementById('otpAlert');
        const sessionAlert = document.getElementById('sessionAlert');

        // Countdown function
        function startCountdown() {
            timer = 60;
            timerElement.textContent = timer;
            resendButton.disabled = true;
            resendText.style.display = 'inline';
            resendLoader.style.display = 'none';

            const countdown = setInterval(() => {
                timer--;
                timerElement.textContent = timer;
                if (timer <= 0) {
                    clearInterval(countdown);
                    resendButton.disabled = false;
                    resendText.textContent = 'Resend OTP';
                }
            }, 1000);
        }

        // Initial call to start countdown
        startCountdown();

        // Event listener for Resend OTP button
        resendButton.addEventListener('click', () => {
            resendButton.disabled = true;
            resendText.style.display = 'none';
            resendLoader.style.display = 'inline-block';
            
            // Hide the session alert if it exists
            if (sessionAlert) {
                sessionAlert.style.display = 'none';
            }
            
            fetch('{{ route('otp.resend') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        otpAlert.style.display = 'block';
                        setTimeout(() => {
                            otpAlert.style.display = 'none';
                        }, 5000); // Hide the alert after 5 seconds
                        startCountdown(); // Restart countdown after successful resend
                    } else {
                        alert('Failed to resend OTP. Please try again.');
                        resendButton.disabled = false;
                        resendText.style.display = 'inline';
                        resendLoader.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    resendButton.disabled = false;
                    resendText.style.display = 'inline';
                    resendLoader.style.display = 'none';
                });
        });

        // Automatic focus shifting for OTP inputs
        document.querySelectorAll('.otp-inputs input').forEach((input, index, inputs) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    </script>
</body>

</html>
