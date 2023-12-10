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
                                        <h6>Total Company</h6>
                                        <h3>{{total_company()->count()}}</h3>
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
                                        <h6>Total Bill</h6>
                                        <h3>{{$companies->sum('total')}}</h3>
                                        {{--                                    <p class="text-muted">{{now()->format('Y M d')}}</p>--}}
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
                                        <h6>Total Paid</h6>
                                        <h3>{{$companies->sum('paid')}}</h3>
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
                                        <h3>{{$companies->sum('dues')}}</h3>
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
                                <h4 class="">Add Company</h4>
                            </p>
                        </div>
                        <div class="col-md-7 text-center float-end">
                            <form action="{{route('companies.dateTo.search')}}" class="d-flex" style="margin-left: 10px" method="POST">
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
                                    @error('name')
                                    <div class="alert text-danger">{{ $message }}</div>
                                    @enderror
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
                                    <label>MPO Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="mpo" value="{{$company->mpo ?? ''}}">
                                </div>
                            </div>
                            @if(isset($company))
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Previous Due <span class="text-danger">*</span></label>
                                        <input type="number" disabled class="form-control" value="{{$company->total_dues ?? ''}}">
                                    </div>
                                </div>
                            @endif


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
                                    <th>MPO</th>
                                    <th>Address</th>
                                    <th>Total Bill</th>
                                    <th>Total Paid</th>
                                    <th>Total Dues</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($companies as $info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$info->name ?? '-'}}</td>
                                        <td>{{$info->phone ?? '-'}}</td>
                                        <td>{{$info->mpo ?? '-'}}</td>
                                        <td>{{$info->address ?? '-'}}</td>
                                        <td class="bg-success-light">{{@$info->total ?? '-'}}</td>
                                        <td class="bg-info-light">{{@$info->paid ?? '-'}}</td>
                                        <td class="bg-danger-light">{{@$info->dues ?? '-'}}</td>
                                        <td>{{\Carbon\Carbon::parse($info->created_at)->format('d M y')}}</td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                @if(isset($company) && $info->id == $company->id)
                                                    <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                @else
                                                    <a href="{{route('company.invoices',$info->id)}}" class="btn btn-sm bg-info" id="edit">
                                                        <i class="far feather-eye"></i>
                                                    </a>
                                                    <a href="{{route('companies.edit',$info->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                        <i class="far fa-pencil">Edit</i>
                                                    </a>
                                                    <a onclick="deleteCompany({{ $info->id }})" class="btn btn-sm bg-danger-light" id="edit">
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
        function deleteCompany(companyId) {
            var confirmed = confirm('Are you sure you want to delete this Company?');

            if (confirmed) {
                // Make an Ajax request to delete the patient
                $.ajax({
                    url: '/company/delete/' + companyId,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Reload the page or update the UI as needed
                            location.reload();
                        }
                    }
                });
            }
        }
    </script>
@endsection
