@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">DANH SÁCH ĐỊA ĐIỂM</h1>
    </div>
</div><!--/.row-->
@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $err)
            {{$err}}. <br>
        @endforeach
    </div>
@endif

@if(session('thongbao'))
    <div class="alert alert-success" role="alert">
        {{session('thongbao')}}
    </div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>NAME</th>
            <th>IMAGE</th>
            <th>STATUS</th>
            <th>CREATED_AT</th>
            <th>OPTION</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($diadiem as $key => $dd)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$dd->id}}</td>
                <td>{{$dd->name}}</td>
                <td>
                    <img src="./upload/place/{{$dd->image}}" height="100" width="100" alt="">
                </td>
                <td>
                    @if ($dd->status == 0)
                        {{'Không công bố'}}
                    @else
                        {{'Công bố'}}
                    @endif
                </td>
                <td>{{$dd->created_at}}</td>
                <td>
                    <button class="btn btn-success editplace" 
                    data-toggle="modal" 
                    data-target="#modelId"
                    data-id="{{$dd->id}}"
                    >
                        <i class="fas fa-edit"></i></button>
                    <a href="admin/huyplace/{{$dd->id}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
                
                
            </tr>
        @endforeach
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Cập Nhật Địa Điểm</h2>
                    </div>
                    <div class="modal-body">
                        <form action="admin/editplace/{{$dd->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên Địa Điểm</label>
                                <input type="text" name="name" class="form-control name" 
                                placeholder="Nhập tên địa điểm" value="" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                              <label for="">Hình Ảnh</label> 
                              <p><img src="" class="image" alt="" height="100" width="100"></p>
                              <input type="file" class="form-control-file" name="image" placeholder="" 
                              aria-describedby="fileHelpId" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Trạng Thái</label>
                                <select class="form-control" name="status">
                                    <option value="0" class="kcb">Không công bố</option>
                                    <option value="1" class="cb">Công bố</option>
                                </select>
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">CẬP NHẬT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </tbody>
</table>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".editplace").click(function (e) { 
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "admin/editplace/"+ id,
                    dataType: "json",
                    success: function (data) {
                        $(".name").val(data.diadiem.name);
                        $(".image").val(data.diadiem.image);
                        $(".image").attr('src','./upload/place/'+data.diadiem.image);
                        if(data.diadiem.status === 1){
                            $(".cb").attr('selected','selected');
                        }else{
                            $(".kcb").attr('selected','selected');
                        }
                    }
                });
            });
        });
    </script>
@endsection

