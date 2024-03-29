@extends('layouts.main')
@section('content')
    <div class="">
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
                                        <h6>Total Invoice</h6>
                                        <h3>{{invoices()->count()}}</h3>
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
                                        <h6>Total Bill</h6>
                                        <h3>{{invoices()->sum('total_amount')}}</h3>
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
                                        <h6>Total Payment</h6>
                                        <h3>{{invoices()->sum('total_paid')}}</h3>
                                        {{--                                    <p class="text-muted">{{now()->format('Y M d')}}</p>--}}
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
                                        <h6>Total Dues</h6>
                                        <h3>{{invoices()->sum('total_dues')}}</h3>
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
                    <div class="col-md-5 ">
                        <p class="">
                        <h4 class="">Add Invoice</h4>
                        </p>
                    </div>
                    <div class="col-md-7 text-center float-end">
                        <form action="{{route('invoice.dateTo.search')}}" class="d-flex" style="margin-left: 10px" method="POST">
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
                    <div class="col-md-12">
                        <hr>
                        @if(isset($invoice->id))
                            {!! Form::open(['route'=>['companyInvoice.update',$invoice->id], 'method'=>'post']) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['route'=>'companyInvoice.store', 'method'=>'post']) !!}
                        @endif
                        <div class="p-2 form-row row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Invoice No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="invoice_no" value="{{$invoice->invoice_no ?? ''}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select Company</label>
                                    <select name="company_id" id="" class="form-control" required>
                                        <option selected disabled>Select Company</option>
                                        @forelse(companies() as $info)
                                            <option value="{{$info->id}}" {{isset($invoice) && $info->id == $invoice->company_id ? 'selected' : ''}}>{{$info->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('company_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" required name="date" value="{{isset($invoice) ? $invoice->date : old('date', \Carbon\Carbon::now()->toDateString()) }}">
                                </div>
                            </div>
                            @if(isset($invoice))
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Previous Dues <span class="text-danger">*</span></label>
                                        <input type="number" disabled class="form-control" required value="{{$invoice->total_dues ?? ''}}">
                                    </div>
                                </div>

                            @endif

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Amount <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" required name="total_amount" value="{{$invoice->total_amount ?? ''}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Paid <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_paid" value="{{$invoice->total_paid ?? ''}}">
                                </div>
                            </div>



                            <div class="form-group">

                                @if(isset($invoice->id))
                                    <button type="submit" class="btn btn-block btn-primary pt-10">
                                        Update
                                    </button>
                                    <a href="{{route('companyInvoice.index')}}" class="btn btn-warning">Cancel</a>
                                @else
                                    <button type="submit" class="btn btn-block btn-primary pt-10">
                                        Save
                                    </button>
                                @endif

                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
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

                                @forelse(invoices() as $info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$info->invoice_no ?? '-'}}</td>
                                        <td>{{$info->company->name ?? '-'}}</td>
                                        <td>{{$info->total_amount ?? '-'}}</td>
                                        <td>{{$info->total_paid ?? '-'}}</td>
                                        <td>{{$info->total_dues ?? '-'}}</td>
                                        <td>{{$info->date ?? '-'}}</td>
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
