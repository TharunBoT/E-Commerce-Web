<div>
    <div class="main-header navbar-searchbar">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="brand-logo">
                                <a href="{{route('app.index')}}">
                                    <img style="height:90px"  src="{{asset('assets/images/logo.png')}}" class="h-10 img-fluid blur-up lazyload"
                                        alt="logo">
                                </a>
                            </div>

                        </div>
                        <nav>
                            <div class="main-navbar">
                                <div id="mainnav">
                                    <div class="toggle-nav">
                                        <i class="fa fa-bars sidebar-bar"></i>
                                    </div>
                                    <ul class="nav-menu">
                                        <li class="back-btn d-xl-none">
                                            <div class="close-btn">
                                                Menu
                                                <span class="mobile-back"><i class="fa fa-angle-left"></i>
                                                </span>
                                            </div>
                                        </li>
                                        <li><a href="{{route('app.index')}}" class="nav-link menu-title">Home</a></li>
                                        <li><a href="{{route('shop.index')}}" class="nav-link menu-title">Shop</a></li>
                                        <li><a href="{{route('cart.index')}}" class="nav-link menu-title">Cart</a></li>
                                        <li><a href="{{route('contact.index')}}" class="nav-link menu-title">Contact Us</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <div class="menu-right">
                            <ul>
                                <li>
                                    <div class="search-box theme-bg-color">
                                        <i data-feather="search"></i>
                                    </div>
                                </li>
                                <li class="onhover-dropdown wislist-dropdown">
                                    <div class="cart-media">
                                        <a href="{{route('cart.index')}}">
                                            <i data-feather="shopping-cart"></i>
                                            <span id="cart-count" class="label label-theme rounded-pill">
                                                {{Cart::instance('cart')->content()->count()}}
                                            </span>
                                        </a>
                                    </div>
                                </li>
                                <li class="onhover-dropdown">
                                    <div class="cart-media name-usr">
                                        @auth <span>{{Auth::user()->name}}</span> @endauth <i data-feather="user"></i>
                                    </div>
                                    <div class="onhover-div profile-dropdown">
                                        <ul>
                                            @if (Route::has('login'))
                                                @auth
                                                    @if (Auth::user()->utype == 'ADM')
                                                        <li>
                                                            <a href="{{route('filament.pages.dashboard')}}">Dashboard</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{route('dashboard')}}">My Account</a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('frmlogout').submit();" class="d-block">Logout</a>
                                                        <form id="frmlogout" action="{{route('logout')}}" method="POST">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{route('login')}}">Login</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('register')}}">Register</a>
                                                    </li>
                                                @endauth
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="search-full">
                            <form method="GET" class="search-full" action="http://localhost:8000/search">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" name="q" class="form-control search-type"
                                        placeholder="Search here..">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
