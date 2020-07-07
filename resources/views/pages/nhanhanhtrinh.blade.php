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
                <h2 class="title-index">LỊCH TRÌNH {{$lichtrinh->name}}</h2>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                <p>Khách hàng: {{$lichtrinh->user->name}}</p>
                    <p>HÀNH TRÌNH: 
                        @foreach ($diadiem as $dd)
                            @if ($dd->id == $hanhtrinh->diadiem_id)
                                {{$dd->name}}
                            @endif
                        @endforeach
                    </p>
                    <p>NGÀY KHỞI HÀNH: {{$hanhtrinh->ngaykhoihanh}}</p>
                </div>
                <div class="col-md-6">
                    <form action="nhanhanhtrinh/{{$hanhtrinh->id}}" method="POST">
                        <input type="hidden" name="idlichtrinh" value="{{$lichtrinh->id}}">
                        <div class="form-group">
                            <label for="">Thời gian bắt đầu trong ngày</label>
                            <input type="number" value="7" min="7" autofocus max="20" name="starttime" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian Kết thúc trong ngày</label>
                            <input type="number" value="20" min="7" max="20" name="endtime" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Lương mỗi giờ ($/h)</label>
                            <input type="number" value="1" min="1" max="15" name="price" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        @csrf
                        <input type="hidden" name="ngaykhoihanh" value="{{$hanhtrinh->ngaykhoihanh}}">
                        <button type="submit" class="btn btn-success">Nhận hành trình</button>
                        <a href="chitietlichtrinh/{{$lichtrinh->id}}" class="btn btn-info">Trở về chi tiết lịch trình</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
