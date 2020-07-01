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
<div class="title-index-parent">
    <h2 class="title-index">TOUR ĐẶT CỌC</h2>
</div>
    <table data-toggle="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>ĐỊA ĐIỂM</th>
            <th>TIỀN PHẢI TRẢ</th>
            <th>BẮT ĐẦU</th>
            <th>KẾT THÚC</th>
            <th>HOÀN CỌC</th>
            <th>TÙY CHỌN</th>
            <th>TRẠNG THÁI</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($datcoc as $key => $dc)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        @foreach ($tour as $t)
                            @if ($t->id == $dc->tour_id)
                                {{$t->diadiem}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$dc->sumcost}}$</td>
                    <td>{{$dc->openline}}</td>
                    <td>{{$dc->deadline}}</td>
                    <td>
                        @php
                        $present = strtotime($dc->present);
                        $openline = strtotime($dc->openline);
                        $deadline = strtotime($dc->deadline);
                        if($openline-$present < 864000){
                            if( $openline-$present > 432000){
                                echo "50%";
                            }else{
                                echo "0%";
                            }
                        }else{
                            echo "100%";
                        }
                    @endphp
                    </td>
                    <td>
                        <a onclick="cushuycoc(event)" href="customer/huycoc/{{$dc->id}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                    <!-- Button trigger modal -->
          
                    
                    <!-- Modal -->
                    <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Báo cáo Tour</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    
                                    @php
                                        foreach ($customer as $key => $c) {
                                            if($c->id == $dc->cus_id){
                                                $namec = $c->name;
                                                break;
                                            }
                                        }
                                        foreach ($tour as $key => $t) {
                                            if($t->id == $dc->tour_id){
                                                $diadiem = $t->diadiem;
                                                break;

                                            }
                                        }
                                    @endphp
                                    <form action="customer/report/{{$dc->cus_id}}/{{$dc->guide_id}}/{{$dc->tour_id}}" method="post">
                                        @csrf
                                        <p>Người gửi: <b>{{$namec}}</b></p>  
                                        <p>Tour: <b>{{$diadiem}}</b></p> 
                                        <div class="form-group">
                                          <label for="">Nội dung</label>
                                          <textarea name="noidung" class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-warning text-white" type="submit">Gửi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <td>
                        @if ($dc->present < $dc->deadline)
                            @if ($dc->present < $dc->openline)
                                <button class="btn btn-warning text-white">Đang chờ</button>
                            @else
                                <button class="btn btn-primary text-white">Đang tính giờ</button>
                                <button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#report">
                                    Tố cáo
                                </button>
                                <a href="customer/endtour/{{$dc->id}}/{{$dc->cus_id}}/{{$dc->guide_id}}" class="btn btn-danger text-white">Kết thúc</a>
                            @endif
                        @else
                            <button class="btn btn-success text-white">Hoàn Thành</button>
                        @endif
                            
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        function cushuycoc(event){
           var chc = confirm('Xác nhận hủy công việc ?');
           if(chc != true){
               event.preventDefault();
           }
       }
   </script>
@endsection