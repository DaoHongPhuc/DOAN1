@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">DANH SÁCH HƯỚNG DẪN VIÊN ĐANG CHỜ</h1>
    </div>
</div><!--/.row-->
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
            <th>ID</th>
            <th>EMAIL</th>
            <th>NAME</th>
            <th>IMAGE</th>
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th>GENDER</th>
            <th>LOCAL</th>
            <th>DETAILLOCAL</th>
            <th>DESLOCAL</th>
            <th>DESSELF</th>
            <th>CREATED_AT</th>
            <th>OPTIONS</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($guidereg as $key => $gr)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$gr->id}}</td>
                <td>{{$gr->email}}</td>
                <td>{{$gr->name}}</td>
                <td><img src="./upload/guide/{{$gr->image}}" height="60" width="60" alt=""></td>
                <td>{{$gr->phone}}</td>
                <td>{{$gr->address}}</td>
                <td>
                    @if ($gr->gender == 0)
                        {{"NAM"}}
                    @else
                        {{"NỮ"}}
                    @endif
                </td>
                <td>{{$gr->local}}</td>
                <td>{{$gr->detaillocal}}</td>
                <td>{{$gr->deslocal}}</td>
                <td>{{$gr->desself}}</td>
                <td>{{$gr->created_at}}</td>
                <td>
                    <a href="admin/guidereg/{{$gr->id}}" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                    <a href="admin/delguidereg/{{$gr->id}}" class="btn btn-danger"> 
                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                </td> 
            </tr>
        @endforeach
        
    </tbody>
</table>
@endsection