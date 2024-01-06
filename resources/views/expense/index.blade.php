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
                                        <h6>Today Expense</h6>
                                         <h3>{{todayExpense()->sum('total')}}</h3>
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
                                        <h6>This Month Expense</h6>
                                        <!-- <h3>{{$expenses->sum('total')}}</h3> -->
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
                                        <h6>Total Expense</h6>
                                        <h3>{{$expenses->sum('total')}}</h3>
                                        {{--                                    <p class="text-muted">{{now()->format('Y M d')}}</p>--}}
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
                        <h4 class="">Add Expense</h4>
                        </p>
                    </div>
                   
                    <div class="col-md-12">
                        @if(isset($expense->id))
                            {!! Form::open(['route'=>['expenses.update',$expense->id], 'method'=>'post']) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['route'=>'expenses.store', 'method'=>'post']) !!}
                        @endif
                        <div class="p-2 form-row row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Expense<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="total" value="{{$expense->total ?? ''}}">
                                    @error('name')
                                    <div class="alert text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" required name="date" value="{{$expense->date ?? ''}}">
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" required name="description" value="{{$expense->description ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="" ></label><br>
                                    <button class="btn btn-primary mt-2" type="submit"> <i class="fa fa-plus-circle"></i></button>
                                </div>
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
                                    <th>Expense</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>    
                                <tbody>

                                @forelse($expenses as $info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$info->total ?? '-'}}</td>
                                        <td>{{\Carbon\Carbon::parse($info->date)->format('d M y')}}</td>
                                        <td>{{$info->description ?? '-'}}</td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                @if(isset($expense) && $info->id == $expense->id)
                                                    <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                @else
                                                   
                                                    <a href="{{route('expenses.edit',$info->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                        <i class="far fa-pencil">Edit</i>
                                                    </a>
                                                    <!-- <a onclick="deleteCompany({{ $info->id }})" class="btn btn-sm bg-danger-light" id="edit">
                                                        <i class="far fa-pencil">Delete</i>
                                                    </a> -->
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
