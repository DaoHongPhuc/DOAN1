@extends('layout.index')

@section('content')
@php
if(Auth::check()){
    $user = Auth::user();
    $taikhoan = $user->taikhoan;
}else{
    $taikhoan = "";
}
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
                <div class="alert alert-success" role="alert">
                    {{session('thongbao')}}
                </div>
            @endif
            
            <div class="title-index-parent">
                <h2 class="title-index">TÀI KHOẢN CỦA BẠN</h2>
            </div>

            <p class="p-3" style="border-radius: 10px; border: 1px solid yellow">
                Tài khoản của bạn là: {{$taikhoan}}$
            </p>
            <form action="taikhoan" method="post">
                <div class="col-md-5 p-3" style="border-radius: 10px; border: 1px solid yellow">                        
                    @csrf
                    <label for="">Nạp Tài Khoản</label>
                    <input type="text" class="form-control" name="money" placeholder="Nhập số tiền">
                    <br>
                    <button type="submit" class="btn btn-primary ">Nạp</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
