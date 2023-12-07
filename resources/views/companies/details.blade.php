@extends('layouts.main')
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card dash-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="75">
                                            <img src="{{asset('assets')}}/img/icons/icon-01.png" class="img-fluid"
                                                 alt="patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Invoice</h6>
                                        <h3>{{$invoices->count()}}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="65">
                                            <img src="{{asset('assets')}}/img/icons/icon-02.png" class="img-fluid"
                                                 alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Bill</h6>
                                        <h3>{{$invoices->sum('total_amount')}}</h3>
                                        {{--                                    <p class="text-muted">{{now()->format('Y M d')}}</p>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="dash-widget">
                                    <div class="circle-bar circle-bar3">
                                        <div class="circle-graph3" data-percent="50">
                                            <img src="{{asset('assets')}}/img/icons/icon-03.png" class="img-fluid"
                                                 alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Payment</h6>
                                        <h3>{{$invoices->sum('total_paid')}}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="dash-widget">
                                    <div class="circle-bar circle-bar3">
                                        <div class="circle-graph3" data-percent="50">
                                            <img src="{{asset('assets')}}/img/icons/icon-03.png" class="img-fluid"
                                                 alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Dues</h6>
                                        <h3>{{$invoices->sum('total_dues')}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-table mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table dataTable table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No</th>
                                    <th>Company</th>
                                    <th>Total Amount</th>
                                    <th>Total Paid</th>
                                    <th>Total Dues</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($invoices as $info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$info->invoice_no ?? '-'}}</td>
                                        <td>{{$info->company->name ?? '-'}}</td>
                                        <td>{{$info->total_amount ?? '-'}}</td>
                                        <td>{{$info->total_paid ?? '-'}}</td>
                                        <td>{{$info->total_dues ?? '-'}}</td>
                                        <td>{{\Carbon\Carbon::parse($info->date ?? '-')->format('d M y')}}</td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                @if(isset($invoice) && $info->id == $invoice->id)
                                                    <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                @else
                                                    <a href="{{route('companyInvoice.edit',$info->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                        <i class="far fa-pencil">Edit</i>
                                                    </a>
                                                    <a href="{{route('invoice.delete',$info->id)}}" class="btn btn-sm bg-danger-light" id="edit">
                                                        <i class="far fa-pencil">Delete</i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-warning">
                                            <h3>No record Found</h3>
                                        </td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
    </script>
@endsection
