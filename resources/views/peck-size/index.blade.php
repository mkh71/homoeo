@extends('layouts.main')
@section('content')
    <div class="tab-pane @if(isset($id)) active @endif" id="today-appointments">
        <div class="card card-table mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p>
                        <h4 class="text-center">Add Peck Size</h4><hr>
                        </p>
                        @if(isset($peackSize))
                            {!! Form::open(['route'=>['peack_sizes.update',$peackSize->id], 'method'=>'post']) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['route'=>'peack_sizes.store', 'method'=>'post']) !!}
                        @endif
                        <div class="p-2 form-row">

                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="name" value="{{$peackSize->name ?? ''}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary pt-10">
                                    @if(isset($peackSize->id))
                                        Update Peck Size
                                    @else
                                        Save Peck Size
                                    @endif
                                </button>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table dataTable table-hover table-center mb-0 table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse(peckSize() as $ps)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$ps->name ?? '-'}}</td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                @if(isset($peackSize->id) && $peackSize->id ==$ps->id)
                                                    <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                @else
                                                    <a href="{{route('peack_sizes.edit',$ps->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                        <i class="far fa-pencil">Edit</i>
                                                    </a>
                                                    <a href="{{route('peack_sizes-delete',$ps->id)}}" class="btn btn-sm bg-danger-light" id="edit">
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
