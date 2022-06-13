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
                                    <h3>{{$totalPatient}}</h3>
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
                                    <h3>{{$todayPatient}}</h3>
                                    <p class="text-muted">{{now()->format('Y M d')}}</p>
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
                                    <h3>{{$totalDues}}</h3>
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
                        <a class="nav-link @if(!isset($id))active @endif" href="#upcoming-appointments" data-bs-toggle="tab">Patient List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(isset($id))active @endif" href="#today-appointments" data-bs-toggle="tab">Add Patient</a>
                    </li>
                    <li class="nav-item pull-right">
                        <input type="search" placeholder="Search Name/Serial/Mobile..."
                               class="form-control form-control-lg" id="search" style="width: 400px">
                    </li>
                </ul>
                <!-- /Appointment Tab -->

                <div class="tab-content">

                    <!-- Upcoming Appointment Tab -->
                    <div class="tab-pane show @if(!isset($id)) active @endif" id="upcoming-appointments">
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
                                        <tbody id="ptn_tbl">
                                        @forelse($patient as $pat)
                                            <tr>

                                                <td >{{$pat->serial}}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{route('patients.profile',$pat->id)}}">{{$pat->name}}</a>
                                                    </h2>
                                                </td>
                                                <td >{{$pat->age}} Yr.</td>
                                                <td>{{$pat->mobile}}</td>
                                                <td>{{$pat->address}}</td>
                                                <td data-id="{{$pat->id}}" class="complain">{{$pat->last_complain}}</td>
                                                <td data-id="{{$pat->id}}" class="dues">{{$pat->dues}}</td>
                                                <td class="text-end">
                                                    <div class="table-action">
                                                        <a href="{{route('patients.edit',$pat->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                            <i class="far fa-pencil">Edit</i>
                                                        </a>

                                                        {{--                                                        <a href="javascript:void(0);"--}}
                                                        {{--                                                           class="btn btn-sm bg-success-light">--}}
                                                        {{--                                                            <i class="fas fa-check"></i> Accept--}}
                                                        {{--                                                        </a>--}}
                                                        {{--                                                        <a href="javascript:void(0);"--}}
                                                        {{--                                                           class="btn btn-sm bg-danger-light">--}}
                                                        {{--                                                            <i class="fas fa-times"></i> Cancel--}}
                                                        {{--                                                        </a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty

                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Upcoming Appointment Tab -->

                    <!-- Today Appointment Tab -->
                    <div class="tab-pane @if(isset($id)) active @endif" id="today-appointments">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                @if(isset($id))
                                    {!! Form::open(['route'=>['patients.update',$id], 'method'=>'post']) !!}
                                    @method('PATCH')
                                @else
                                {!! Form::open(['route'=>'patients.store', 'method'=>'post']) !!}
                                @endif
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Serial No. <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="serial" value="{{$data->serial ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Patient Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{$data->name ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label>Age</label>
                                            {!! Form::number('age', $data->age ?? '',['class' => 'form-control', 'step'=>'any']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Dues</label>
                                            <input type="number" class="form-control" name="dues" value="{{$data->dues ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control" name="mobile" value="{{$data->mobile ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" value="{{$data->address ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Purpose</label>
                                            <textarea row="3" type="text" class="form-control" name='last_complain'>{{$data->last_complain ?? ''}}</textarea>
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
                                    <div class="col-md-6 pull-right">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary pt-10 float-end">
                                                Save Patient
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
@section('modal')
    {{--    patient edit modal start--}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {!! Form::open(['route'=>['patients.complain',0], 'method'=>'post','id'=>'patient_form']) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Patient Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane" id="today-appointments">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="row form-row">
                                    <input type="hidden" name="id" id="user_id" value="">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Purpose</label>
                                            <textarea class="form-control" name="last_complain"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Complain</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    {{--    patient edit modal start--}}
@endsection
@section('js')
    <script>
        $(document).on('keyup', '#search', function () {
           var word = $(this).val();
               $.ajax({
                   method : "post",
                   url : "{{route('patients.search')}}",
                   data : {word:word, _token:"{{csrf_token()}}"},
                   success: function(res){
                       $('#ptn_tbl').html(res);
                   }
               });
        });
        $(document).on('click', '.complain', function () {

            $('#exampleModal').modal('show');
            var id = $(this).attr('data-id');
            $('#user_id').val(id);

        })
    </script>
@endsection
