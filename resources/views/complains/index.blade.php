@extends('layouts.main')
@section('content')
    <div class="">
        <div class="card card-table mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p>
                            <h4 class="text-center">Add Complain</h4><hr>
                        </p>
                        @if(isset($id))
                            {!! Form::open(['route'=>['diseases.update',$id], 'method'=>'post']) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['route'=>'diseases.store', 'method'=>'post']) !!}
                        @endif
                        <div class="p-2 form-row">

                            <div class="form-group">
                                <label>Complain <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="name" value="{{$info->name ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label>Select Medicines <span class="text-danger"></span></label>
                                <select name="medicines[]" class="select2 form-control" multiple="multiple" required>
                                    @foreach($medicines as $med)
                                        <option value="{{$med->id}}" @if(isset($info) && in_array($med->id, $info->medicines()->allRelatedIds()->toArray())) selected @endif> {{$med->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary pt-10">
                                   @if(isset($info->id) && $info->id == $id)
                                        Update
                                    @else
                                        Save
                                    @endif
                                </button>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table dataTable table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Complain</th>
                                    <th>Medicines</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @forelse($data as $d)
                                        <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$d->name ?? '-'}}</td>
                                        <td>
                                            @foreach($d->medicines as $com)
                                                {{($com->name)}},
                                            @endforeach
                                        </td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                @if(isset($info->id) && $info->id ==$d->id)
                                                    <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                @else
                                                <a href="{{route('diseases.edit',$d->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                    <i class="far fa-pencil">Edit</i>
                                                </a>
                                                <a href="{{route('disease.delete',$d->id)}}" class="btn btn-sm bg-danger-light" id="edit">
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
