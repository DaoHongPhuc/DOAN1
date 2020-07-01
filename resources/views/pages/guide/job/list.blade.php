@extends('pages.guide.index')

@section('job-content')
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
    <h2 class="title-index">DANH SÁCH JOB</h2>
</div>
    <table data-toggle="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>LƯƠNG</th>
            <th>NGÀY KHỞI HÀNH</th>
            <th>THỜI GIAN BẮT ĐẦU</th>
            <th>THỜI GIAN KẾT THÚC</th>
            <th>TUỲ CHỌN</th>
            <th>TRẠNG THÁI</th>
        </tr>
        </thead>
        <tbody>
            
            @foreach ($job as $key => $j)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$j->price}}$/h</td>
                    <td>{{$j->ngaykhoihanh}}</td>
                    <td>{{$j->starttime}}</td>
                    <td>{{$j->endtime}}</td>
                    <!-- Button trigger modal -->
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="editjob" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">EDIT JOB</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <form action="guide/editjob/{{$j->id}}" method="post">
                                        <div class="form-group">
                                            <label for="">Thời gian bắt đầu ( đơn vị là: giờ )</label>
                                            <input type="number" min="7" max="20" value="7" name="starttime" 
                                            value="{{$j->starttime}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Thời gian kết thúc ( đơn vị là: giờ )</label>
                                            <input type="number" min="7" max="20" value="20" name="endtime" 
                                            value="{{$j->endtime}}" class="form-control">
                
                                        </div>
                                        <div class="form-group">
                                            <label for="">Lương mỗi giờ ( $/h )</label>
                                            <input type="number" min="1" max="15" name="price" 
                                            value="{{$j->price}}" class="form-control"
                                            placeholder="Giá đề nghị">
                                        </div>
                                        @csrf
                                        <input type="hidden" name="ngaykhoihanh" value="{{$j->ngaykhoihanh}}">
                                </div>
                                <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $flask = false;
                        foreach($tour as $t){
                            if($t->id == $j->tour_id){
                                $flask = true;
                                break;
                            }else{
                                $flask = false;
                            }
                        }
                    @endphp
                    @php
                        $range = $j->temp_endtime - $j->temp_starttime;
                        $cost = $range * ($j->price);
                        $datcoc = $cost * 0.5;
                    @endphp
                    @php
                        foreach($tabledatcoc as $tbldatcoc){
                            if($tbldatcoc->tour_id == $j->tour_id){
                                $idtbldatcoc = $tbldatcoc->id;
                                break;
                            }
                        }
                    @endphp
                    <td>
                        @if ($flask != true)
                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#editjob">
                                <i class="fas fa-edit"></i>
                            </button>
                        @endif
                        
                        <a href="guide/huytour/{{$j->id}}" onclick="guidehuyjob()" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                    <td>
                       
                        @if ($flask == true)
                            <form action="guide/guidedatcoc/{{$j->guide_id}}/{{$j->id}}/{{$idtbldatcoc}}" method="post">
                                <input type="hidden" name="cost" value="{{$datcoc}}">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="guidedatcoc({{$datcoc}})">{{$datcoc}}$</button>
                            </form>
                        @else
                            <button class="btn btn-info">Chờ Xác Nhận ..</button>
                        @endif
                    </td>
                </tr>
                
            @endforeach

        </tbody>
    </table>
    <script>
        function guidedatcoc($datcoc){
            var gdc = confirm('Xác nhận đặt cọc công việc này với '+$datcoc+'$ ?');
            if(gdc != true){
                event.preventDefault();
            }
        }

        function guidehuyjob(event){
            var ghj = confirm('Xác nhận hủy công việc ?');
            if(ghj != true){
                event.preventDefault();
            }
        }
    </script>

@endsection

   