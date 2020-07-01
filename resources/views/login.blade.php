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
            <div class="row mt-5">
                <div class="col-md-4"></div>
                <div class="col-md-4 border" style="border-radius: 10px; box-shadow: inset 0px 0px 0px 2px #ccc">
                        <div class="login-title" style="width: 100%">
                            <h5 class="mt-3">ĐĂNG NHẬP</h5>
                            <hr>
                        </div>
                        
                        <div class="login-content">
                            <form action="loginkh" method="post">
                                @csrf
                                <input type="email" class="form-control" name="email" placeholder="Email" autofocus> <br>
                                <input type="password" class="form-control" name="password" placeholder="Password"> <br>
                                <input type="checkbox">  <span>  Lưu tài khoản</span>
                        </div>
                        <div class="login-footer pb-2">
                            <hr>
                                <button type="submit" class="btn btn-success float-right">Đăng nhập</button>
                            </form>
                        <div class="clear"></div>

                        </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4"></div>
                <div class="col-md-4 border" style="border-radius: 10px; box-shadow: inset 0px 0px 0px 1px #ccc">
                    <p class="mt-3">
                        Chưa có tài khoản ? 
                        <a href="registerkh" class="float-right">Đăng ký ngay !</a>
                    </p>   
                    <hr>
                    <p>
                        Quên mật khẩu ? 
                        <a href="forgetpassword" class="float-right">Lấy lại Password !</a>
                    </p>
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

</body>
</html>