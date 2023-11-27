@forelse($medicines as $medi)
    <tr>
        <td>{{$loop->iteration ?? '-'}}</td>
        <td>{{$medi->name}}</td>
        <td>{{@$medi->power->name}}</td>
        <td>{{$medi->net_price}}</td>
        <td>{{$medi->mrp_price}}</td>
        <td>{{@$medi->qty}}</td>
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
        <td>{{$medi->expired_date}}</td>
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
