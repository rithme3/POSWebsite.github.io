
<?php 

$categories = DB::table('categories')->where('active', 1)->get();
?>
<div class="d-md-none d-block">
    <div class="bg-warning border border-warning">
        <div class="col-sm-12 p-0 ps-2">
            <nav class="navbar navbar-inverse navbar-fixed-tob navbar-expand-sm navbar-light text-white p-0">
                <div class="container ms-2 ">
                    
                    <div class="collapse navbar-collapse space-between d-flex pt-1 pb-1" id="navbarNav">
                        <a class="navbar-brand " href="#">
                            <img width="40px"
                                src="https://image.similarpng.com/very-thumbnail/2020/04/fast-food-logo-emblem.png"
                                alt="no_image" class="rounded-circle">
                        </a>
                        <form action="{{route('home')}}" class="d-flex">
                            <input name="keyword" value="{{request()->keyword ? request()->keyword : ''}}"
                                class="form-control me-1 ms-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-light text-warning me-1 rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                            </button>

                        </form>

                        <button class="navbar-toggler border border-warning p-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                    </div>
                    
                    <div class="offcanvas offcanvas-end text-bg-warning" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title " id="offcanvasDarkNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end  flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link {{!request()->id ? 'text-white' : ''}}"
                                    aria-current="page" href="{{route('home')}}">{{__('lb.Home')}}</a>
                            </li>
                            @foreach($categories as $menu)
                            <li class="nav-item">
                                <a class="nav-link {{request()->id == $menu->id ? 'text-white' : ''}} "
                                    href="{{route('product_by_category', [$menu->name, $menu->id])}}">{{translate($menu->name,$menu->name_kh)}}</a>
                            </li>
                            @endforeach
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Language
                                </a>
                                <ul class="dropdown-menu dropdown-menu-warning">
                                    <li><a class="dropdown-item" href="{{route('switch_lang','kh')}}">Khmer</a></li>
                                    <li><a class="dropdown-item" href="{{route('switch_lang','en')}}">English</a></li>
                                </ul>
                            </li>
                            </ul>
                            <div class="nav-item me-4">
                                <a href="{{route('login')}}" class="nav-link">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        
    </div>
</div>

<div class="d-none d-md-block">
    <div class="row bg-warning  ">
        <div class="col-sm-7 p-0 ps-5">
            <nav class="navbar navbar-inverse navbar-fixed-top navbar-expand-lg navbar-light text-white">
                <div class="container-fluid ms-2">
                    <a class="navbar-brand " href="#">
                        <img width="40px"
                            src="https://image.similarpng.com/very-thumbnail/2020/04/fast-food-logo-emblem.png"
                            alt="no_image" class="rounded-circle">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse space-between d-flex " id="navbarNav">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link {{!request()->id ? 'text-white' : ''}}"
                                    aria-current="page" href="{{route('home')}}">{{__('lb.Home')}}</a>
                            </li>
                            @foreach($categories as $menu)
                            <li class="nav-item">
                                <a class="nav-link {{request()->id == $menu->id ? 'text-white' : ''}} "
                                    href="{{route('product_by_category', [$menu->name, $menu->id])}}">{{translate($menu->name,$menu->name_kh)}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-sm-5 p-0">
            <nav class="navbar navbar-inverse navbar-fixed-top navbar-expand-lg navbar-light text-white">
                <div class="container-fluid pe-0">
                    <div class="collapse navbar-collapse space-between d-flex pt-1 pb-1" id="navbarNav1">
                        <form action="{{route('home')}}" class="d-flex">
                            <input name="keyword" value="{{request()->keyword ? request()->keyword : ''}}"
                                class="form-control me-1 ms-5" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-light text-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg></button>
                        </form>
                        <div class="dropdown">
                            <button type="button" class="btn btn-warning text-white dropdown-toggle" data-bs-toggle="dropdown">
                                Language
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('switch_lang','kh')}}">Khmer</a></li>
                                <li><a class="dropdown-item" href="{{route('switch_lang','en')}}">English</a></li>
                            </ul>
                        </div>
                        <div class="nav-item me-4">
                                <a href="{{route('login')}}" class="nav-link">Login</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
