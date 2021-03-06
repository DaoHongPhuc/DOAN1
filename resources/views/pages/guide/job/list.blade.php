@extends('pages.guide.index')

@section('job-content')
<div class="title-index-parent">
    <h2 class="title-index">DANH SÁCH HÀNH TRÌNH ĐÃ NHẬN</h2>
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
 <table class="table">
     <thead>
            <tr align="center">
                <th>STT</th>
                <th>HÀNH TRÌNH</th>
                <th>BẮT ĐẦU</th>
                <th>KẾT THÚC</th>

                <th>TỔNG GIỜ</th>
                <th>$/H</th>

                <th>NHẬN ĐƯỢC</th>
                <th>TIỀN CỌC</th>
                <th>OPTIONS</th>
            </tr>
     </thead>
     <tbody>
            @foreach ($job as $key => $j)
                <tr align="center">
                    <td  scope="row">{{$key+1}}</td>
                    <td>
                        @php
                            foreach ($hanhtrinh as $ht) {
                                if($ht->id == $j->hanhtrinh_id){
                                    foreach ($diadiem as  $dd) {
                                        if($dd->id == $ht->diadiem_id){
                                            echo $dd->name;
                                        }
                                    }
                                }
                            }
                        @endphp
                    </td>
                    <td>
                        {{$j->starttime}}
                    </td>
                    <td>
                        {{$j->endtime}}
                    </td>

                    <td>
                        {{$j->temp_endtime - $j->temp_starttime}}h
                    </td>
                    <td>
                        {{$j->price}}$
                    </td>

                    @php
                        $sothoigian = $j->temp_endtime - $j->temp_starttime;
                        $tongsotien = $sothoigian * $j->price;
                        $tiendatcoc = ($sothoigian * $j->price) / 2;
                    @endphp
                    <td>
                        {{$tongsotien}}$
                    </td>
                    <td>
                        {{$tiendatcoc}}$
                    </td>
                    <td>
                        @if ($j->status == 0)
                            <button class="btn btn-info text-white">Đang chờ</button>
                            <a href="huyjob/{{$j->hanhtrinh_id}}" class="btn btn-danger">Hủy</a>
                        @else
                            <button type="submit" class="btn btn-primary">Đã đặt cọc</button>
                            
                        @endif
                       
                    </td>
                </tr>
            @endforeach
            
     </tbody>
 </table>
@endsection