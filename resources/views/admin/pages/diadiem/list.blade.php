@extends('admin.layout.index')

@section('content')
<h2>DANH SÁCH ĐỊA ĐIỂM</h2>
@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $err)
            {{$err}}. <br>
        @endforeach
    </div>
@endif

@if(session('thongbao'))
    <div class="alert alert-success" role="alert">
        {{session('thongbao')}}
    </div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>NAME</th>
            <th>CREATED_AT</th>
            <th>OPTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($diadiem as $key => $dd)
        <tr>
        <td scope="row">{{$key+1}}</td>
            <td>{{$dd->name}}</td>
            <td>{{$dd->created_at}}</td>
            <td>
                <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                <button class="btn btn-success"><i class="fa fa-edit" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
        
    </tbody>
</table>
@endsection