@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">DANH SÁCH ADMIN</h1>
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
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th>GENDER</th>
            <th>MONEY</th>
            <th>CREATED_AT</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($admin as $key => $ad)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$ad->id}}</td>
                <td>{{$ad->email}}</td>
                @foreach ($customer as $c)
                    @if ($c->user_id == $ad->id)
                        <td>{{$c->name}}</td>
                        <td>{{$c->phone}}</td>
                        <td>{{$c->address}}</td>
                        <td>
                            @if ($c->gender == 0)
                                {{"NAM"}}
                            @else
                                {{"NỮ"}}
                            @endif
                        </td>
                        <td>{{$c->money}}</td>

                        <td>{{$c->created_at}}</td>

                    @else
                        {{""}}
                    @endif
                @endforeach
            </tr>
        @endforeach
        
    </tbody>
</table>
@endsection