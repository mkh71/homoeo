@extends('layouts.main')
@section('content')
    <div class="tab-pane @if(isset($id)) active @endif" id="today-appointments">
        <div class="card card-table mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <p>
                            <h4 class="text-center">Add Dose</h4><hr>
                        </p>
                        @if(isset($id))
                            {!! Form::open(['route'=>['dose.update',$id], 'method'=>'post']) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['route'=>'dose.store', 'method'=>'post']) !!}
                        @endif
                        <div class="form-row p-2">

                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="name" value="{{$does->name ?? ''}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary pt-10">
                                 @if(isset($does->id) && $does->id == $id)
                                    Update Does
                                @else
                                    Save Does
                                @endif
                                </button>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable table-hover table-center mb-0 table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($doeses as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$d->name ?? '-'}}</td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                @if(isset($does->id) && $does->id ==$d->id)
                                                    <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                @else
                                                <a href="{{route('dose.edit',$d->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                        <i class="far fa-pencil">Edit</i>
                                                    </a>
                                                    <a href="{{route('dose-delete',$d->id)}}" class="btn btn-sm bg-danger-light" id="edit">
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
