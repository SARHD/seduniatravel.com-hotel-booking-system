<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<style>
    .logo-half {
    position: absolute;
    top: 10px;
    left: 10%;
    width: 120px;
    height: 120px;
    border: 1px solid #D1E0C9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    overflow: hidden;
}
</style>

<body>
    <!-- Top Green Bar -->
    <div style="background-color: #1e7e34; color: white; padding: 8px 0; font-size: 13px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span><i class="fas fa-phone"></i> +603-2648 8720</span>
                    <span class="ms-3"><i class="fas fa-envelope"></i> contact@seduniatravel.com</span>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="text-white text-decoration-none me-3">About Us</a>
                    <a href="#" class="text-white text-decoration-none">Corporate Travel</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand logo-half" href="/">
                <img src="{{ asset('images/sedunia-logo-square.png') }}" alt="SEDUNIA" style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Special Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <div class="bg-success rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-light text-dark py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h5>Company</h5>
                    <ul class="list-unstyled ">
                        <li><a href="#" class="text-decoration-none text-dark">About Us</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Contact US</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Tour Brochures</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Careers</a></li>
                    </ul>
                    <div class="col-md-12 text-start mt-4">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-dark me-3"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-dark me-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-dark"><i class="fab fa-twitter"></i></a>
                </div>
                </div>
                <div class="col-md-2">
                    <h5>Travel With Us</h5>
                    <ul class="list-unstyled ">
                        <li><a href="#" class="text-decoration-none text-dark">Matta Fair</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Terms and Conditions</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Privacy Policy</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Booking Terms</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>ISO Certified</h5>
                    <div class="mb-3">
                        <img src="{{ asset('images/IAF.png') }}" alt="SEDUNIA" class="img-fluid w-50 h-100">
                    </div>
                    <div class="d-flex">
                        <img src="{{ asset('images/ISO.png') }}" alt="SEDUNIA" class="img-fluid w-50 p-1">
                        <img src="{{ asset('images/IASfooter2.png') }}" alt="SEDUNIA" class="img-fluid p-1 w-50">
                    </div>
                    <p class="small">ISO Certified<br>SCK/05/STS/23/60/4146</p>
                    </div>
                <div class="col-md-3">
                    <h5>Kuala Lumpur Main Office</h5>
                    <p class="small">Levels 1-B, 12 & 13, Menara Genesis<br>33 Jalan Sultan Ismail 50250 Kuala<br>Lumpur, Malaysia</p>
                    <p class="small mb-0">
                        <i class="fas fa-envelope"></i> contact@seduniatravel.com<br>
                        <i class="fas fa-phone"></i> +603-27795479 (Tours & Flights)<br>
                        <i class="fas fa-phone"></i> +603-21420222 (WhatsApp)
                    </p>
                </div>
                <div class="col-md-3">
                    <h5>Penang Office</h5>
                    <p class="small">Unit 1-3, 1st Floor, Menara Penang<br>Garden, 42A Jalan Sultan Ahmad Shah, 10050 Penang, Malaysia</p>
                    <p class="small mb-0">
                        <i class="fas fa-envelope"></i> penang@sedunia.com.my<br>
                        <i class="fas fa-phone"></i> +604-228 8088 (Tours & Flights)
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>

