@extends('pages.customer.index')

@section('tour-content')
<div class="title-index-parent">
<h2 class="title-index">DANH SÁCH HƯỚNG DẪN VIÊN NHẬN HÀNH TRÌNH 
    @foreach ($diadiem as $dd)
        @if ($dd->id == $hanhtrinh->diadiem_id)
            {{$dd->name}}
        @endif
    @endforeach
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
        <div class="alert alert-primary" role="alert">
            {{session('thongbao')}}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr align="center">
                <th>STT</th>
                <th>TÊN HDV</th>
                <th>BẮT ĐẦU</th>
                <th>KẾT THÚC</th>
                <th>PHẢI TRẢ</th>
                <th>ĐẶT CỌC</th>
                <th>OPTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($danhsachnguoinhan as $key => $dsnn)
                <tr align="center">
                    <td>{{$key+1}}</td>
                    <td>
                        @foreach ($user as $u)
                            @if ($u->id == $dsnn->user_id)
                                {{$u->name}}
                            @endif
                        @endforeach
                        
                    </td>
                    <td>{{$dsnn->starttime}}</td>
                    <td>{{$dsnn->endtime}}</td>
                    @php
                        $sothoigian = $dsnn->temp_endtime - $dsnn->temp_starttime;
                        $tongsotien = $sothoigian * $dsnn->price;
                        $tiendatcoc = ($sothoigian * $dsnn->price) / 2;
                    @endphp
                    <td>{{$tongsotien}}$</td>
                    <td>{{$tiendatcoc}}$</td>
                    <td>
                        @if ($dsnn->status == 1)
                            <button class="btn btn-warning text-white">Đã đặt cọc</button>
                            
                        @else
                            <form action="nhanhdv/{{$dsnn->id}}/{{$dsnn->user_id}}/{{$hanhtrinh->id}}" method="post">
                                <input type="hidden" name="starttime" value="{{$dsnn->starttime}}">
                                <input type="hidden" name="endtime" value="{{$dsnn->endtime}}">
                                <input type="hidden" name="total" value="{{$tongsotien}}">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="confirmDatCoc(event)">Đặt cọc</button>
                            </form>
                        @endif
                        
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    <hr>
    <a href="thietlaplichtrinh/{{$hanhtrinh->lichtrinh->id}}" class="btn btn-secondary">Trở về thiết lập lịch trình</a>
    <script>
        function confirmDatCoc(event){
            $result = confirm('Xác nhận đặt cọc ?');
            if(!$result){
                event.preventDefault();
            }
        }
    </script>
@endsection
