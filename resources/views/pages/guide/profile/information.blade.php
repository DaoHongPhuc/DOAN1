@extends('pages.guide.index')

@section('job-content')

@php
    $g = $user->guide;
@endphp

<div class="title-index-parent">
    <h2 class="title-index">
        THÔNG TIN CÁ NHÂN
        <a href="guide/editinfor/{{$user->id}}/{{$g->id}}" class="float-right text-muted"><small>EDIT</small></a>
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
                <img src="./upload/guide/{{$g->image}}" height="150" width="150" alt="" style="border-radius: 50%">
            </div>
            <div class="mt-4">
                <h4 class="mb-3">CONTACT</h4>
                <p><i class="fa fa-phone" aria-hidden="true"></i> {{$g->phone}}</p>
                    <p><i class="fa fa-home" aria-hidden="true" style=""></i> {{$g->address}}</p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$user->email}}</p>
                    <p><i class="fa fa-venus-mars" aria-hidden="true"></i> 
                        @php
                            if($g->gender == 0){
                                echo 'NAM';
                            }else{
                                echo 'NỮ';

                            }
                        @endphp
                    </p>
            </div>
        </div>
        <div class="col-md-8" style="background-color: #eee">
            <div class="text-center mt-4">
                <h2>ĐÀO HỒNG PHÚC</h2>
                <small class="text-muted">HƯỚNG DẪN VIÊN</small>
            </div>
            <hr>
            <div class="mt-4">
                <h4 class="">ĐỊA ĐIỂM</h4>
                <p class="p-2">
                    {{$g->local}}
                </p>
            </div>
            <div class="mt-4">
                <h4 class="">LỊCH TRÌNH</h4>
                <p class="p-2">
                    {{$g->detaillocal}}
                </p>
            </div>
            <div class="mt-4">
                <h4 class="">MÔ TẢ BẢN THÂN</h4>
                <p class="p-2">
                    {{$g->desself}}
                </p>
            </div>
            
            <div class="mt-4">
                <h4 class="">MÔ TẢ LỊCH TRÌNH</h4>
                <p class="p-2">
                    {{$g->deslocal}}
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="title-index-parent">
                <h2 class="title-index">BÌNH LUẬN</h2>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    @php
                        foreach($binhluan as $bl){
                            foreach($customer as $c){
                                if($bl->cus_id == $c->id){
                                    echo '
                                    <div class="row">
                                        <div class="col-md-3" style="text-align: right">
                                            <img src="./upload/traveller/'.$c->image.'" style="border-radius: 50%;" alt="" height="60" width="60" >
                                        </div>
                                        <div class="col-md-9" style="padding-left: 0px !important">
                                            <span>'.$c->name.' <small> '.$bl->created_at.'</small></span>
                                            <p class="p-2">'.$bl->noidung.'</p>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        }
                    @endphp
                    
                </div>
            </div>
            {{-- <div class="row mb-2">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3" style="text-align: right">
                            <img src="./img/default.PNG" style="border-radius: 50%;" alt="" height="60" width="60" >
                        </div>
                        <div class="col-md-9" style="padding-left: 0px !important">
                            <span>Ho va Ten</span>
                            <p class="p-2">Noi Dung</p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection