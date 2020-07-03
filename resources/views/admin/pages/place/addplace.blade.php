@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">THÊM ĐỊA ĐIỂM</h1>
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
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <form action="admin/addplace" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Tên Địa Điểm</label>
                    <input type="text" name="name" class="form-control" 
                    placeholder="Nhập tên địa điểm" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="">Hình Ảnh</label>
                  <input type="file" class="form-control-file" name="image" placeholder="" 
                  aria-describedby="fileHelpId">
                </div>
                <div class="form-group">
                    <label for="">Trạng Thái</label>
                    <select class="form-control" name="status">
                        <option value="0" selected>Không công bố</option>
                        <option value="1">Công bố</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">THÊM</button>
            </form>
        </div>
    </div>
</div>
@endsection