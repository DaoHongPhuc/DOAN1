@extends('pages.customer.index')

@section('tour-content')
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
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="title-index-parent">
                <h2 class="title-index">DANH SÁCH TOUR</h2>
            </div>
            <table data-toggle="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>ĐỊA ĐIỂM</th>
                    <th>NGÀY KHỞI HÀNH</th>
                    <th>LƯU Ý</th>
                    <th>CÔNG BỐ</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tour as $key => $t)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$t->diadiem}}</td>
                            <td>{{$t->ngaykhoihanh}}</td>
                            <td>{{$t->note}}</td>
                            <td>
                                @if ($t->statuspublic == 0)
                                    <a href="customer/public/{{$t->id}}" class="btn btn-warning text-white">KHÔNG</a>
                                @else
                                    <a href="customer/public/{{$t->id}}" class="btn btn-success text-white">CÓ</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <div class="title-index-parent">
                <h2 class="title-index">HƯỚNG DẪN VIÊN
                    <a class="float-right mt-2" href="customer/viewguideapply/{{$user->id}}/{{$t->id}}" style="color: black; 
                    text-decoration: none; font-size: 15px; color: gray;" title="reload"><i class="fas fa-sync-alt"></i></a>
                </h2>
                
            </div>
            <table data-toggle="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>NAME</th>
                    <th>NGÀY KHỞI HÀNH</th>
                    <th>PHAM VI THỜI GIAN</th>
                    <th>GIÁ</th>
                    <th>ĐẶT CỌC</th>
                </tr>
                </thead>
                <tbody>
                   
                    @foreach ($job as $key => $j)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @php
                                    foreach($guide as $key => $g){
                                        if($g->id == $j->guide_id){
                                            $guideid = $g->id;
                                            $nameguide = $g->name;
                                            $local = $g->local;
                                            $detaillocal = $g->detaillocal;
                                            $desself = $g->desself;
                                            $deslocal = $g->deslocal;
                                            echo ' <span class="" data-toggle="modal" data-target="#viewguide">'.$g->name.'</span>';
                                            break;
                                        }
                                    }
                                @endphp
                            </td>
                            <td>{{$j->ngaykhoihanh}}</td>
                            <td>
                                {{$j->temp_starttime}}h -> {{$j->temp_endtime}}h
                            </td>
                            <td>{{$j->price}}$/h</td>
                            <td>
                                @php
                                    $range = $j->temp_endtime - $j->temp_starttime;
                                    $cost = $range * ($j->price);
                                    $datcoc = $cost * 0.5;
                                @endphp
                                <form action="customer/cusdatcoc/{{$user->customer->id}}/{{$j->tour_id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="starttime" value="{{$j->starttime}}">
                                    <input type="hidden" name="endtime" value="{{$j->endtime}}">
                                    <input type="hidden" name="cost" value="{{$datcoc}}">
                                    <button type="submit" class="btn btn-info" onclick="cus_datcoc({{$datcoc}})" >
                                        {{$datcoc}}$
                                    </button>
                                </form>
                                
                            </td>
                        </tr>
                        <div class="modal fade" id="viewguide" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">{{$nameguide}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>GIỚI THIỆU BẢN THÂN</h6>
                                        <ul>
                                            <li>Địa điểm: {{$local}}</li>
                                            <li>Lịch trình: {{$detaillocal}}</li>
                                            <li>Mô tả lịch trình: {{$deslocal}}</li>
                                            <li>Mô tả bản thân: {{$desself}}</li>
                                        </ul>
                                    </div>
                                    <div class="modal-divide" style="margin: 0 !important; padding: 0 !important;">
                                        <div class="title-index-parent-r">
                                            <h5 class="title-index-r pl-3">BÌNH LUẬN</h5>
                                        </div>
                                        <div class="boxbl">
                                            <div class="container">
                                                @php
                                                
                                                foreach ($binhluan as $key => $bl){
                                                    if($bl->guide_id == $j->guide_id){
                                                        foreach ($customer as $key => $c) {
                                                            if($c->id == $bl->cus_id){
                                                    echo ' <div class="row mb-2">
                                                    <div class="col-md-3" style="text-align: right">';
                                                                echo '<img class="img-responsive" height="60" width="60" 
                                                                src="./upload/traveller/'.$c->image.'" style="border-radius: 50%" alt="">';
                                                    echo '</div>
                                                    <div class="col-md-9" style="padding-left: 0px !important">';
                                                                echo '<span class=""> '.$c->name.' <small> '.$bl->created_at.' </small></span>';
                                                            }
                                                        }
                                                                echo '<p class="p-2">'.$bl->noidung.'</p>';
                                                    echo '</div>
                                                    </div>';
                                                    }
                                                    
                                                }
                                                @endphp         
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="customer/comment/{{$user->customer->id}}/{{$guideid}}" method="POST">
                                            <textarea name="noidung" class="form-control" cols="30" rows="2"></textarea>
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Comment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function cus_datcoc($datcoc){
        var checcdc = confirm('Xác nhận đặt cọc tour này với '+$datcoc+'$ ?');
        if(checcdc != true){
            event.preventDefault();
        }
    }
</script>
@endsection
