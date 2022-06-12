@extends('layouts.main')
@section('content')

    <div class="tab-pane @if(isset($id)) active @endif" id="today-appointments">
        <div class="card card-table mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if(isset($id))
                            {!! Form::open(['route'=>['madicine.update',$id], 'method'=>'post']) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['route'=>'madicine.store', 'method'=>'post']) !!}
                        @endif
                        <div class="row form-row">

                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="name" value="{{$madicine->name ?? ''}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary pt-10">
                                   @if(isset($madicine->id) && $madicine->id == $id)
                                    Update Madicine
                                @else
                                    Save Madicine
                                @endif
                                </button>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 table-bordered">
                                <thead>
                                <tr>
                                    <th rowspan="3">Madicine List</th>
                                </tr>
                                <tr>
                                    <th>Serial No.</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($madicines as $madi)
                                    <tr>
                                        <td>{{$madi->id ?? '-'}}</td>
                                        <td>{{$madi->name ?? '-'}}</td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                @if(isset($madicine->id) && $madicine->id ==$madi->id)
                                                    <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                @else
                                                <a href="{{route('madicine.edit',$madi->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                    <i class="far fa-pencil">Edit</i>
                                                </a>
                                                <a href="{{route('madicine-delete',$madi->id)}}" class="btn btn-sm bg-danger-light" id="delete">
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
