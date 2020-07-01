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
        <li class="active"><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
            <em class="fa fa-navicon">&nbsp;</em> Users <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a href="admin/listadmin" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Admin
                </a></li>
                <li><a href="admin/listcustomer" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Customer
                </a></li>
                <li><a href="admin/listguide" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Guide
                </a></li>
                <li><a href="admin/listblock" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Block
                </a></li>
            </ul>
        </li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
            <em class="fa fa-navicon">&nbsp;</em> Notificate <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li><a href="admin/guidereg" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Request Joinning
                </a></li>
                <li><a href="admin/report" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Report
                </a></li>
                <li><a href="admin/" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Guide
                </a></li>
                <li><a href="admin/" class="">
                    <span class="fa fa-arrow-right">&nbsp;</span> Block
                </a></li>
            </ul>
        </li>
        <li><a href="admin/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->