<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('tittle', 'Home')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/front/assets/img/favicon.png">

    <link rel="stylesheet" href="/front/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/front/assets/css/templatemo.css">
    <link rel="stylesheet" href="/front/assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="/front/assets/css/fontawesome.min.css">

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-dark logo h2 align-self-center" href="/front/index.html">
                TOKO BANDENG 2D
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/products">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about">Tentang Kami</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    @if (Auth::guard('webmember')->check())
                    <a href="/profile" class="nav-icon position-relative text-decoration-none" >{{Auth::guard('webmember')->user()->nama_member}} </a>
                    @else
                    <a class="nav-icon position-relative text-decoration-none" href="/login_member">
                        Login
                    </a>
                    @endif

                    <a class="nav-icon position-relative text-decoration-none" href="/cart">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>

                    @if (Auth::guard('webmember')->check())
                    <a href="/logout_member" class="nav-icon position-relative text-decoration-none" > Logout</a>
                    @endif
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    @yield('content')

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">TOKO BANDENG 2D</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Pati, Jawa Tengah, Indonesia
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="/front/tel:010-020-0340">081227392600</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="/front/mailto:info@company.com">tokobandeng2d@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Menu</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="/">Home</a></li>
                        <li><a class="text-decoration-none" href="/products">Produk</a></li>
                        <li><a class="text-decoration-none" href="/about">Tentang Kami</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2024 Toko Bandeng 2D</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="/front/assets/js/jquery-1.11.0.min.js"></script>
    <script src="/front/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/front/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/front/assets/js/templatemo.js"></script>
    <scrip src="/front/assets/js/custom.js"></script>
    @stack('js')
    <!-- End Script -->
</body>

</html>