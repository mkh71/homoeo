@extends('layouts.main')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar1">
                                    <div class="circle-graph1" data-percent="75">
                                        <img src="{{asset('assets')}}/img/icons/icon-01.png" class="img-fluid"
                                             alt="patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <a href="{{route('medicine.low-stock')}}">
                                        <h6>Low Stock</h6>
                                        <h3  class="text-danger">{{low_stock()->count()}}</h3>
                                        <p class="text-muted">Less than 3</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar2">
                                    <div class="circle-graph2" data-percent="65">
                                        <img src="{{asset('assets')}}/img/icons/icon-02.png" class="img-fluid"
                                             alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <a href="{{route('medicine.expired-medicine')}}">
                                        <h6>Expired Medicine</h6>
                                        <h3 class="text-danger">{{expire_medicine()->count()}}</h3>
                                        <p class="text-muted">Less than 6 months</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <div class="dash-widget">
                                <div class="circle-bar circle-bar3">
                                    <div class="circle-graph3" data-percent="50">
                                        <img src="{{asset('assets')}}/img/icons/icon-03.png" class="img-fluid"
                                             alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>Total Stock Amount</h6>
                                    {{totalStockAmount()->sum('total')}}
{{--                                    <h3>{{medicines()->sum('mrp_price')}}</h3>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-4">Medicine List</h4>
            <div class="appointment-tab">

                <!-- Appointment Tab -->
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                    <li class="nav-item">
                        <a class="nav-link @if(!isset($id)) active @else disabled @endif " href="#medicine-list"
                           data-bs-toggle="tab">Medicine List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(isset($id)) active @endif" href="#add-medicine"
                           data-bs-toggle="tab"> @if(!isset($id))
                                Add Medicine
                            @else
                                Update Medicine
                            @endif </a>
                    </li>
                    @if(!isset($id))
                        <li class="nav-item pull-right">
                            <input type="search" placeholder="Search Name/Company/Group..."
                                   class="form-control form-control-lg" id="search"
                                   style="width: 500px; float: right !important;">
                        </li>
                    @endif
                </ul>
                <!-- /medicine Tab -->

                <div class="tab-content">

                    <!-- medicine list tab -->
                    <div class="tab-pane show @if(!isset($id)) active @endif" id="medicine-list">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table dataTable table-hover table-center mb-0 table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Medicine</th>
                                            <th>Power</th>
                                            <th>Qty</th>
                                            <th>Net Price</th>
                                            <th>Mrp Price</th>
                                            <th>Total</th>
                                            <th>Company</th>
                                            <th>Group</th>
                                            <th>Complains</th>
                                            <th>Description</th>
                                            <th>Expire Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="med_table">
                                        @forelse($medicines as $medi)
                                            <tr>
                                                <td>{{$loop->iteration ?? '-'}}</td>
                                                <td>{{$medi->name}}</td>
                                                <td>{{@$medi->power->name}}</td>
                                                <td class="bg-primary-light">{{@$medi->qty}}</td>
                                                <td class="bg-info-light">{{$medi->net_price}}</td>
                                                <td class="bg-warning-light">{{$medi->mrp_price}}</td>
                                                <td class="bg-success-light">{{$medi->net_price * $medi->qty}} tk</td>
                                                <td>{{@$medi->company->name}}</td>
                                                <td>{{$medi->group}}</td>
                                                <td>
                                                    @foreach($medi->diseases as $com)
                                                        {{($com->name)}},
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ substr(strip_tags($medi->description), 0, 50) }}
                                                </td>
                                                <td>{{\Carbon\Carbon::parse($medi->expired_date)->format('d M y')}}</td>
                                                <td class="text-end">
                                                    <div class="table-action">
                                                        @if(isset($medicine->id) && $medicine->id == $medi->id)
                                                            <a href="#" class="badge badge-rounded badge-success p-1">Updating....</a>
                                                        @else
                                                            <a href="{{route('medicine.edit',$medi->id)}}"
                                                               class="btn btn-sm bg-info-light" id="edit">
                                                                <i class="far fa-pencil">Edit</i>
                                                            </a>
                                                            <a href="{{route('medicine-delete',$medi->id)}}"
                                                               class="btn btn-sm bg-danger-light" id="delete">
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
                    <!-- add medicine tab -->
                    <div class="tab-pane @if(isset($id)) active @endif" id="add-medicine">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                        <h4 class="text-center">Add Medicine</h4>
                                        <hr>
                                        </p>
                                        @if(isset($id))
                                            {!! Form::open(['route'=>['medicine.update',$id], 'method'=>'post']) !!}
                                            @method('PATCH')
                                        @else
                                            {!! Form::open(['route'=>'medicine.store', 'method'=>'post']) !!}
                                        @endif
                                        <div class="p-2 form-group row">

                                            <div class="col-lg-4">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required name="name"
                                                       value="{{$medicine->name ?? ''}}">
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Prev Qty <span class="text-danger">*</span></label>
                                                <input disabled class="form-control" value="{{isset($id) ? $medicine->qty : 0}} ">
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Add Qty <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="qty"
                                                       value="{{ old('qty')}}">
                                            </div>

                                            <div class="col-lg-2">
                                                <label>Net Price <span class="text-danger"></span></label>
                                                <input type="number" class="form-control" name="net_price"
                                                       value="{{isset($id) ? $medicine->net_price : old('price')}}">
                                            </div>

                                            <div class="col-lg-2">
                                                <label>Mrp Price <span class="text-danger"></span></label>
                                                <input type="number" class="form-control" name="mrp_price"
                                                       value="{{isset($id) ? $medicine->mrp_price : old('price')}}">
                                            </div>

                                            <div class="col-lg-3">
                                                <label>Expired Date <span class="text-danger"></span></label>
                                                <input type="date" class="form-control" name="expired_date"
                                                       value="{{isset($id) ? $medicine->expired_date : old('expired_date')}}">
                                            </div>

                                            <div class="col-lg-3">
                                                <label>Select Company <span class="text-danger">*</span></label>
                                                <select name="company_id" class="form-control">
                                                    @foreach(companies() as $info)
                                                        <option value="{{$info->id}}"
                                                                @if(isset($medicine) && $info->id == $medicine->company_id) selected @endif> {{$info->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Select Group <span class="text-danger">*</span></label>
                                                <select name="group" class="form-control">
                                                    <option @if(isset($medicine) && $medicine->group == "Dilution") selected @endif value="Dilution">Dilution</option>
                                                    <option @if(isset($medicine) && $medicine->group == "Mother") selected @endif value="Mother">Mother</option>
                                                    <option @if(isset($medicine) && $medicine->group == "Biochemic") selected @endif value="Biochemic">Biochemic</option>
                                                    <option @if(isset($medicine) && $medicine->group == "Biolaid") selected @endif value="Biolaid">Biolaid</option>
                                                    <option @if(isset($medicine) && $medicine->group == "Trituration") selected @endif value="Trituration">Trituration</option>
                                                    <option @if(isset($medicine) && $medicine->group == "Homoeo patent") selected @endif value="Homoeo patent">Homoeo patent</option>
                                                    <option @if(isset($medicine) && $medicine->group == "Unani patent") selected @endif value="Unani patent">Unani patent</option>
                                                    <option @if(isset($medicine) && $medicine->group == "Others") selected @endif value="Others">Others</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-3">
                                                <label>Select Power <span class="text-danger">*</span></label>
                                                <select name="power_id" class="select2 form-control">
                                                    @foreach($powers as $p)
                                                        <option value="{{$p->id}}"
                                                                @if(isset($medicine) && $p->id == $medicine->power_id ) selected @endif> {{$p->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-3">
                                                <label>Select PeckSize <span class="text-danger">*</span></label>
                                                <select name="pack_size" class="select2 form-control">
                                                    @foreach(peckSize() as $p)
                                                        <option value="{{$p->id}}"
                                                                @if(isset($medicine) && $p->id == $medicine->pack_size ) selected @endif> {{$p->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-lg-4">
                                                <label>Select Complain <span class="text-danger">*</span></label> <br>
                                                <select name="diseases[]" class="select2 form-control"
                                                        multiple="multiple">
                                                    @foreach($diseases as $disease)
                                                        <option value="{{$disease->id}}"
                                                                @if(isset($medicine) && in_array($disease->id, $medicine->diseases()->allRelatedIds()->toArray())) selected @endif> {{$disease->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>




                                        </div>

                                        <div class="col-lg-12">
                                            <label>Description <span class="text-danger"></span></label>
                                            <textarea class="form-control summernote" rows="6" id="summernote"
                                                      name="description">{!! $medicine->description ?? null !!}</textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            @if(isset($medicine->id) && $medicine->id == $id)
                                                <div class="form-group btn-inline" style="margin-top: 10px">
                                                    <button type="submit" class="btn btn-block btn-warning">Update
                                                    </button>
                                                    <button type="button" class="btn btn-block btn-info"
                                                            onclick="history.back()">Cancel
                                                    </button>
                                                </div>
                                            @else
                                                <button type="submit" class="btn btn-block btn-primary"
                                                        style="margin-top: 10px">Save
                                                </button>
                                            @endif
                                        </div>

                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    </div>
@stop
@section('js')
    <script>
        $(document).on('keyup', '#search', function () {
            var word = $(this).val();

            $.ajax({
                method: "post",
                url: "{{route('medicines.search')}}",
                data: {word: word, _token: "{{csrf_token()}}"},
                success: function (res) {
                    console.log(res)
                    $('#med_table').html(res);
                }
            });
        });

    </script>
@endsection
