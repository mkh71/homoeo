<div class="modal fade" id="addMadicine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form class="form">
                    <select class="address">
                        <option disabled selected>Select One</option>
                        <option>red</option>
                        <option>green</option>
                        <option>blue</option>
                    </select>
                </form>
                <br>
                <br> --}}
                
                {!! Form::open(['route' => ['patients.complain', 0], 'method' => 'post', 'id' => 'patient_form']) !!}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Purpose</label>
                        <textarea row="3" type="text" class="form-control" name='last_complain'>{{ $data->last_complain ?? '' }}</textarea>
                    </div>
                </div>
                    <div class="row mt-4 div" id="purposeDiv">
                        <div class="col-md-4" id="addMedicine">
                              {!! Form::select('madicine[]', $madicines, $madicine->name ?? NULL , ['class'=>'form-control select2 ']) !!}
                          
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('power[]', $powers, $power->name ?? NULL , ['class'=>'form-control select2']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('does[]', $doeses, $does->name ?? NULL , ['class'=>'form-control select2']) !!}
                        </div>
                    </div>
                    <div id="morePurpose" class=""></div>
                    <button type="button" class="mt-2 btn btn-info add">Add</button>

                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- modal hear --}}
