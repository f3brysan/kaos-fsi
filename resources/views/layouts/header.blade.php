<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
               
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                class="ficon bx bx-fullscreen"></i></a></li>                  
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name">{{ session()->get('bio')->name ?? '' }}</span><span
                                    class="user-status text-muted">Available</span></div><span><img class="round"
                                    src="/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar"
                                    height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pb-0">
                            <form action="/logout" method="POST">
                            @csrf
                            <button class="btn btn-link"><i class="ft-power"></i> Logout</button>
                        </form>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
