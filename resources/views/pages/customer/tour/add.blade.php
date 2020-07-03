@extends('pages.customer.index')

@section('tour-content')
<div class="title-index-parent">
    <h2 class="title-index">THÊM TOUR</h2>
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
<div class="container">
    <form action="customer/addtour/{{$user->customer->id}}" method="post">
    <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                <label for="">Địa Điểm Muốn Đến</label>
                    <select class="form-control" name="diadiem" id="">
                        @foreach ($diadiem as $dd)
                            <option value="{{$dd->id}}">{{$dd->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <label for="">Ngày Khởi Hành</label>
                <input type="date" name="ngaykhoihanh" class="form-control" placeholder="" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Hãy cân nhắc kỹ khi chọn ngày khởi hành</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label for="">Lưu ý</label>
                <textarea name="note" class="form-control" rows="5"></textarea>
                <small id="helpId" class="text-muted">Ghi lại những điều về chuyến đi cho hướng dẫn viên như: 
                    số người, phương tiện, bảo hiểm, ...
                </small>
                </div>
            </div>
            @csrf
            
        </div>
        <button type="submit" class="btn btn-success float-right">ADD</button>
            <div class="clear"></div>
    </form>
</div>
@endsection