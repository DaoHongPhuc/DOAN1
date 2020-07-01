@extends('pages.guide.index')

@section('job-content')
<div class="title-index-parent">
    <h2 class="title-index">JOB ĐẶT CỌC</h2>
</div>
    <table data-toggle="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>ĐỊA ĐIỂM</th>
            <th>TIỀN NHẬN ĐƯỢC</th>
            <th>THỜI GIAN BẮT ĐẦU</th>
            <th>THỜI GIAN KẾT THÚC</th>
            <th>HOÀN CỌC</th>
            <th>TÙY CHỌN</th>
            <th>TRẠNG THÁI</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($datcoc as $key => $dc)
            <tr>
                <td>{{$key+1}}</td>
                <td>
                    @foreach ($tour as $t)
                        @if ($t->id == $dc->tour_id)
                            {{$t->diadiem}}
                        @endif
                    @endforeach
                </td>
                <td>{{$dc->sumcost}}$</td>
                <td>{{$dc->openline}}</td>
                <td>{{$dc->deadline}}</td>
                <td>
                    @php
                        $present = strtotime($dc->present);
                        $openline = strtotime($dc->openline);
                        $deadline = strtotime($dc->deadline);
                        if($openline-$present < 864000){
                            if( $openline-$present > 432000){
                                echo "50%";
                            }else{
                                echo "0%";
                            }
                        }else{
                            echo "100%";
                        }
                    @endphp
                </td>
                <td>
                    <a onclick="guidehuycoc(event)" href="guide/huycoc/{{$dc->id}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
                <td>
                    @if ($dc->present < $dc->deadline)
                        @if ($dc->present < $dc->openline)
                            <button class="btn btn-warning text-white">Đang chờ</button>
                        @else
                            <button class="btn btn-primary text-white">Đang tính giờ</button>
                        @endif
                    @else
                        <button class="btn btn-success text-white">Hoàn Thành</button>
                        
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
         function guidehuycoc(event){
            var ghc = confirm('Xác nhận hủy công việc ?');
            if(ghc != true){
                event.preventDefault();
            }
        }
    </script>
@endsection