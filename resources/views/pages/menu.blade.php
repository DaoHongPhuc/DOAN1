@php
    $user = Auth::user();
    $level = $user->level;
@endphp

@if ($level == 0)
    <div class="col-md-2">
        <ul id="accordion" class="accordion">
            <li class="">
                <div class="link bg-info">TOUR<i class="fa fa-chevron-down float-right"></i></div>
                <ul class="submenu">
                    <li><a href="customer/addtour/{{$id}}">THÊM</a></li>

                    <li><a href="customer/listtour/{{$id}}">DANH SÁCH</a></li>
                    <li><a href="customer/settour/{{$id}}">ĐẶT CỌC</a></li>
                    <li><a href="customer/schedule/{{$id}}">SẮP TỚI</a></li>
                    <li><a href="customer/history/{{$id}}">LỊCH SỬ</a></li>
                </ul>
            </li>
            <li class="">
                <div class="link bg-info">PROFILE<i class="fa fa-chevron-down float-right"></i></div>
                <ul class="submenu">
                    <li><a href="customer/information/{{$id}}">THÔNG TIN</a></li>
                    <li><a href="customer/account/{{$id}}">TÀI KHOẢN</a></li>
                    <li><a href="customer/notification/{{$id}}">THÔNG BÁO</a></li>
                    <li><a href="customer/setting/{{$id}}">CÀI ĐẶT</a></li>
                </ul>
            </li>
            <li class="">
                <div class="link bg-info">PROFILE<i class="fa fa-chevron-down float-right"></i></div>
                <ul class="submenu">
                    <li><a href="guide/information/{{$id}}">THÔNG TIN</a></li>
                    <li><a href="guide/account/{{$id}}">TÀI KHOẢN</a></li>
                    <li><a href="guide/notification/{{$id}}">THÔNG BÁO</a></li>
                    <li><a href="guide/setting/{{$id}}">CÀI ĐẶT</a></li>
                </ul>
                
            </li>
        </ul>
    </div>
@else
    @if ($level == 1)
        <div class="col-md-2">
            <ul id="accordion" class="accordion">
                <li class="">
                    <div class="link bg-info">TOUR<i class="fa fa-chevron-down float-right"></i></div>
                    <ul class="submenu">
                        <li><a href="customer/addtour/{{$id}}">THÊM</a></li>

                        <li><a href="customer/listtour/{{$id}}">DANH SÁCH</a></li>
                        <li><a href="customer/settour/{{$id}}">ĐẶT CỌC</a></li>
                        <li><a href="customer/schedule/{{$id}}">SẮP TỚI</a></li>
                        <li><a href="customer/history/{{$id}}">LỊCH SỬ</a></li>
                    </ul>
                </li>
                <li class="">
                    <div class="link bg-info">PROFILE<i class="fa fa-chevron-down float-right"></i></div>
                    <ul class="submenu">
                        <li><a href="customer/information/{{$id}}">THÔNG TIN</a></li>
                        <li><a href="customer/account/{{$id}}">TÀI KHOẢN</a></li>
                        <li><a href="customer/notification/{{$id}}">THÔNG BÁO</a></li>
                        <li><a href="customer/setting/{{$id}}">CÀI ĐẶT</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    @else
        <div class="col-md-2">
            <ul id="accordion" class="accordion">
                <li class="">
                    <div class="link bg-info">JOB<i class="fa fa-chevron-down float-right"></i></div>
                    <ul class="submenu">
                        <li><a href="guide/listjob/{{$id}}">DANH SÁCH</a></li>
                        <li><a href="guide/setjob/{{$id}}">ĐẶT CỌC</a></li>
                        <li><a href="guide/schedule/{{$id}}">SẮP TỚI</a></li>
                        <li><a href="guide/history/{{$id}}">LỊCH SỬ</a></li>
                    </ul>
                    
                </li>
                <li class="">
                    <div class="link bg-info">PROFILE<i class="fa fa-chevron-down float-right"></i></div>
                    <ul class="submenu">
                        <li><a href="guide/information/{{$id}}">THÔNG TIN</a></li>
                        <li><a href="guide/account/{{$id}}">TÀI KHOẢN</a></li>
                        <li><a href="guide/notification/{{$id}}">THÔNG BÁO</a></li>
                        <li><a href="guide/setting/{{$id}}">CÀI ĐẶT</a></li>
                    </ul>
                    
                </li>
            </ul>
        </div>
    @endif
@endif
