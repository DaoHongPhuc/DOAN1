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
                        <h2 class="title-index">HÀNH TRÌNH ĐÃ ĐẶT CỌC SẼ DIỄN RA</h2>
                    </div>

               

                    <div class="container">
                        <div class="accordion">
                            <dl>
                                @foreach ($lichtrinh as $key => $lt)
                                    <dt><a href="#accordion{{$key+1}}" aria-expanded="false" aria-controls="accordion1" 
                                        class="accordion-title accordionTitle js-accordionTrigger">LỊCH TRÌNH {{$lt->name}}</a></dt>
                                    <dd class="accordion-content accordionItem is-collapsed" id="accordion{{$key+1}}" aria-hidden="true">
                                        {{-- noidung --}}
                                        
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>TÊN HÀNH TRÌNH</th>
                                                    <th>TÊN HƯỚNG DẪN VIÊN</th>
                                                    <th>TÊN KHÁCH HÀNG</th>
                                                    <th>BẮT ĐẦU</th>
                                                    <th>KẾT THÚC</th>
                                                    @if ($user->level == 2)
                                                        <th>TỔNG GIÁ TRỊ HÀNH TRÌNH</th>
                    
                                                        <th>NHẬN ĐƯỢC ( ĐÃ TÍNH CỌC)</th>
                                                    @endif
                                                    @if ($user->level == 1)
                                                        <th>CHI PHÍ ( ĐÃ TÍNH CỌC)</th>
                                                    @endif
                                                    <th>HOÀN CỌC</th>
                                                    <th>TRẠNG THÁI</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datcoc as $key => $dc)
                                                    @if ($dc->lichtrinh_id == $lt->id)
                                                    <tr>
                                                        <td scope="row">{{$key + 1}}</td>
                                                        <td>
                                                            @php
                                                                foreach($hanhtrinh as $ht){
                                                                    if($ht->id == $dc->hanhtrinh_id){
                                                                        foreach ($diadiem as $dd) {
                                                                            if($dd->id == $ht->diadiem_id){
                                                                                echo $dd->name;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            @php
                                                                foreach($alluser as $au){
                                                                    if($au->id  ==  $dc->guide_id){
                                                                        echo $au->name;
                                                                    }
                                                                }
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            @php
                                                            foreach($alluser as $au){
                                                                if($au->id  == $dc->customer_id){
                                                                    echo $au->name;
                                                                }
                                                            }
                                                        @endphp
                                                        </td>
                                                        <td>{{$dc->starttime}}</td>
                                                        <td>{{$dc->endtime}}</td>
                                                        
                                                        @if ($user->level == 2)
                                                            <td>{{$dc->total}}$</td>
                                                            <td>
                                                                @php
                                                                    $tongchiphi = $dc->total;
                                                                    echo $tongchiphi += $dc->total/2;
                                                                    echo "$";
                                                                @endphp
                                                            </td>
                                                        @endif
                                                        @if ($user->level == 1)
                                                            <td>{{$dc->total}}$</td>
                                                            
                                                        @endif
                                                        <td>
                                                            @php
                                                                $starttime = strtotime($dc->starttime);
                                                                $present = strtotime($dc->present);

                                                                $result = $starttime - $present;
                                                                if($result >= 864000){
                                                                    $hoancoc = "(100%) " . $dc->total/2 . '$';
                                                                    $heso = 0.5;
                                                                    echo $hoancoc;
                                                                }else{
                                                                    if($result <= 432000){
                                                                        $hoancoc = "(0%) ". $dc->total * 0 . '$';
                                                                        $heso = 0;
                                                                        echo $hoancoc;
                                                                    }else {
                                                                        $hoancoc = "(50%) ". $dc->total/4 . '$';
                                                                        $heso = 0.25;
                                                                        echo $hoancoc;
                                                                    }
                                                                }
                                                            @endphp
                                                        </td>
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
                                                            
                                                            @if ($user->level != 2)
                                                                <form action="huy1hanhtrinhdacoc/{{$dc->id}}/{{$dc->guide_id}}/{{$dc->customer_id}}" method="post">
                                                                    <input type="hidden" value="{{$heso}}" name="heso">
                                                                    @csrf
                                                                    <button type="submit" onclick="xacnhanhuyhanhtrinhdadatcoc(event)" 
                                                                    class="btn btn-danger float-right m-3"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                        @if ($user->level == 1)
                                        <a onclick="xacnhanhuytatcahanhtrinhdadatcoc(event)" href="huyallhanhtrinhdacoc/{{$lt->id}}" class="btn btn-danger float-right">
                                            Hủy Toàn Bộ</a>
                                        <div class="clear"></div>
                                        @endif
                                        
                                        </dd>
                                @endforeach
                            </dl>
                        </div>
                    </div>

                    
                    
                </div>
            </div>
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


