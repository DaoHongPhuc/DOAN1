<div class="row">
    <div class="col-md-12" style="padding: 0 !important">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" >
            <a class="navbar-brand" href="/doan/public">KTW Travel</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    @if (Auth::check())
                        @php
                            $user = Auth::user();
                        @endphp
                        <div class="btn-group dropleft">
                        @if ($user->level == 0) 
                            <li><a href="danhsachjob" class="nav-link">JOBS</a></li>
                            <li><a href="danhsachlichtrinh" class="nav-link">TOURS</a></li>
                        @else
                            @if ($user->level == 1)
                                <li><a href="danhsachlichtrinh" class="nav-link">TOURS</a></li>
                            @else
                                <li><a href="danhsachjob" class="nav-link">JOBS</a></li>
                            @endif
                        @endif
                    @endif
                </ul>
                <section>
                    @if (Auth::check())
                        @php
                            $user = Auth::user();
                        @endphp
                        <div class="btn-group dropleft">
                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user pl-1"></i>
                            </button>
                            <div class="dropdown-menu" style="font-family: 'Times New Roman', Times, serif"> 
                                @if ($user->level == 2) 
                                    <span class="dropdown-item">{{$user->name}}</span>    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="taikhoan">MY ACCOUNT</a>
                                    <a class="dropdown-item" href="profile">PROFILE</a>
                                @else
                                    <span class="dropdown-item">{{$user->name}}</span>    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="profile">PROFILE</a>
                                    <a class="dropdown-item" href="taikhoan">MY ACCOUNT</a>
                                @endif
                                
                                <a class="dropdown-item" href="logout">LOG OUT</a>
                            </div>
                        </div>
                    @else
                        <a href="login" class="btn btn-info text-white" style="font-family: 'Times New Roman', Times, serif">
                            LOGIN
                        </a>      
                    @endif
                </section>
            </div>
        </nav>
    </div>
</div>