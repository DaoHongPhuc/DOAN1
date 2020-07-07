@extends('pages.customer.index')

@section('tour-content')
<div class="title-index-parent">
<h2 class="title-index">LỊCH TRÌNH: {{$lichtrinh->name}}
</h2>
</div>
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


<form action="themhanhtrinh/{{$lichtrinh->id}}" method="post">
    <div class="row">
        <div class="col-md-6">
            <h5 class="text-center">HÀNH TRÌNH ĐÃ CÓ</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>ĐỊA ĐIỂM</th>
                        <th>NGÀY KHỞI HÀNH</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hanhtrinh as $key => $ht)
                        <tr>
                            <td scope="row">{{$key+1}}</td>
                            <td>
                                @php
                                    foreach($diadiem as $dd){
                                        if($dd->id == $ht->diadiem_id){
                                            echo $dd->name;
                                        }
                                    }
                                @endphp    
                            </td>
                            <td>{{$ht->ngaykhoihanh}}</td>
                        </tr>
                    @endforeach
                    

                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h5 class="text-center">THÊM HÀNH TRÌNH</h5>
            <div class="form-group">
                <label for=""></label>
                <select class="form-control" name="diadiem" id="">
                    @foreach ($diadiem as $dd)
                    <option value="{{$dd->id}}">{{$dd->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
              <label for=""></label>
              <input type="date" name="ngaykhoihanh" class="form-control" placeholder="">
            </div>
            @csrf
            <br>
            <button type="submit" class="btn btn-primary">Thêm Hành Trình</button>
            <a href="thietlaplichtrinh/{{$lichtrinh->id}}" class="btn btn-info">Thiết Lập Lịch Trình</a>
        </div>
    </div>
</form>
@endsection