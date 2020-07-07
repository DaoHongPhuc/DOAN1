@extends('layout.index')

@section('content')
@include('layout.banner')
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
                <h2 class="title-index">LỊCH TRÌNH CÔNG BỐ GẦN ĐÂY</h2>
            </div>
            @foreach ($lichtrinh as $lt)
                @if ($lt->status == 1)
                <input type="hidden" class="present" value="{{$lt->present}}">
                <input type="hidden" class="public" value="{{$lt->public}}">
                    <div class="row ml-2 mt-4">
                        <div class="col-md-9 border p-2" style="border-radius: 10px">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="" style="height: 100%; width: 100%; background-color: red;" >
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <b>MÃ SỐ: {{$lt->name}}</b>
                                    <span class="float-right">
                                        <i class="fa fa-stopwatch text-muted" style="" aria-hidden="true"></i>
                                        <span class="time"></span>
                                        &nbsp;&nbsp;
                                        @if (Auth::check())
                                            <a href="chitietlichtrinh/{{$lt->id}}" >
                                                Xem <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        
                                        <div class="clear"></div>
                                    </span>
                                    <hr>
                                    <div class="row" style="position: relative">
                                        @foreach ($hanhtrinh as $ht)
                                            @if ($ht->lichtrinh_id == $lt->id)
                                                <div class="col-md-2  text-center home-hanhtrinh" style="padding: 0px !important">
                                                    {{$ht->ngaykhoihanh}}
                                                    <hr style="height: 3px; background-color: orange">
                                                    @foreach ($diadiem as $dd)
                                                        @if ($dd->id == $ht->diadiem_id)
                                                            {{$dd->name}}
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('script')
    
<script>        
    var present = document.getElementsByClassName("present");
    var timepublic = document.getElementsByClassName("public");

    var countclass = document.getElementsByClassName("time");
    
    for (let i = 0; i < countclass.length; i++) {
        var p = moment(present[i].value);
        var b = moment(timepublic[i].value);
        var result = p.to(b);

        if(result === "in an hour"){
            result = "over 45m";
        }
        countclass[i].innerHTML = result;
    }
</script>
@endsection
