 <!-- Page Preloder -->
 <div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="/">
                        <img src="{{asset('img/logo.png')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class=""><a href="/">Homepage</a></li>
                            <li><a href=" {{route('cat')}} ">Categories <span class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                    @foreach ($type as $item)
                                    <li><a href={{url('categories/'.$item->id)}} >{{$item->name}}</a></li>
                                    @endforeach
                                    
                                </ul>
                            </li>
                            
                            <li><a href=" {{route('Contact')}} ">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                    @auth
                    @if (Auth::user()->role != null)
                         @if (Auth::user()->role == 1)
                         <div class="user-area dropdown float-right">
                                
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{(Auth::user()->name)}}
                               
                            </a>
                            
                            
                            
            
                            <div class="user-menu dropdown-menu">
                                <a href=" {{url('redirects')}} " class="nav-link text-success">Dashboard</a>
                                <a class="nav-link text-success" href="{{ route('profile.show') }}">My Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    
                                    <a class="nav-link text-success" style="left-padding:1em; " href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            
                            </div>
                        </div>
                             
                         @else
                           
                            <div class="user-area dropdown float-right">
                                
                                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{(Auth::user()->name)}}
                                   
                                </a>
                                
                                
                
                                <div class="user-menu dropdown-menu">
                                    <a class="nav-link text-success" href="{{ route('profile.show') }}">My Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        
                                        <a class="nav-link text-success" style="left-padding:1em; " href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                
                                </div>
                            </div>
                            
                         @endif  
                    @endif
                 
                    
                 @else
                            
                     <a href="{{ route('logint') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="font-size: 1em;">Log in</a>

                    
                 @endauth
                   
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->
