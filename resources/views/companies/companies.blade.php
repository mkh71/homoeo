@extends('layouts.main')
@section('content')
    <div class="">
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
                                        <h6>Total Company</h6>
                                        <h3>{{total_company()->count()}}</h3>
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
                                        <h6>Total Paid</h6>
                                        <h3>{{total_company()->sum('total_paid')}}</h3>
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
                                        <h6>Total Dues</h6>
                                        <h3>{{total_company()->sum('total_dues')}}</h3>
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
                        <p class="ml-2">
                        <h4 class="">Add Company</h4><hr>
                        </p>
                        @if(isset($company->id))
                            {!! Form::open(['route'=>['companies.update',$company->id], 'method'=>'post']) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['route'=>'companies.store', 'method'=>'post']) !!}
                        @endif
                        <div class="p-2 form-row row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="name" value="{{$company->name ?? ''}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" required name="phone" value="{{$company->phone ?? ''}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" required name="email" value="{{$company->email ?? ''}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Total Paid <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_paid" value="{{$company->total_paid ?? ''}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Total Due <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_dues" value="{{$company->total_dues ?? ''}}">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="address" value="{{$company->address ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group">

                                    @if(isset($company->id))
                                    <button type="submit" class="btn btn-block btn-primary pt-10">
                                        Update
                                    </button>
                                    <a href="{{route('companies.index')}}" class="btn btn-warning">Cancel</a>
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
                                    <th>Company</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Total Paid</th>
                                    <th>Total Dues</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($companies as $info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$info->name ?? '-'}}</td>
                                        <td>{{$info->phone ?? '-'}}</td>
                                        <td>{{$info->email ?? '-'}}</td>
                                        <td>{{$info->address ?? '-'}}</td>
                                        <td>{{$info->total_paid ?? '-'}}</td>
                                        <td>{{$info->total_dues ?? '-'}}</td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                @if(isset($company) && $info->id == $company->id)
                                                    <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                @else
                                                    <a href="{{route('companies.edit',$info->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                        <i class="far fa-pencil">Edit</i>
                                                    </a>
                                                    <a href="{{route('company.delete',$info->id)}}" class="btn btn-sm bg-danger-light" id="edit">
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
