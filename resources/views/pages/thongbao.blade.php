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
                <h2 class="title-index">THÔNG BÁO GẦN ĐÂY</h2>
            </div>
            @foreach ($thongbao as $tb)
                <div class="p-3 mb-2" style="border: 1px solid yellow; border-radius: 10px;">
                    <span class="ml-3">{{$tb->noidung}}</span>
                </div>
            @endforeach
            
        </div>
    </div>
</div>

@endsection
