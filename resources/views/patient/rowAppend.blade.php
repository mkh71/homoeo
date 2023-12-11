<div>
        <div class="row rowId{{$info}}  mb-2">
            <div class="col-md-2">
                <select name="medicine[]" class="form-control" onchange="medicine(this,{{$info}})" required>
                        <option selected>Select Medicine</option>
                    @if($meds !=null)
                        @foreach ($meds as $disease){
                            @php $color =  getRandomColor()  @endphp
                            @foreach ($disease->medicines as $item) {
                                <option value="{{$item->id}}" style="color: {{$color}}">{{$item->name}}</option>;
                            @endforeach
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-2">
                <select name="power[]" class="form-control" required>
                    <option selected>Select Power</option>
                    @foreach(powers() as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="dose[]" class="form-control" required>
                    <option disabled selected>Select Does</option>
                    @foreach(does() as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input id="mprice{{$info}}"  type="number" class="form-control" value="" disabled>
            </div>
            <div class="col-md-1">
                <input id="qty{{$info}}" onkeyup="sumTotal({{$info}})" type="text" name="qty[]" class="form-control" value="" placeholder="Quantity">
            </div>
            <div class="col-md-2">
                <input id="totalPrice{{$info}}" type="text" value="" name="price" class="form-control" disabled>
            </div>
            <div class="col-md-1">
                <a class="btn btn-danger"  onclick="deleteRow({{$info}})"> <i class="fa feather-trash "></i> </a>
            </div>
        </div>

</div>
