@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">DANH SÁCH CUSTOMER</h1>
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
    <div class="alert alert-primary" role="alert">
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
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th>GENDER</th>
            <th>MONEY</th>
            <th>CREATED_AT</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($customer as $key => $c)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$c->id}}</td>
                <td>{{$c->email}}</td>
                @foreach ($customerinfo as $if)
                    @if ($if->user_id == $c->id)
                        <td>{{$if->name}}</td>
                        <td>{{$if->phone}}</td>
                        <td>{{$if->address}}</td>
                        <td>
                            @if ($if->gender == 0)
                                {{"NAM"}}
                            @else
                                {{"NỮ"}}
                            @endif
                        </td>
                        <td>{{$if->money}}$</td>

                        <td>{{$if->created_at}}</td>

                    @else
                        {{""}}
                    @endif
                @endforeach
            </tr>
        @endforeach
        
    </tbody>
</table>
@endsection