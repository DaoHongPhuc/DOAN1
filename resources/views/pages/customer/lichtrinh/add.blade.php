@extends('pages.customer.index')

@section('tour-content')
<div class="title-index-parent">
    <h2 class="title-index">THÊM LỊCH TRÌNH</h2>
</div>
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
    <div class="col-md-5">
        <form action="themlichtrinh" method="post">
            <div class="form-group">
                <label for="">Tên Lịch Trình</label>
                <input type="text" name="name" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            @csrf
        <button type="submit" class="btn btn-primary">OK</button>
        </form>
        
    </div>
    
@endsection