@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 col-lg-3">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar1">
                                    <div class="circle-graph1" data-percent="75">
                                        <img src="{{asset('assets')}}/img/icons/icon-01.png" class="img-fluid"
                                             alt="patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>Today Sale</h6>
                                    <h3>{{todayPatient()->sum('total')}}</h3>
                                    <p class="text-muted">Till Today</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-3">
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

                        <div class="col-md-12 col-lg-3">
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

                        <div class="col-md-12 col-lg-3">
                            <div class="dash-widget">
                                <div class="circle-bar circle-bar3">
                                    <div class="circle-graph3" data-percent="50">
                                        <img src="{{asset('assets')}}/img/icons/icon-03.png" class="img-fluid"
                                             alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <a href="{{route('patients.dues.list')}}">
                                        <h6 class="text-danger">Total Dues</h6>
                                        <h3 class="text-danger">{{$totalDues}}</h3>
                                    </a>
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
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-4">Patient</h4>
                </div>

                <div class="col-md-8">
                    <form action="{{route('patients.dateTo.search')}}" class="d-flex" style="margin-left: 10px" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-md-3">
                            <input type="date" name="from" class="form-control float-left">
                        </div>
                        <div class="col-md-1 text-center mt-2"> <b>To</b> </div>
                        <div class="col-md-3">
                            <input type="date" name="to" class="form-control float-left">
                        </div>
                        <div class="col-md-1">
                            <button class="float-end btn btn-primary form-control">
                                <i class="fa feather-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="appointment-tab">

                <!-- Appointment Tab -->
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                    <li class="nav-item">
                        <a class="nav-link @if(!isset($id)) active @else disabled @endif " href="#upcoming-appointments"
                           data-bs-toggle="tab">Patient List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(isset($id)) active @endif" href="#today-appointments"
                           data-bs-toggle="tab"> @if(!isset($id))
                                Add Patient
                            @else
                                Update Patient
                            @endif </a>
                    </li>
                    @if(!isset($id))
                        <li class="nav-item pull-right">
                            <input type="search" placeholder="Search Name/Serial/Mobile..."
                                   class="form-control form-control-lg" id="search"
                                   style="width: 500px; float: right !important;">
                        </li>
                        <form action="{{route('date.search')}}" class="d-flex" style="margin-left: 10px" method="POST">
                            @csrf
                            @method('POST')
                            <li class="ml-1">
                                <input type="date" name="date" class="form-control float-left">
                            </li>
                            <li>
                                <button class="float-end btn btn-primary form-control">
                                    <i class="fa feather-search"></i>
                                </button>
                            </li>
                        </form>
                    @endif
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
                                            <th>Date</th>
                                            <th>Address</th>
                                            <th>Complain</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Paid</th>
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
                                                <td>{{ \Carbon\Carbon::parse($pat->created_at)->format('d M y') }}</td>
                                                <td>{{$pat->address}}</td>
                                                <td data-id="{{$pat->id}}" class="complain"
                                                    style="cursor: pointer">{{$pat->last_complain}}</td>
                                                <td data-id="{{$pat->id}}" class="dues">{{$pat->total}}</td>
                                                <td data-id="{{$pat->id}}" class="dues">{{$pat->paid}}</td>
                                                <td data-id="{{$pat->id}}" class="dues">{{$pat->dues}}</td>
                                                <td class="text-end">
                                                    <div class="table-action">
                                                        <a href="{{route('patients.edit',$pat->id)}}"
                                                           class="btn btn-sm bg-info-light" id="edit">
                                                            <i class="far fa-pencil">Edit</i>
                                                        </a>
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
                                            <input type="number" class="form-control"
                                                   name="serial" value="{{$data->serial ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Patient Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   name="name" value="{{$data->name ?? ''}}">
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
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control"
                                                   name="mobile" value="{{$data->mobile ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input type="number" class="form-control"
                                                   name="total" value="{{$data->total ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Paid</label>
                                            <input type="number" class="form-control"
                                                   name="paid" value="{{$data->paid ?? ''}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control"
                                                   name="date" value="{{$data->date ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control"
                                                   name="address" value="{{$data->address ?? ''}}">
                                        </div>
                                    </div>
                                    @if(!isset($id))
                                        <table class="table table-borderless table-responsive" id="medTable">
                                            <tr style="border: 0">
                                                <td colspan="3" style="border: 0; margin: 0">
                                                    <div class="form-group">
                                                        <label>Complain</label><br>
                                                        <select name="last_complain[]" required
                                                                class="form-control last_complain select2"
                                                                style="width: 100%"
                                                                placeholder="Pick complain(s)" multiple="multiple">
                                                            @foreach($diseases as $item)
                                                                <option value="{{$item->name}}"
                                                                        data-id="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="newRow form-group">
                                                <td style="border: 0; width: 20%;">
                                                    <select name="medicine[]" class="form-control disease_medicines"
                                                            required>
                                                        <option value="" selected>Select medicines</option>
                                                    </select>
                                                </td>

                                                <td style="border: 0; width: 20%;">
                                                    <select name="pack_size[]" class="form-control" required>
                                                        <option value="" selected>Select Pack Size</option>
                                                        @foreach(peckSize() as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{--                                                {!! Form::select('power[]', $powers, NULL , ['class'=>'form-control', 'placeholder'=>"Select Power"]) !!}--}}
                                                </td>

                                                <td style="border: 0; width: 20%;">
                                                    <select name="power[]" class="form-control" required>
                                                        <option value="" selected>Select Power</option>
                                                        @foreach($powers as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{--                                                {!! Form::select('power[]', $powers, NULL , ['class'=>'form-control', 'placeholder'=>"Select Power"]) !!}--}}
                                                </td>
                                                <td style="border: 0; width: 30%;">
                                                    <select name="dose[]" class="form-control" required>
                                                        <option value="" selected>Select Dose</option>
                                                        @foreach($doses as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{--                                                {!! Form::select('dose[]', $doeses, NULL , ['class'=>'form-control', 'placeholder'=>"Select Dose"]) !!}--}}
                                                </td>

                                                <td style="border: 0; width: 20%;">
                                                    <input type="number" name="qty[]" class="form-control"
                                                           placeholder="Quantity">
                                                    {{--                                                {!! Form::select('dose[]', $doeses, NULL , ['class'=>'form-control', 'placeholder'=>"Select Dose"]) !!}--}}
                                                </td>

                                            </tr>
                                        </table>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pull-right">
                                        <button type="button" class="btn btn-warning add" id="plus">
                                            <i class="fa fa-plus-circle"> Add More Medicine</i>
                                        </button>
                                    </div>
                                    <div class="col-md-6 pull-right">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary pt-10">
                                                Save Patient
                                            </button>
                                            @if(isset($id))
                                                <a href="{{route('home')}}" class="btn btn-warning pt-10">
                                                    Cancel
                                                </a>
                                            @endif
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
        <div class="modal-dialog modal-xl">
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
                                    <div class="col-md-4">
                                        <lable for="paid">Total</lable>
                                        <input type="number" name="total" class="form-control"
                                               placeholder="Total Amount">
                                    </div>
                                    <div class="col-md-4">
                                        <lable for="paid">Paid</lable>
                                        <input type="number" name="paid" class="form-control" placeholder="Paid Amount">
                                    </div>

                                    <div class="col-md-4">
                                        <lable for="paid">Date</lable>
                                        <input type="date" name="date" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Purpose</label><br>
                                            <div class="form-group">
                                                <select name="last_complain[]" required
                                                        class="form-control last_complain select2"
                                                        placeholder="Pick complain(s)" multiple="multiple"
                                                        style="width: 100%">
                                                    @foreach($diseases as $item)
                                                        <option value="{{$item->name}}"
                                                                data-id="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <div class="row appendRow">
                                                        <div class="col-md-3">
                                                            <select name="medicine[]"
                                                                    class="form-control disease_medicines" required>
                                                                <option value="" selected>Select medicines</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <select name="pack_size[]" class="form-control" required>
                                                                <option value="" selected>Select Pack Size</option>
                                                                @foreach(peckSize() as $item)
                                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select name="power[]" required class="form-control">
                                                                <option value="" selected>Select Power</option>
                                                                @foreach($powers as $item)
                                                                    <option
                                                                        value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select name="dose[]" required class="form-control">
                                                                <option value="" selected>Select...</option>
                                                                @foreach($doses as $item)
                                                                    <option
                                                                        value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number" name="qty[]" class="form-control"
                                                                   placeholder="qty">
                                                        </div>
                                                        <div class="col-md-1 addbtn">
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
                                <div class="plusBtn">
                                    <button type="button" class="btn btn-warning addRow ">
                                        <i class="fa fa-plus-circle">Add More Medicine</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Complain</button>
                    </div>
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
                    console.log(res);
                    $('#ptn_tbl').html(res);
                }
            });
        });
        $(document).on('change', '.last_complain', function () {
            var name = $(this).val();
            var id = $(this).data('id');
            $.ajax({
                method: 'post',
                url: '{{route('medicineByDisease')}}',
                data: {id: id, name: name, _token: "{{csrf_token()}}"},
                success: function (response) {
                    $(".disease_medicines").html(response);
                }
            })
        })
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

        $(document).on('click', '#addPurpose', function () {
            $('#addMadicine').modal('show');
            //var id = $(this).attr('data-id');
            //$('#user_id').val(id);
        })

        $('.add').click(function () {
            var T = document.getElementById('medTable');
            var R = document.querySelectorAll('tbody .newRow')[0];
            var C = R.cloneNode(true);
            T.appendChild(C);
            C.insertCell(5).innerHTML = '<button type="button" class="btn-danger btn-sm deleteRow"> ' +
                '<i class="fa fa-times-circle"></i>' +
                '</button>'
        })
        $(document).on('click', '.deleteRow', function () {
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
        $(document).on('click', '.addRow', function () {
            $('.appendRow').clone().first().appendTo('.addCloneData').after();
            $('.addbtn').html('<button type="button" class="btn-sm btn-danger deleteRow"> ' +
                '<i class="fa fa-times-circle"></i>' +
                '</button>')
        });

        function allergiesPlus() {
            console.log("hello");
            count3++;
            var data =
                ` <tr id="allergiesCount${count3}">
                     <td><input class="form-control " type="text" name="allergiesProduct[]" placeholder="Product" /></td>
                      <td><input class="form-control" type="text" name="allergiesReaction[]" placeholder="Reaction"/></td>
                      <td><input class="form-control datepicker${count3} " type="text" name="allergiesReactionDate[]" placeholder="dd-mm-yy" /></td>
                    <td style="display:flex;"> <button type="button" onclick="allergiesMinus(count3)" class="btn btn-danger bi-trash"></button> </td>
                </tr>`;
            $("#allergies").append(data);

            flatpickr(`.datepicker${count3}`, {
                dateFormat: "Y-m-d",
            });
        }

    </script>
@endsection
