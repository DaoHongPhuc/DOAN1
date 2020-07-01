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
                        @if ($user->level == 2) 
                            <li><a href="guide" class="nav-link">JOBS</a></li>
                        @else
                            <li><a href="customer" class="nav-link">TOURS</a></li>
                        @endif
                    @endif
                    <li><a href="chinhsach" class="nav-link">CHÍNH SÁCH</a></li>

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
                                    <span class="dropdown-item">{{$user->guide->name}}</span>    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="guide/information/{{$user->id}}">MY PROFILE</a>
                                @else
                                    <span class="dropdown-item">{{$user->customer->name}}</span>    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="customer/information/{{$user->id}}">MY PROFILE</a>
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