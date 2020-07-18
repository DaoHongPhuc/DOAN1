<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">Username</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>


    {{-- menu --}}
    <ul class="nav menu">
        <li class=""><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
            <i class="fa fa-user" aria-hidden="true"></i> Users <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a href="admin/adduser" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> ADD
                </a></li>
            </ul>
        </li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
            <i class="fa fa-envelope" aria-hidden="true"></i> Notificate <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li><a href="admin/guidereg" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Request Joinning
                </a></li>
            </ul>
        </li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-3">
            <i class="fas fa-map-marked-alt "></i> Địa Điểm 
            <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus">
                </em></span>
            </a>
            <ul class="children collapse" id="sub-item-3">
                <li><a href="admin/danhsachdiadiem" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Danh Sách Địa Điểm
                </a></li>
                <li><a href="admin/themdiadiem" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Thêm Địa Điểm
                </a></li>
            </ul>
        </li>
        <li><a href="admin/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->