<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADMIN DASHBOARD</title>
	<base href="{{asset('')}}">
	<link href="./admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="./admin/css/font-awesome.min.css" rel="stylesheet">
	<link href="./admin/css/datepicker3.css" rel="stylesheet">
	<link href="./admin/css/styles.css" rel="stylesheet">
	
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('admin.layout.header')
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                @include('admin.layout.menu')

            </div>
            <div class="col-md-10">
                @yield('content')
            </div>
        </div>
    </div>
    
	<script src="./admin/js/jquery-1.11.1.min.js"></script>
	<script src="./admin/js/bootstrap.min.js"></script>
	<script src="./admin/js/chart.min.js"></script>
	<script src="./admin/js/chart-data.js"></script>
	<script src="./admin/js/easypiechart.js"></script>
	<script src="./admin/js/easypiechart-data.js"></script>
	<script src="./admin/js/bootstrap-datepicker.js"></script>
	<script src="./admin/js/custom.js"></script>
		
</body>
</html>