@extends('pages.customer.index')

@section('tour-content')
@php
    $c = $user->customer;
@endphp
<div class="title-index-parent">
    <h2 class="title-index">
        THÔNG TIN CÁ NHÂN
    <a href="customer/editinfor/{{$user->id}}/{{$c->id}}" class="float-right text-muted"><small>EDIT</small></a>
    </h2>
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

    <div class="clear"></div>
    <div class="container" style="font-family: 'Times New Roman', Times, serif">
        <div class="row">
            <div class="col-md-4 p-4" style="background-color: #b3b552">
                <div class="text-center">
                    <img src="./upload/traveller/{{$c->image}}" height="150" width="150" alt="" style="border-radius: 50%">
                </div>
                <div class="text-center mt-4">
                    <h2 style="" class="text-uppercase">{{$c->name}}</h2>
                    <small class="text-muted">
                        @php
                            if($user->level == 1){
                                echo 'KHÁCH HÀNG';
                            }else{
                                echo 'HƯỚNG DẪN VIÊN';

                            }
                        @endphp
                    </small>
                </div>
            </div>
            <div class="col-md-8" style="background-color: #eee">
                <div class="mt-4">
                    <h3 class="mb-3">CONTACT</h3>
                    <p><i class="fa fa-phone" aria-hidden="true"></i> {{$c->phone}}</p>
                    <p><i class="fa fa-home" aria-hidden="true"></i> {{$c->address}}</p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$user->email}}</p>
                    <p><i class="fa fa-venus-mars" aria-hidden="true"></i> 
                        @php
                            if($c->gender == 0){
                                echo 'NAM';
                            }else{
                                echo 'NỮ';

                            }
                        @endphp
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection