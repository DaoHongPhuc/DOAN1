@extends('admin.layout.index')

@section('content')
    <h2>THÊM ĐỊA ĐIỂM</h2>
   
    <form action="admin/themdiadiem" method="post">
        <div class="col-md-5">
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
            <div class="form-group">
                <label for="">Tên Địa Điểm</label>
                <input type="text" class="form-control" name="name" 
                aria-describedby="emailHelpId" placeholder="Nhập Tên Địa Điểm">
            </div>
            @csrf
            <button type="submit" class="btn btn-success">THÊM</button>
        </div>
        
    </form>
@endsection