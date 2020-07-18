@extends('admin.layout.index')

@section('content')
<h1>ADD USER</h1>
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

<hr>


<div class="row" >
    <div class="col-md-6">
       
        <form action="admin/adminregister" id="formregister" method="post" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" placeholder="">
            
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Họ và tên</label>
            <input type="text" name="name" class="form-control" placeholder="">
            
        </div>
        <div class="form-group">
            <label for="">Chọn vai trò</label>
            <select class="form-control" name="role">
                    <option value="1">Customer</option>
                    <option value="2">Guide</option>
            </select>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
    <button type="submit" class="btn btn-success">Thêm</button>

    </div>
</form>
@endsection
