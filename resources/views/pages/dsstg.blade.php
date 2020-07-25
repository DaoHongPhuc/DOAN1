<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doan</title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/saptoi.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
</head>
<body>
    <div class="container-fluid">
        
        @include('layout.header')
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>TÊN KHÁCH HÀNG</th>
                        <th>LỊCH TRÌNH</th>
                        <th>ĐỊA ĐIỂM</th>
                        <th>THỜI GIAN BẮT ĐẦU</th>
                        <th>THỜI GIAN KẾT THÚC</th>
                        <th>SỐ TIỀN ĐẶT CỌC</th>
                        <th>TIỀN NHẬN MỖI GIỜ</th>
                        <th>SỐ TIỀN NHẬN</th>
                        <th>TRẠNG THÁI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datcoc as $key => $dc)
                    <tr>
                        <td scope="row">{{$key+1}}</td>
                        <td>
                            @php
                                foreach($alluser as $au){
                                    if($au->id == $dc->customer_id){
                                        echo $au->name;
                                    }
                                }
                            @endphp
                        </td>
                        <td>
                            @php
                                foreach($lichtrinh as $lt){
                                    if($lt->id == $dc->lichtrinh_id){
                                        echo $lt->name;
                                    }
                                }
                            @endphp
                        </td>
                        <td>
                            @php
                                foreach($hanhtrinh as $ht){
                                    if($ht->id == $dc->hanhtrinh_id){
                                        foreach ($diadiem as $dd) {
                                            if($ht->diadiem_id == $dd->id){
                                                echo $dd->name;
                                            }
                                        }
                                    }
                                }
                            @endphp
                        </td>
                        <td>{{$dc->starttime}}</td>
                        <td>{{$dc->endtime}}</td>
                        <td>{{$dc->total/2}}$</td>
                        <td>
                            @php
                                foreach($job as $j){
                                    if($dc->hanhtrinh_id == $j->hanhtrinh_id){
                                        echo $j->price.'$';
                                    }
                                }
                            @endphp
                            
                        </td>
                        <td>{{$dc->total}}$</td>
                        <td>
                            @if ($dc->present >= $dc->endtime)
                                <button type="button" class="text-white btn btn-success">Complete</button>
                            @else
                                @if ($dc->starttime <= $dc->present && $dc->present < $dc->endtime)
                                    <button type="button" class="text-white btn btn-warning">Processing  </button>
                                @else
                                    <button type="button" class="text-white btn btn-warning">waiting   </button>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
       

        @include('layout.footer')
        
    </div>

    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/all.js"></script>
    <script src="./js/moment.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
    <script src="./js/saptoi.js"></script>
    <script>
        function xacnhanhuyhanhtrinhdadatcoc(event){
            if(!confirm('Xác nhận hủy hành trình này ?')){
                event.preventDefault();
            }
        }
        function xacnhanhuytatcahanhtrinhdadatcoc(){
            if(!confirm('Xác nhận hủy tất cả hành trình trong lịch trình này ?')){
                event.preventDefault();
            }
        }
    </script>
</body>
</html>


