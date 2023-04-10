<header class="site-header">
    <div class="container-fluid">
        <a href="{{route('home')}}" class="site-logo">
            <img class="hidden-md-down" src="https://perumdamtirtakencana.id/sites/images/logo-page.png" alt="">
            <img class="hidden-lg-up" src="https://perumdamtirtakencana.id/sites/images/logo-page.png" alt="">
        </a>

        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
            <span>toggle menu</span>
        </button>

        <button class="hamburger hamburger--htla">
            <span>toggle menu</span>
        </button>

        <div class="site-header-content">
            <div class="site-header-content-in">
                 @if(auth()->check())
                <div class="site-header-shown">
                    <div class="dropdown user-menu">
                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{!! Avatar::create(auth()->user()->name)->toBase64() !!}">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                            <a class="dropdown-item" href="">
                                <span class="font-icon fa fa-user"></span>
                                Profil
                            </a>
                            <a class="dropdown-item" href="">
                                <span class="font-icon fa fa-unlock"></span>
                                Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="font-icon fa fa-times"></span>
                                Keluar
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                </div>

                @endif
            </div>
        </div>
    </div>
</header>