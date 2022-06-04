<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Favicons -->
    <link href="{{asset('assets')}}/img/favicon.png" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome/css/all.min.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/css/feather.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/css/style.css">
    @yield('css')
</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="#" class="booking-doc-img">
                                    <img src="{{asset('assets')}}/img/logo.jpeg" alt="User Image">
                                </a>
                                <div class="profile-det-info">
                                    <h3>Dr. Jahid Hossain</h3>

                                    <div class="patient-details">
                                        <h5 class="mb-0">DHMS, BHB, Dhaka</h5>
                                        <h4 class="mb-0 text-success">National Homoeo Pharmacy</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    <li class="active">
                                        <a href="doctor-dashboard.html">
                                            <i class="fas fa-columns"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="my-patients.html">
                                            <i class="fas fa-user-injured"></i>
                                            <span>My Patients</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="accounts.html">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                            <span>Accounts</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="index.html">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /Profile Sidebar -->

                </div>

                <div class="col-md-7 col-lg-8 col-xl-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Footer -->
    <footer class="footer">

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container-fluid">

                <!-- Copyright -->
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="copyright-text">
                                <p class="mb-0">&copy; 2022 Doccure. All rights reserved.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">

                            <!-- Copyright Menu -->
                            <div class="copyright-menu">
                                <ul class="policy-menu">
                                    <li><a href="term-condition.html">Terms and Conditions</a></li>
                                    <li><a href="privacy-policy.html">Policy</a></li>
                                </ul>
                            </div>
                            <!-- /Copyright Menu -->

                        </div>
                    </div>
                </div>
                <!-- /Copyright -->

            </div>
        </div>
        <!-- /Footer Bottom -->

    </footer>
    <!-- /Footer -->

</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{asset('assets')}}/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>

<!-- Sticky Sidebar JS -->
<script src="{{asset('assets')}}/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
<script src="{{asset('assets')}}/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

<!-- Circle Progress JS -->
<script src="{{asset('assets')}}/js/circle-progress.min.js"></script>

<!-- Feather Icon JS -->
<script src="{{asset('assets')}}/js/feather.min.js"></script>

<!-- Custom JS -->
<script src="{{asset('assets')}}/js/script.js"></script>
@yield('js')
</body>
</html>
