@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">DANH SÁCH BÁO CÁO CỦA KHÁCH HÀNG</h1>
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
            <th>CUSTOMER</th>
            <th>GUIDE</th>
            <th>TOUR</th>
            <th>NOIDUNG</th>
            <th>CREATED_AT</th>
            <th>OPTIONS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $key => $rp)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$rp->id}}</td>
                <td>
                    @foreach ($customer as $c)
                        @if ($c->id == $rp->cus_id)
                            {{$c->name}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($guide as $g)
                        @if ($g->id == $rp->guide_id)
                            {{$g->name}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($tour as $t)
                        @if ($t->id == $rp->tour_id)
                            {{$t->diadiem}}
                        @endif
                    @endforeach
                </td>
                <td>
                    {{$rp->noidung}}
                </td>
                <td>
                    {{$rp->created_at}}
                </td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection