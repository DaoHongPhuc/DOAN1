@extends('layout.index')

@section('content')

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
                <h2 class="title-index">CHI TIẾT TOUR</h2>
            </div>
            <div class="row border" style="border-radius: 10px; padding: 10px">
                <div class="col-md-4" style="border-right: 1px solid #ccc;">
                    <div class="boxtour">
                        <img src="./img/default.PNG" style="border-radius: 10px" alt="" height="250" width="">
                    </div>
                </div>
                <div class="col-md-4" style="border-right: 1px solid #ccc;">
                    <div class="title-index-parent">
                        <div class="title-detailtour">
                            <h4 style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">THÔNG TIN TOUR</h4>
                        </div>
                        <div class="content-detailtour">
                            <ul>   
                                <li>Người tạo: {{$tour->customer->name}}</li>
                                <li>Địa Điểm: {{$tour->diadiem}}</li>
                                <li>Ngày khởi hành: {{$tour->ngaykhoihanh}}</li>
                                <li>Lưu ý: 
                                    <span>{{$tour->note}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
                <div class="col-md-4" style="border-radius: 10px">
                    <div class="title-detailtour">
                        <h4 style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">THÔNG TIN NHẬN TOUR</h4>
                    </div>
                    <form action="guide/addjob/{{$tour->id}}" method="post">
                        <div class="form-group">
                            <label for="">Thời gian bắt đầu ( đơn vị là: giờ )</label>
                            <input type="number" min="7" max="20" value="7" name="starttime" class="form-control">
                            <small class="text-muted">vd: 7h</small>
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian kết thúc ( đơn vị là: giờ )</label>
                            <input type="number" min="7" max="20" value="20" name="endtime" class="form-control">
                            <small class="text-muted">vd: 20h</small>

                        </div>
                        <div class="form-group">
                            <label for="">Lương mỗi giờ ( $/h )</label>
                            <input type="number" min="1" max="15" value="1" name="price" class="form-control"
                            placeholder="Giá đề nghị">
                        </div>
                        @csrf
                        <input type="hidden" name="ngaykhoihanh" value="{{$tour->ngaykhoihanh}}">
                        <button type="submit" class="btn btn-success">Nhận Tour</button>
                    </form>
                </div>             
            </div>
        </div>
    </div>
</div>

@endsection