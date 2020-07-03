@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">THÊM CHI TIẾT ĐỊA ĐIỂM</h1>
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
            <form action="admin/adddtplace" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Chọn Địa Điểm</label>
                    <select class="form-control" name="diadiem">
                        @foreach ($diadiem as $dd)
                            <option value="{{$dd->id}}">{{$dd->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tên chi tiết địa điểm</label>
                    <input type="text" class="form-control" name="name" 
                    placeholder="Nhập tên chi tiết địa điểm" aria-describedby="fileHelpId">
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