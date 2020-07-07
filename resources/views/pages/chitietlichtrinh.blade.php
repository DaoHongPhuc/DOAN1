@extends('layout.index')

@section('content')
@php
    $user = Auth::user();
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="container">
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
            
            <div class="title-index-parent">
                <h2 class="title-index">CHI TIẾT LỊCH TRÌNH MÃ SỐ: {{$lichtrinh->name}}</h2>
            </div>

            @foreach ($hanhtrinh as $key => $ht)
                <div class="row" style="position: relative">
                    <div class="col-md-3 sohanhtrinh p-5 text-right" style="border-right:  4px solid orange">
                        Hành Trình {{$key+1}}
                    </div>
                    <div class="col-md-9 noidunghanhtrinh p-5">
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
            
                        <div class="noidunghanhtrinh float-right">
                            @php
                                $check = true;
                                foreach($job as $j){
                                    if($j->hanhtrinh_id == $ht->id){
                                        $check = false;
                                    }
                                }
                                if($check){
                                    echo '<a href="nhanhanhtrinh/'.$lichtrinh->id.'/'.$ht->id.'">Nhận hành trình</a>';
                                }else{
                                    echo 'Đã nhận';
                                }
                            @endphp
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
