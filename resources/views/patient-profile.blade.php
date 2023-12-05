@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar1">
                                    <div class="circle-graph1" data-percent="75">
                                        <img src="{{asset('assets')}}/img/icons/icon-01.png" class="img-fluid"
                                             alt="patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <div>
                                        <td>Serial no : </td>
                                        <span class="text-center">{{$patient->serial}}</span>
                                    </div>
                                    <div>
                                        <span>Patient Name : </span>
                                        <span class="text-center">{{$patient->name}}</span>
                                    </div>
                                    <div>
                                        <span>Age : </span>
                                        <span class="text-center">{{$patient->age}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar2">
                                    <div class="circle-graph2" data-percent="65">
                                        <img src="{{asset('assets')}}/img/icons/icon-02.png" class="img-fluid"
                                             alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <div>
                                        <td>Contact : </td>
                                        <span class="text-center">{{$patient->mobile}}</span>
                                    </div>
                                    <div>
                                        <span>Address : </span>
                                        <span class="text-center">{{$patient->address}}</span>
                                    </div>
                                    <div>
                                        <span>Dues : </span>
                                        <span class="text-center">{{$patient->dues}}</span>
                                    </div>
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
            <h4 class="mb-4">Patient Profile</h4>
            <div class="appointment-tab">
                <div class="tab-content">
                    <!-- Upcoming Appointment Tab -->
                    <div class="card card-table mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table dataTable table-hover table-center mb-0 table-bordered">
                                    <thead>
                                    <tr class="table-active">
                                        <th>#</th>
                                        <th>purpose</th>
                                        <th>Medicine (Power) : Does :PackSize :Qty</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody id="ptn_tbl">
                                    @forelse($complain as $com)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$com->details}}</td>
                                            <td>
                                                @foreach($com->medicines as $medicine)
                                                    <table class="table-responsive, table-striped">
                                                        <tr>
                                                            <td width="40%">{{@$medicine->medicine->name}}</td>
                                                            <td width="10%">({{$medicine->power ? $medicine->power->name : '-'}}) </td>
                                                            <td width="20%">: {{ $medicine->dose ? $medicine->dose->name : '-' }}</td>
                                                            <td width="20%">: {{ $medicine->pack_size}}</td>
                                                            <td width="10%">: {{ $medicine->qty}}</td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            </td>
                                            <td>{{ date("d F, Y", strtotime($com->created_at))}} <br> ({{ $com->updated_at->diffForHumans() }}) </td>
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
                <div class="tab-content">

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
    </script>
@endsection
