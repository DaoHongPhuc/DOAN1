@extends('pages.customer.index')

@section('tour-content')
<div class="title-index-parent">
    <h2 class="title-index">DANH SÁCH LỊCH TRÌNH</h2>
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
            <tr>
                <th>STT</th>
                <th>TÊN LỊCH TRÌNH</th>
                <th>SỐ HÀNH TRÌNH</th>
                <th>TRẠNG THÁI</th>
                <th>NGÀY TẠO</th>
                <th>OPTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lichtrinh as $key => $lt)
                <tr>
                    <td scope="row">{{$key+1}}</td>
                    <td>{{$lt->name}}</td>
                    <td>
                        @php
                        $checkhuy = true;
                            $array = array();
                            foreach($hanhtrinh as $ht){
                                if($ht->lichtrinh_id == $lt->id){
                                    $array[] = $ht->id;
                                }
                            }
                            echo count($array);
                            if(count($array) > 0){
                                $checkhuy = false;
                            }
                        @endphp
                    </td>
                    <td>
                        @if ($lt->status == 0)
                            {{'Không Công Bố'}}
                        @else
                            {{'Công Bố'}}
                        @endif
                    </td>
                    <td>{{$lt->created_at}}</td>
                    <td>
                        <a href="thietlaplichtrinh/{{$lt->id}}" class="btn btn-info">Thiết Lập</a>
                        @if ($checkhuy)
                            <a name="#" class="btn btn-success" href="#" role="button"><i class="fas fa-edit"></i></a>
                            <a name="#" class="btn btn-danger" href="#" role="button"><i class="fas fa-trash"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
@endsection