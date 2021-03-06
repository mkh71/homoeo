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
                        <a class="nav-link @if(!isset($id))active @endif" href="#upcoming-appointments"
                           data-bs-toggle="tab">Patient List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(isset($id))active @endif" href="#today-appointments"
                           data-bs-toggle="tab">Add Patient</a>
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
                                            <th>Complain</th>
                                            <th class="text-center">Dues</th>
                                        </tr>
                                        </thead>
                                        <tbody id="ptn_tbl">
                                        @forelse($patient as $pat)
                                            <tr>

                                                <td>{{$pat->serial}}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{route('patients.profile',$pat->id)}}">{{$pat->name}}</a>
                                                    </h2>
                                                </td>
                                                <td>{{$pat->age}} Yr.</td>
                                                <td>{{$pat->mobile}}</td>
                                                <td>{{$pat->address}}</td>
                                                <td data-id="{{$pat->id}}" class="complain">{{$pat->last_complain}}</td>
                                                <td data-id="{{$pat->id}}" class="dues">{{$pat->dues}}</td>
                                                <td class="text-end">
                                                    <div class="table-action">
                                                        <a href="{{route('patients.edit',$pat->id)}}"
                                                           class="btn btn-sm bg-info-light" id="edit">
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
                                            <input type="number" class="form-control" name="serial"
                                                   value="{{$data->serial ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Patient Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name"
                                                   value="{{$data->name ?? ''}}">
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
                                            <input type="number" class="form-control" name="dues"
                                                   value="{{$data->dues ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control" name="mobile"
                                                   value="{{$data->mobile ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                   value="{{$data->address ?? ''}}">
                                        </div>
                                    </div>
                                    @if(!isset($id))
                                        <table class="table-responsive table-striped" id="medTable">
                                            <tr>
                                                <td colspan="3">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Complain</label>
                                                            <textarea row="3" type="text" class="form-control"
                                                                      name='last_complain'>{{ $data->last_complain ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="position: absolute;z-index: 99999;right: -20px;">
                                                    <button type="button" class="btn btn-warning add" id="plus">
                                                        <i class="fa fa-plus-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="newRow form-group">
                                                <td>
                                                    <select name="medicine[]" id="select-state" required
                                                            id="medicine_id"
                                                            placeholder="Pick a state...">
                                                        <option value="" selected>Select...</option>
                                                        @foreach($medicines as $item)

                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="power[]" id="" class="form-control" required>
                                                        <option value="" selected>Select...</option>
                                                        @foreach($powers as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{--                                                {!! Form::select('power[]', $powers, NULL , ['class'=>'form-control', 'placeholder'=>"Select Power"]) !!}--}}
                                                </td>
                                                <td>
                                                    <select name="dose[]" id="" class="form-control" required>
                                                        <option value="" selected>Select...</option>
                                                        @foreach($doses as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{--                                                {!! Form::select('dose[]', $doeses, NULL , ['class'=>'form-control', 'placeholder'=>"Select Dose"]) !!}--}}
                                                </td>

                                            </tr>
                                        </table>

                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pull-right">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary pt-10">
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
                                            <div class="col-md-2 plusBtn">
                                                <button type="button" class="btn btn-warning addRow ">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <div class="row appendRow">
                                                        <div class="col-md-4">
                                                            <select name="medicine[]" id="select-state" required
                                                                    id="medicine_id"
                                                                    placeholder="Pick a Medicine...">
                                                                <option value="" selected>Select...</option>
                                                                @foreach($medicines as $item)

                                                                    <option
                                                                        value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select name="power[]" id="select-state" required
                                                                    id="medicine_id"
                                                                    placeholder="Pick a Power...">
                                                                <option value="" selected>Select...</option>
                                                                @foreach($powers as $item)

                                                                    <option
                                                                        value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select name="dose[]" id="select-state" required
                                                                    id="medicine_id"
                                                                    placeholder="Pick a Dose...">
                                                                <option value="" selected>Select...</option>
                                                                @foreach($doses as $item)
                                                                    <option
                                                                        value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 addbtn">

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <div class="row mt-2 addCloneData"></div>
                                                </div>
                                                <div class="col-md-2 dltBtn">

                                                </div>
                                            </div>
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
    {{-- purpose modal --}}
    @include('include.modals.addMadicine')
    {{-- end purpose modal --}}
@endsection
@section('js')
    <script>
        $(document).on('keyup', '#search', function () {
            var word = $(this).val();
            $.ajax({
                method: "post",
                url: "{{route('patients.search')}}",
                data: {word: word, _token: "{{csrf_token()}}"},
                success: function (res) {
                    $('#ptn_tbl').html(res);
                }
            });
        });
        $(document).on('click', '.complain', function () {

            $('#exampleModal').modal('show');
            var id = $(this).attr('data-id');
            $('#user_id').val(id);

        })
        $(document).on('click', '#addPurpose', function () {

            $('#addMadicine').modal('show');
            //var id = $(this).attr('data-id');
            //$('#user_id').val(id);
        })
        $(document).on('keyUp', '#medicine_id', function () {
            alert()
        });
        $(document).on('click', '#addPurpose', function () {

            $('#addMadicine').modal('show');
            //var id = $(this).attr('data-id');
            //$('#user_id').val(id);
        })

        $(document).ready(function () {
            $('select').selectize({
                sortField: 'text'
            });
        });
        $('.add').click(function () {
            var T = document.getElementById('medTable');
            var R = document.querySelectorAll('tbody .newRow')[0];
            var C = R.cloneNode(true);
            T.appendChild(C);
            C.insertCell(3).innerHTML = '<button type="button" class="btn btn-danger btn-sm deleteRow"> ' +
                '<i class="fa fa-times-circle"></i>' +
                '</button>'
        })
        $(document).on('click', '.deleteRow', function () {
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
        $(document).on('click', '.addRow', function () {
            $('.appendRow').clone().first().appendTo('.addCloneData').after();
            $('.addbtn').html('<button type="button" class="btn btn-danger btn-sm deleteRow"> ' +
                '<i class="fa fa-times-circle"></i>' +
                '</button>')

        })

    </script>
@endsection
