@extends('layout.index')

@section('content')
@include('layout.banner')
@php
    $user = Auth::user();
@endphp
<div class="row">
    <div class="col-md-9">
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
                <h2 class="title-index">MỘT SỐ ĐỊA ĐIỂM DU LỊCH HẤP DẪN</h2>
            </div>
            
            <div class="title-index-parent">
                <h2 class="title-index">TOUR GẦN ĐÂY</h2>
            </div>
            <div class="row">
                @foreach ($tour as $t)
                <input type="hidden" value="{{$t->present}}" class="tourpresent">
                <input type="hidden" value="{{$t->timepublic}}" class="tourtimepublic">
                    <div class="col-md-3" style="border-radius: 10px">
                        <div class="boxtour">
                            <div class="item">
                                <div class="img">
                                    <img src="./img/default.PNG" alt="">
                                </div>
                                <div class="contenttour mt-2 d-flex justify-content-around">
                                    <p><i class="fa fa-map-marker-alt" aria-hidden="true" style="color: green;"></i>&nbsp;{{$t->diadiem}}</p>
                                    <p><i class="fas fa-calendar-alt" style="color: red;"></i>&nbsp;{{$t->ngaykhoihanh}}</p>
                                </div>
                                    @foreach ($customer as $c)
                                        @if ($c->id == $t->cus_id)
                                            <div class="d-flex justify-content-around">
                                                <small class="text-muted">
                                                    <i class="fa fa-user" style="color: #4949ff" aria-hidden="true"></i>
                                                        &nbsp;{{$c->name}}&nbsp;&nbsp;
                                                    <i class="fa fa-stopwatch" style="color: #ff9900" aria-hidden="true"></i>
                                                        &nbsp;<span class="tourtime"></span>
                                                </small>
                                            </div>
                                        @else
                                            {{""}}
                                        @endif
                                    @endforeach
                                <hr>
                                <div class="tour-footer">
                                    <a href="tourdetail/{{$t->id}}" class="btn btn-success float-right">Chi tiết tour</a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="title-index-parent">
            <h2 class="title-index">TOP GUIDE</h2>
        </div>
        
    </div>
</div>

@endsection

@section('script')
    <script>
        
        var present = document.getElementsByClassName("tourpresent");
        var timepublic = document.getElementsByClassName("tourtimepublic");

        var countclass = document.getElementsByClassName("tourtime");
        
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