@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar1">
                                    <div class="circle-graph1" data-percent="75">
                                        <img src="{{asset('assets')}}/img/icons/icon-01.png" class="img-fluid"
                                             alt="patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>Total Patient</h6>
                                    <h3>1500</h3>
                                    <p class="text-muted">Till Today</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar2">
                                    <div class="circle-graph2" data-percent="65">
                                        <img src="{{asset('assets')}}/img/icons/icon-02.png" class="img-fluid"
                                             alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>Today Patient</h6>
                                    <h3>160</h3>
                                    <p class="text-muted">06, Nov 2019</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <div class="dash-widget">
                                <div class="circle-bar circle-bar3">
                                    <div class="circle-graph3" data-percent="50">
                                        <img src="{{asset('assets')}}/img/icons/icon-03.png" class="img-fluid"
                                             alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>Total Dues</h6>
                                    <h3>$85</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-4">Patient</h4>
            <div class="appointment-tab">

                <!-- Appointment Tab -->
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                    <li class="nav-item">
                        <a class="nav-link active" href="#upcoming-appointments" data-bs-toggle="tab">Patient List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#today-appointments" data-bs-toggle="tab">Add Patient</a>
                    </li>
                    <li class="nav-item pull-right">
                        <input type="search" placeholder="Search Name/Serial/Mobile..."
                               class="form-control form-control-lg" id="search" style="width: 400px">
                    </li>
                </ul>
                <!-- /Appointment Tab -->

                <div class="tab-content">

                    <!-- Upcoming Appointment Tab -->
                    <div class="tab-pane show active" id="upcoming-appointments">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Purpose</th>
                                            <th class="text-center">Dues</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>12345</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="patient-profile.html">Richard Wilson</a>
                                                </h2>
                                            </td>
                                            <td>20 Yr</td>
                                            <td>01234567989</td>
                                            <td>CTG</td>
                                            <td>Complain</td>
                                            <td class="text-center">500/=</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Upcoming Appointment Tab -->

                    <!-- Today Appointment Tab -->
                    <div class="tab-pane" id="today-appointments">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                {!! Form::open(['route'=>'patients.store', 'method'=>'post']) !!}
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Serial No. <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Patient Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label>Age</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Purpose</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    {{--                                                        --}}
                                    {{--                                                        <div class="col-md-6">--}}
                                    {{--                                                            <div class="form-group">--}}
                                    {{--                                                                <label>Gender</label>--}}
                                    {{--                                                                <select class="select form-control">--}}
                                    {{--                                                                    <option>Select</option>--}}
                                    {{--                                                                    <option>Male</option>--}}
                                    {{--                                                                    <option>Female</option>--}}
                                    {{--                                                                </select>--}}
                                    {{--                                                            </div>--}}
                                    {{--                                                        </div>--}}
                                    <div class="col-md-4 pull-right">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary"> Save Patient
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Today Appointment Tab -->

            </div>
        </div>
    </div>
@stop
