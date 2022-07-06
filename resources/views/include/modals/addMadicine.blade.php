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
