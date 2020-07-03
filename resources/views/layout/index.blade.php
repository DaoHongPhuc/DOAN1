<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doan</title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
</head>
<body>
    <div class="container-fluid">
        
        @include('layout.header')
       
        @yield('content')

        {{-- footer --}}
        @include('layout.footer')
        
    </div>

    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/all.js"></script>
    <script src="./js/moment.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
    {{-- <script src="./js/districts.min.js"></script> --}}
    <script src="./js/script.js"></script>
    @yield('script')
</body>
</html>