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
                                    <h6>Total Bill</h6>
                                    <h3>{{$data->total ?? 0}}</h3>
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
                                    <h6>Total Payment</h6>
                                    <h3>{{$data->paid ?? 0}}</h3>
{{--                                    <p class="text-muted">{{now()->format('Y M d')}}</p>--}}
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
                                    <p>
                                        <h6 class="text-danger">Total Dues</h6>
                                        <h3 class="text-danger">{{$data->dues ?? 0}}</h3>
                                        <p class="text-muted">Till Today</p>
                                    </p>
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
                                            <label>Address</label>
                                            <input type="text" class="form-control"
                                                   name="address" value="{{$data->address ?? ''}}">
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
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control"
                                                   name="mobile" value="{{$data->mobile ?? ''}}">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Complain</label><br>
                                            <select name="last_complain[]" required
                                                    class="form-control last_complain select2"
                                                    style="width: 100%"
                                                    placeholder="Pick complain(s)" multiple="multiple">
                                                @foreach($diseases as $item)
                                                    <option
                                                        value="{{ $item->name }}"
                                                        data-id="{{$item->id}}" @if(in_array($item->name, $data->complains->pluck('details')->toArray()))
                                                            selected @endif>
                                                        {{$item->name}}
                                                    </option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    <div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b>Medicine</b>
                                            </div>
                                            <div class="col-md-2">
                                                <b>Power</b>
                                            </div>
                                            <div class="col-md-2">
                                                <b>Does</b>
                                            </div>
                                            <div class="col-md-1">
                                                <b>Price</b>
                                            </div>
                                            <div class="col-md-1">
                                                 <b>Qty</b>
                                            </div>
                                            <div class="col-md-2">
                                                <b>Total</b>
                                            </div>
                                            <div class="col-md-1">
                                                <b>Cancel</b>
                                            </div>
                                        </div>
                                        @forelse($data->medicine as $info)
                                                <div class="row rowId{{$info->id}} mb-2">
                                            <div class="col-md-2">
                                                <select name="medicine[]" class="form-control"
                                                        required>
                                                    <option value="{{$info->medicine_id}}" selected>{{@$info->medicine->name}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="power[]" class="form-control" required>
                                                    @foreach($powers as $item)
                                                        <option value="{{$item->id}}" {{$info->power_id == $item->id ? 'selected' : ''}} >{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="dose[]" class="form-control" required>
                                                    @foreach($doses as $item)
                                                        <option value="{{$item->id}}" {{$info->dose_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input id="mprice{{$info->id}}" onkeyup="sumTotal({{$info->id}})" type="number" class="form-control" value="{{$info->price}}">
                                            </div>
                                            <div class="col-md-1">
                                                <input id="qty{{$info->id}}" type="text" name="qty[]" onkeyup="sumTotal({{$info->id}})" value="{{$info->qty}}"class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <input id="subTotal" type="text" value="{{$info->price * $info->qty}}" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-1">
                                                <a class="btn btn-danger"  onclick="deleteRow({{$info->id}})"> <i class="fa feather-trash "></i> </a>
                                            </div>
                                        </div>
                                        @empty
                                        @endforelse
                                    </div>


                                    <div class="appendRow"></div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-warning apndBtn">
                                                <i class="fa fa-plus-circle"> Add More Medicine</i>
                                            </button>
                                        </div>


                                    </div>
                                    <div class="row">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Today bill</label>
                                                <input type="number" class="form-control" id="totalPrice" name="new">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Dues + Today Bill</label>
                                                <input type="number" class="form-control"  name="totalNow" value="" id="totalBillNow">
                                                <input type="hidden" class="form-control" name="prevTotal" value="{{$data->total ?? ''}}" id="prevTotal">
                                                <input type="hidden" class="form-control" name="prevPaid" value="{{$data->paid ?? ''}}" id="prevPaid">
                                                <input type="hidden" class="form-control" name="prevDue" value="{{$data->dues ?? ''}}">
                                                <input type="hidden" class="form-control" name="prevDiscount" value="{{$data->discount ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <input type="number" class="form-control" name="discount" value="" id="discount">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Today Payment</label>
                                                <input type="number" class="form-control" name="paid" >
                                            </div>
                                        </div>
                                        <div class="col-md-4 pull-right mt-4">
                                            <div class="form-group" style="margin-top: 10px">
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

@section('js')
    <script>
        $(document).on('click', '.apndBtn', function () {
            var selectedValues = $(".last_complain").val();
            $.ajax({
                method: 'post',
                url: '{{route('appendPurRow')}}',
                data: {name: selectedValues, _token: "{{csrf_token()}}"},
                success: function (response) {
                    $(".appendRow").append(response.rows);
                    // $(".disease_medicines").html(response);
                }
            })
        })

        function medicine(id,value) {
            var id = $(id).val();
            $.ajax({
                method: 'post',
                url: '{{route('medPrice')}}',
                data: {id: id, _token: "{{csrf_token()}}"},
                success: function (res) {
                    $('#mprice'+value).val(res.price)

                }
            })
        }


        $(document).ready(function () {
            calculateTotal();
        });

        function calculateTotal() {
            var totalPrice = 0;

            $("input[name='price']").each(function () {
                var price = parseFloat($(this).val()) || 0;
                totalPrice += price;
            });
            // Display the total wherever you want on the page
            $("#totalPrice").val(totalPrice);
            @php
                $paid = $data->paid + $data->discount;
                if ($data->total == null && $data->paid == null ){
                    $prev = $data->dues ?? 0;
                }else{
                    $prev = $data->total - $paid;
                }
            @endphp
            var prev = 0;
            prev = totalPrice + {{$prev}}
            $("#totalBillNow").val(prev) ;
        }
        function sumTotal(ref) {

            var price = $('#mprice'+ref).val();
            var qty = $('#qty'+ref).val();
            var total = price * qty;
            $('#totalPrice'+ref).val(total);
            calculateTotal();

        }
        function deleteRow(id) {
            $('.rowId'+id).html('')
            setTimeout(function () {
            calculateTotal();
            }, 100);
        }

        $(document).on('change', '.last_complain', function () {
            calculateTotal();
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
