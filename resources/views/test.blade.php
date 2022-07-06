@extends('layouts.main')
@section('content')
    <select name="madicine" id="" class="select2 form-control">
        <option value="1">one</option>
        <option value="two">one</option>
        <option value="three">one</option>
    </select>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('select2').select2();
            $('select2').select2({
                dropdownParent: $('body')
            });
        })
    </script>
@endsection
