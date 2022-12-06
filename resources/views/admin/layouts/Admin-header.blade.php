<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand " href="/"><img  class="bg-dark" src=" {{asset('img/logo.png')}} " alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"> <img src=" {{asset('img/logo.png')}} " alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
            <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
            <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
            <link rel="stylesheet" href=" {{asset('css/plyr.css')}} " type="text/css">
            <link rel="stylesheet" href=" {{asset('css/nice-select.css')}} " type="text/css">
            <link rel="stylesheet" href=" {{asset('css/owl.carousel.min.css')}} " type="text/css">
            <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
            <link rel="stylesheet" href=" {{asset('css/style.css')}} " type="text/css">
            <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"/>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
         

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src=" {{asset('images/admin.jpg')}} " alt="User Avatar">
                </a>
                

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{ route('profile.show') }}">My Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        
                        <a class="nav-link" style="left-padding:1em; " href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                        this.closest('form').submit();">
                              {{ __('Log Out') }}
                        </a>
                    </form>
                   
                </div>
            </div>

        </div>
    </div>
</header>