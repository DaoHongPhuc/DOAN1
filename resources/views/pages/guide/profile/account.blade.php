@extends('pages.guide.index')

@section('job-content')
@php
    $g = $user->guide;
@endphp
<div class="title-index-parent">
    <h2 class="title-index">TÀI KHOẢN</h2>
</div>
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
<div class="p-3" style="border-radius: 10px; border: 1px solid yellow; font-family: 'Times New Roman', Times, serif;">
<span>Tài khoản của bạn là: {{$g->money}}$</span>
</div>
<div class="p-3 mt-2" style="border-radius: 10px; border: 1px solid yellow; font-family: 'Times New Roman', Times, serif;">
    <form action="guide/account/{{$user->id}}/{{$g->id}}" method="post">
        <div class="form-group">
            <label for="">NẠP TÀI KHOẢN</label>
            <input type="text" name="money" class="form-control" placeholder="Nhập số tiền">
            @csrf
            <button type="submit" class="btn btn-success mt-2 float-right">NẠP</button>
        </div>
        <div class="clear"></div>
    </form>
</div>
@endsection