@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">DANH SÁCH CHI TIẾT ĐỊA ĐIỂM</h1>
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
            <th>ĐỊA ĐIỂM</th>
            <th>NAME</th>
            <th>STATUS</th>
            <th>CREATED_AT</th>
            <th>OPTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dtdiadiem as $key => $dtdd)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$dtdd->id}}</td>
                <td>{{$dtdd->diadiem->name}}</td>
                <td>{{$dtdd->name}}</td>
                <td>
                    @if ($dtdd->status == 0)
                        {{'Không công bố'}}
                    @else
                        {{'Công bố'}}
                    @endif
                </td>
                <td>{{$dtdd->created_at}}</td>
                <td>
                    <button type="button" data-id="{{$dtdd->id}}" class="btn btn-success editdtplace" data-toggle="modal" data-target="#editdetaildd">
                        <i class="fas fa-edit"></i>
                    </button>
                    <a href="admin/huydtplace/{{$dtdd->id}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
            </tr>
        @endforeach
        
        <div class="modal fade" id="editdetaildd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">CẬP NHẬT CHI TIẾT ĐỊA ĐIỂM</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form action="admin/editdtplace/{{$dtdd->id}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Địa Điểm</label>
                                <select class="form-control diadiem" name="diadiem">
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tên chi tiết địa điểm</label>
                                <input type="text" class="form-control name" name="name" 
                                placeholder="Nhập tên chi tiết địa điểm" aria-describedby="fileHelpId">
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
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
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
            $(".editdtplace").click(function (e) { 
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "admin/editdtplace/"+ id,
                    dataType: "json",
                    success: function (data) {
                        $(".name").val(data.dtdiadiem.name);
                        if(data.dtdiadiem.status === 1){
                            $(".cb").attr('selected','selected');
                        }else{
                            $(".kcb").attr('selected','selected');
                        }

                        let html = '';
                        $.each(data.diadiem, function (key, value) { 
                            if(data.dtdiadiem.diadiem_id == value['id']){
                                html += '<option value="'+value['id']+'" selected="selected">';
                                    html += value['name'];
                                html += '</option>';
                            }else{
                                html += '<option value="'+value['id']+'">';
                                    html += value['name'];
                                html += '</option>';
                            }
                        });
                        $('.diadiem').html(html);
                    }
                });
            });
        });
    </script>
@endsection