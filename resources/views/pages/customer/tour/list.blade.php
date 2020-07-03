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
        <div class="col-md-8">
            <div class="title-index-parent">
                <h2 class="title-index">DANH SÁCH TOUR</h2>
            </div>
            <table data-toggle="table">
                <thead>
                <tr>
                    <th class="parent-linetour"><span class="start-linetour">Start</span></th>
                    <th>ĐỊA ĐIỂM</th>
                    <th>CÔNG BỐ</th>
                    <th>OPTIONS</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <div class="modal fade" id="detailtour" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">THÔNG TIN TOUR</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Địa Điểm:</b> <span class="diadiem"></span></p> 
                                    <p><b>Ngày khởi hành:</b> <span class="ngaykhoihanh"></span></p> 
                                    <p><b>Lưu ý:</b> <span class="luuy"></span></p> 
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($tour as $key => $t)
                        <tr >
                            <td class="parent-linetour">
                                <span class="linetour"></span><span class="content-linetour">{{$key+1}}</span>
                            </td>
            
                            
                            <td>
                                <span data-toggle="modal" data-id="{{$t->id}}" data-target="#detailtour" class="detailtour">
                                    {{$t->diadiem}}
                                </span>
                            </td>
                            <td>
                                @if ($t->statuspublic == 0)
                                    <a href="customer/public/{{$t->id}}" class="btn btn-warning text-white">KHÔNG</a>
                                @else
                                <a href="customer/public/{{$t->id}}" class="btn btn-success text-white">CÓ</a>
                                @endif
                            </td>


                            
                            <td>
                                @if ($t->statuspublic == 0)
                            <span data-toggle="modal" class="btn btn-success edittour" data-id="{{$t->id}}" data-target="#edittour">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </span>
                                @endif
                                <a onclick="customerhuytour(event)" href="customer/huytour/{{$t->id}}" 
                                    class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                
                            </td>
                            <td><a href="customer/viewguideapply/{{$user->id}}/{{$t->id}}" style="color: black; text-decoration: none;">HDV</a> 
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                               
                            </td>
                        </tr>
                    @endforeach
                    <div class="modal fade" id="edittour" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">CẬP NHẬT TOUR</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="customer/edittour/{{$t->id}}" method="post">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Địa Điểm Muốn Đến</label>
                                            <input value="" type="text" name="diadiem" 
                                            class="form-control diadiem" placeholder="" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Ngày Khởi Hành</label>
                                                <input value="" type="date" 
                                                name="ngaykhoihanh" class="form-control ngaykhoihanh" placeholder="" 
                                                aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Lưu ý</label>
                                                <textarea name="note" class="form-control note" 
                                                rows="5"></textarea>
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">LƯU</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="title-index-parent">
                <h2 class="title-index">HƯỚNG DẪN VIÊN</h2>
            </div>
            
        </div>
    </div>
</div>
   <script>
        function customerhuytour(event){
            var checkcht = confirm('Xác nhận hủy tour ?'); 
            if(checkcht != true){
                event.preventDefault();
            }
        }
   </script>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".detailtour").click(function (e) { 
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "customer/detailtour/"+id,
                    dataType: "json",
                    success: function (data) {
                        $(".diadiem").html(data.tour.diadiem);
                        $(".ngaykhoihanh").html(data.tour.ngaykhoihanh);
                        $(".luuy").html(data.tour.note);
                    }
                });                
            });
            $(".edittour").click(function (e) { 
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "customer/edittour/"+id,
                    dataType: "json",
                    success: function (data) {
                        $(".diadiem").val(data.tour.diadiem);
                        $(".ngaykhoihanh").val(data.tour.ngaykhoihanh);
                        $(".note").val(data.tour.note);
                    }
                });                
            });
            
        });
    </script>
@endsection