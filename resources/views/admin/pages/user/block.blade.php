@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">DANH SÁCH GUIDE (Incomming ....)</h1>
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
{{-- <table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>EMAIL</th>
            <th>NAME</th>
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th>LOCAL</th>
            <th>DETAILLOCAL</th>
            <th>DESLOCAL</th>
            <th>DESSELF</th>
            <th>GENDER</th>
            <th>MONEY</th>
            <th>CREATED_AT</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($guide as $key => $g)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$g->id}}</td>
                <td>{{$g->email}}</td>
                @foreach ($guideinfo as $gf)
                    @if ($gf->user_id == $g->id)
                        <td>{{$gf->name}}</td>
                        <td>{{$gf->phone}}</td>
                        <td>{{$gf->address}}</td>
                        <td>{{$gf->local}}</td>
                        <td>{{$gf->detaillocal}}</td>
                        <td>{{$gf->deslocal}}</td>
                        <td>{{$gf->desself}}</td>
                        <td>
                            @if ($gf->gender == 0)
                                {{"NAM"}}
                            @else
                                {{"NỮ"}}
                            @endif
                        </td>
                        <td>{{$gf->money}}$</td>

                        <td>{{$gf->created_at}}</td>

                    @else
                        {{""}}
                    @endif
                @endforeach
            </tr>
        @endforeach
        
    </tbody>
</table> --}}
@endsection