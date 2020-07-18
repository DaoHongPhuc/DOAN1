@extends('pages.customer.index')

@section('tour-content')
<div class="title-index-parent">
<h2 class="title-index">THIẾT LẬP LỊCH TRÌNH: 
    {{$lichtrinh->name}}
</h2>
</div>
@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $err)
            {{$err}}. <br>
        @endforeach
    </div>
@endif
@php
    $checkk = true;
    $array = array();
    foreach($datcoc as $dc){
        foreach ($hanhtrinh as $ht) {
           
            if($ht->id == $dc->hanhtrinh_id){
               $array[] = $ht->id;
            }
        }
    }
    if(count($hanhtrinh) == count($array) && count($hanhtrinh)  > 0 ){
        $checkk = false;
    }
@endphp

@if(session('thongbao'))
    <div class="alert alert-success" role="alert">
        {{session('thongbao')}}
    </div>
@endif
@foreach ($hanhtrinh as $key => $ht)
    <div class="row" style="position: relative">
        <div class="col-md-3 sohanhtrinh p-5 text-right" style="border-right:  4px solid orange">
            Hành Trình {{$key+1}}
        </div>
        <div class="col-md-9 noidunghanhtrinh p-5">
            @php
                $check = false;
                foreach($datcoc as $dc){
                    if($dc->hanhtrinh_id == $ht->id){
                        $check = true;
                        $total = $dc->total;
                        $idhdv = $dc->guide_id;
                        foreach ($user as $u) {
                            if($u->id == $idhdv){
                                $namehdv = $u->name;
                            }
                        }
                    }
                }
            @endphp
            <i class="fa fa-map-marker-alt" style="color: green" aria-hidden="true"></i> 
            @php
                foreach($diadiem as $dd){
                    if($dd->id == $ht->diadiem_id){
                        echo $dd->name;
                    }
                }
            @endphp
            &nbsp;
                <i class="fas fa-calendar-alt" style="color: red"></i> {{$ht->ngaykhoihanh}}
                &nbsp;
            @if ($check)
                <i class="fa fa-user" aria-hidden="true" style="color: gray"></i>
                <span>{{$namehdv ?? 'admin'}}</span>&nbsp;
                <i class="fas fa-dollar-sign" style="color: yellow"></i>
                <span class="text-muted">{{$total}}</span>&nbsp;
            @endif
            
            
            <div class="noidunghanhtrinh float-right">
                @if ($check)
                    <a href="nguoinhanhanhtrinh/{{$ht->id}}">Đã đặt cọc</a> &nbsp;
                @else
                    @if ($lichtrinh->status == 1)
                        @php
                            $array = array();
                            foreach($job as $j){
                                if($j->hanhtrinh_id == $ht->id){
                                    $array[] = $j->id;
                                }
                            }
                        @endphp
                        <span class="badge badge-pill badge-primary">{{count($array)}}</span>
                        <a href="nguoinhanhanhtrinh/{{$ht->id}}">Người nhận hành trình</a> &nbsp;
                    
                        
                    @endif
                    <a href="xoahanhtrinh/{{$ht->id}}">Xóa</a>
                @endif
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endforeach


<hr>
<div class="option_lichtrinh">
    @if ($lichtrinh->status == 1)
        <a href="congbolichtrinh/{{$lichtrinh->id}}" class="btn btn-info">Ẩn lịch trình</a>
        <a href="danhsachlichtrinh" class="btn btn-secondary">Trở về danh sách lịch trình</a>
        
    @else
        @if ($checkk)

            <a href="themhanhtrinh/{{$lichtrinh->id}}" class="btn btn-success">Thêm 1 hành trình</a>

            @if ($lichtrinh->status == 0)
                <a href="congbolichtrinh/{{$lichtrinh->id}}" class="btn btn-info">Công bố lịch trình</a>
            @else
                <a href="congbolichtrinh/{{$lichtrinh->id}}" class="btn btn-info">Đóng lịch trình</a>
            @endif
        @else
            <a href="danhsachsaptoi" class="btn btn-primary">Danh sách sắp tới</a>

        @endif

        {{-- <a href="huyallhanhtrinh/{{$lichtrinh->id}}" class="btn btn-danger">Hủy toàn bộ hành trình</a> --}}

        <a href="danhsachlichtrinh" class="btn btn-secondary">Trở về danh sách lịch trình</a>
    @endif
    
</div>

@endsection