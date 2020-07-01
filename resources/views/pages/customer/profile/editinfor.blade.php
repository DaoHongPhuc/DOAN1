@extends('pages.customer.index')

@section('tour-content')
@php
    $u = $user;
    $c = $cus;
@endphp
<div class="title-index-parent">
    <h2 class="title-index">
        SỬA THÔNG TIN CÁ NHÂN
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
        <div class="row" >
            
            <div class="col-md-6">
                <form action="customer/editinfor/{{$u->id}}/{{$c->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="" value="{{$u->email}}" disabled>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="" disabled value="">
                    
                </div>
                <div class="form-group">
                    <label for="">Nhập lại Password</label>
                    <input type="password" name="repassword" class="form-control" placeholder="" disabled>
                    
                </div>
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" name="name" class="form-control" placeholder="" value="{{$c->name}}">
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" placeholder="" value="{{$c->address}}">
                    
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" placeholder="" value="{{$c->phone}}">
                    
                </div>
                <div class="form-group">
                    <label for="">Giới tính</label>
                    <select class="form-control" name="gender">
                        @php
                            if($c->gender == 0){
                                echo '
                                    <option value="0" selected>Nam</option>
                                    <option value="1">Nữ</option>
                                ';
                            }else{
                                echo '
                                    <option value="0" >Nam</option>
                                    <option value="1" selected>Nữ</option>
                                ';
                            }
                        @endphp
                        
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="">Ảnh Đại Diện</label>
                    <input type="file" name="image" class="form-control" placeholder="">
                    
                </div>
                
            </div>
                
        </div>
            <button type="submit" class="btn btn-success float-right">CẬP NHẬT</button>
            <div class="clear"></div>
        </form>
    </div>

@endsection