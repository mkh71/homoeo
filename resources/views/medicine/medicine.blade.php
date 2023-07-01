@extends('layouts.main')
@section('content')

    <div class="tab-pane @if(isset($id)) active @endif" id="today-appointments">
        <div class="card card-table mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <h4 class="text-center">Add Medicine</h4><hr>
                        </p>
                        @if(isset($id))
                            {!! Form::open(['route'=>['medicine.update',$id], 'method'=>'post']) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['route'=>'medicine.store', 'method'=>'post']) !!}
                        @endif
                        <div class="p-2 form-group row">
                            <div class="col-lg-6">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="name" value="{{$medicine->name ?? ''}}">
                            </div>
                            <div class="col-lg-6">
                                <label>Select Complain <span class="text-danger">*</span></label>
                                <select name="diseases[]" class="select2 form-control" multiple="multiple" required>
                                    @foreach($diseases as $disease)
                                        <option value="{{$disease->id}}" @if(isset($medicine) && in_array($disease->id, $medicine->diseases()->allRelatedIds()->toArray())) selected @endif> {{$disease->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label>Description <span class="text-danger"></span></label>
                                <textarea class="form-control summernote" rows="6" id="summernote" name="description">{!! $medicine->description ?? null !!}</textarea>
                            </div>
                            <div class="col-lg-12">
                                @if(isset($medicine->id) && $medicine->id == $id)
                                    <div class="form-group btn-inline" style="margin-top: 10px">
                                        <button type="submit" class="btn btn-block btn-warning">Update</button>
                                        <button type="button" class="btn btn-block btn-info" onclick="history.back()">Cancel</button>
                                    </div>
                                @else
                                    <button type="submit" class="btn btn-block btn-primary" style="margin-top: 100px">Save</button>
                                @endif
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table dataTable table-hover table-center mb-0 table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Complains</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($medicines as $medi)
                                    <tr>
                                        <td>{{$loop->iteration ?? '-'}}</td>
                                        <td>{{$medi->name}}</td>
                                        <td>
                                            @foreach($medi->diseases as $com)
                                                {{($com->name)}},
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ substr(strip_tags($medi->description), 0, 50) }}
                                        </td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                @if(isset($medicine->id) && $medicine->id == $medi->id)
                                                    <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                @else
                                                <a href="{{route('medicine.edit',$medi->id)}}" class="btn btn-sm bg-info-light" id="edit">
                                                    <i class="far fa-pencil">Edit</i>
                                                </a>
                                                <a href="{{route('medicine-delete',$medi->id)}}" class="btn btn-sm bg-danger-light" id="delete">
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
