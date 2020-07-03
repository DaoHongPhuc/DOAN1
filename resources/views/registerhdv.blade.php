<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doan</title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.css">
</head>
<body>
    <div class="container-fluid">
        @include('layout.header')
        <div class="container border p-3 mt-3 mb-1" style="border-radius: 10px; box-shadow: 0px 0px 0px 2px #ccc;">
            <div class="row">
                <div class="col-md-12">
                    <span class="mr-3">Bạn là ai ?</span>
                    <a href="registerkh" class="mr-2">Khách Hàng</a> 
                    <a href="registerhdv">Hướng Dẫn Viên</a> 
                </div>
            </div>
        </div>
        <div class="container border p-3 mt-3 mb-5" style="border-radius: 10px; box-shadow: 0px 0px 0px 2px #ccc;">
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
            <div class="row">
                <div class="col-md-12">
                    <h4>ĐĂNG KÝ TÀI KHOẢN HƯỚNG DẪN VIÊN</h4>
                </div>
            </div>
            <hr>
            <div class="row" >
                <div class="col-md-6">
                    <form action="registerhdv" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Nhập lại Password</label>
                        <input type="password" name="repassword" class="form-control" placeholder="">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input type="text" name="name" class="form-control" placeholder="">
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" placeholder="">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" placeholder="">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Giới tính</label>
                        <select class="form-control" name="gender">
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" name="image" class="form-control" placeholder="">
                    </div>
                    
                </div>
                <hr>
            </div>
            <hr>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Địa điểm hướng dẫn của bạn</label>
                        <select class="form-control local" name="local" >
                            <option value="">Chọn địa điểm của bạn</option>

                            @foreach ($diadiem as $dd)
                                <option value="{{$dd->id}}">{{$dd->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Lịch trình hướng dẫn của bạn</label>
                        <select class="form-control detaillocal" name="detaillocal" >
                            @foreach ($detaildd as $dtdd)
                            <option value="{{$dtdd->id}}">{{$dtdd->name}}</option>
                                
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Mô tả Bản thân</label>
                        <br>
                        <textarea name="desself"  cols="71" rows="5" class="" style=""></textarea>                        
                    </div>
                    <div class="form-group">
                        <label for="">Sơ lược về lịch trình</label>
                        <textarea name="deslocal"  cols="71" rows="5" class="" style=""></textarea>                        
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <a href="login">
                        <i class="fa fa-angle-left" aria-hidden="true"></i><i class="fa fa-angle-left" aria-hidden="true"></i>
                        ĐĂNG NHẬP
                    </a>
                        <button type="submit" class="btn btn-success float-right">Đăng Ký</button>
                    </form>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        
    </div>

    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/all.js"></script>
    <script src="./js/districts.min.js"></script>
    <script src="./js/script.js"></script>
    <script>
        $(document).ready(function () {
            $(".local").change(function (e) { 
                e.preventDefault();
                let id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "detaildd",
                    data: {
                        diadiemid : id,
                    },
                    dataType: "json",
                    success: function (data) {
                        let html = '';
                        $.each(data.detaildd, function (key, value) { 
                            html += '<option value="'+value['id']+'">';
                                html += value['name'];
                            html += '</option>';
                        });
                        $('.detaillocal').html(html);
                    }
                });
            });
        });
    </script>
    @yield('script')

   
</body>
</html>