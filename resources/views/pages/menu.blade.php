@php
    $user = Auth::user();
    $level = $user->level;
@endphp

@if ($level == 0)
    <div class="col-md-2">
        <ul id="accordion" class="accordion">
            <li class="">
                <div class="link bg-info">LỊCH TRÌNH<i class="fa fa-chevron-down float-right"></i></div>
                <ul class="submenu">
                    <li><a href="themlichtrinh">THÊM</a></li>
                    <li><a href="danhsachlichtrinh">DANH SÁCH</a></li>
                </ul>
            </li>
            <li class="">
                <div class="link bg-info">JOB<i class="fa fa-chevron-down float-right"></i></div>
                <ul class="submenu">
                    <li><a href="danhsachjob">DANH SÁCH</a></li>
                    <li><a href="#">ĐẶT CỌC</a></li>
                </ul>
            </li>
            <li class="">
                <div class="link bg-info">PROFILE<i class="fa fa-chevron-down float-right"></i></div>
                <ul class="submenu">
                    <li><a href="#">THÔNG TIN</a></li>
                    <li><a href="taikhoan">TÀI KHOẢN</a></li>
                </ul>
            </li>
        </ul>
    </div>
@else
    @if ($level == 1)
    <div class="col-md-2">
        <ul id="accordion" class="accordion">
            <li class="">
                <div class="link bg-info">LỊCH TRÌNH<i class="fa fa-chevron-down float-right"></i></div>
                <ul class="submenu">
                    <li><a href="themlichtrinh">THÊM</a></li>
                    <li><a href="danhsachlichtrinh">DANH SÁCH</a></li>
                    <li><a href="danhsachsaptoi">SẮP TỚI</a></li>
                </ul>
            </li>
            <li class="">
                <div class="link bg-info">PROFILE<i class="fa fa-chevron-down float-right"></i></div>
                <ul class="submenu">
                    <li><a href="#">THÔNG TIN</a></li>
                    <li><a href="taikhoan">TÀI KHOẢN</a></li>
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
                        <li><a href="danhsachjob">DANH SÁCH</a></li>
                        <li><a href="danhsachsaptoi">SẮP TỚI</a></li>
                    </ul>
                </li>
                <li class="">
                    <div class="link bg-info">PROFILE<i class="fa fa-chevron-down float-right"></i></div>
                    <ul class="submenu">
                        <li><a href="#">THÔNG TIN</a></li>
                        <li><a href="taikhoan">TÀI KHOẢN</a></li>
                    </ul>
                    
                </li>
            </ul>
        </div>
    @endif
   
@endif
