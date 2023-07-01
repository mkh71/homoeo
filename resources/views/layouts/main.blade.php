<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NHP.Ctg</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Favicons -->
    <link href="{{asset('assets')}}/img/favicon.png" rel="icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/dataTable.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <!-- Fontawesome CSS -->
{{--    <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome/css/fontawesome.min.css">--}}
{{--    <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome/css/all.min.css">--}}

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/css/feather.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--    data table link--}}
    <link href="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('css')
</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-xl-3 theiaStickySidebar">

                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="{{route('home')}}" class="booking-doc-img">
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
                                        <a href="{{route('home')}}">
                                            <i class="fas fa-columns"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="{{request()->is('power*') ? 'active' : ''}}">
                                        <a href="{{route('power.index')}}">
                                            <i class="fas feather-check-circle"></i>
                                            <span>Power</span>
                                        </a>
                                    </li>
                                    <li class="{{request()->is('dose*') ? 'active' : ''}}">
                                        <a href="{{route('dose.index')}}">
                                            <i class="fas feather-check-circle"></i>
                                            <span>Dose</span>
                                        </a>
                                    </li>
                                    <li class="{{request()->is('medicine*') ? 'active' : ''}}">
                                        <a href="{{route('medicine.index')}}">
                                            <i class="fas feather-check-circle"></i>
                                            <span>Medicine</span>
                                        </a>
                                    </li>
                                    <li class="{{request()->is('diseases*') ? 'active' : ''}}">
                                        <a href="{{route('diseases.index')}}">
                                            <i class="fas feather-check-circle"></i>
                                            <span>Diseases</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{route('backup')}}">
                                            <i class="fas feather-download-cloud"></i>
                                            <span>Backup</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                <i class="fas feather-log-out"></i>
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /Profile Sidebar -->

                </div>

                <div class="col-md-9 col-lg-9 col-xl-9">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

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
                                <p class="mb-0">&copy; {{date('Y')}} NHP.Ctg. All rights reserved.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">

                            <!-- Copyright Menu -->
                            <div class="copyright-menu">
                                <ul class="policy-menu">
                                    {{--  --}}
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

<!-- /Page Content -->
<div class="js-alert">
    @if (session()->has('success'))
        <script type="text/javascript">
            $(function () {
                $.notify("{{session()->get("success")}}", {globalPosition: 'bottom right',className: 'success'});
            });
        </script>
    @endif

    @if(session()->has('error'))
        <script type="text/javascript">
            $(function () {
                $.notify("{{session()->get("error")}}", {globalPosition: 'bottom right', className: 'error'});
            });
        </script>
    @endif

    @if (session()->has('warning'))
        <script type="text/javascript">
            $(function () {
                $.notify("{{session()->get("warning")}}", {globalPosition: 'bottom right', className: 'warn'});
            });
        </script>
    @endif
</div>

@yield('modal')
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{asset('assets')}}/js/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<!-- Bootstrap Core JS -->
<script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/js/dataTable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"
        integrity="sha256-srhz/t0GOrmVGZryG24MVDyFDYZpvUH2+dnJ8FbpGi0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Sticky Sidebar JS -->
<script src="{{asset('assets')}}/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
<script src="{{asset('assets')}}/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
<script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.js"></script>
<!-- Circle Progress JS -->
<script src="{{asset('assets')}}/js/circle-progress.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

<!-- Feather Icon JS -->
<script src="{{asset('assets')}}/js/feather.min.js"></script>
<script src="{{asset('assets')}}/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@yield('js')

<script type="text/javascript">
    @if(session('status'))
    toastr.success("{{ session('status') }}")
    @endif
    $(document).ready(function() {
        $('#summernote').summernote();
        $('.dataTable').DataTable();
        $('.select2').select2({
            placeholder: 'Select Item(s)'
        });
    })
    @if(session('success'))
    swal({
        title: "NHP.Ctg!",
        text: "{{ session('success') }}",
        icon: "success",
    });
    @endif


</script>

</body>
</html>
