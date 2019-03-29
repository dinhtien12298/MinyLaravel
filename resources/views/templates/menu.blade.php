<!-- START HEADER -->
<header id="header" class="search">
    <div class="container">
        <!-- Logo + Menu -->
        <div class="header-container-1">
            <div class="logo">
                <a href="{{ route('homepage') }}"><img src="{{ asset('images/all/logo.png') }}" alt=""></a>
            </div>
            <div class="user f-regular-16">
                @if (isset($userLogin) && $userLogin == true)
                    <button id="user-homepage" onclick="directTo('/nguoi-dung/thong-tin-ca-nhan')">
                        Trang cá nhân
                    </button>
                    <button id="logout-button" onclick="logOut()">
                        Đăng xuất
                    </button>
                @else
                    <button class="login-button" onclick="directTo('/dang-ky')">
                        Đăng ký
                    </button>
                    <button class="login-button" onclick="directTo('/dang-nhap')">
                        Đăng nhập
                    </button>
                @endif
            </div>
        </div>
        <!-- Search -->
        <div class="header-container-2">
            <div class="search-container">
                <i class="icon fas fa-search"></i>
                <input class="f-regular-14" type="text" id="search" placeholder="Tìm kiếm câu hỏi">
                <div class="search-content f-regular-14">

                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->

<!-- START NAVIGATION -->
<nav id="nav">
    <div class="nav-mobile-container">
        <div class="logo">
            <a class="d-none" href=""><img src="{{ asset('images/all/logo.png') }}" alt=""></a>
            <i id="close-nav-mobile" class="d-none fas fa-arrow-left" onclick="isHidden()"></i>
        </div>
        <div class="d-none menu-name">
            <p>Danh mục</p>
        </div>
        <div class="container d-flex f-medium-15">
            @foreach($all_classes as $class)
                @php $index = $all_classes->search($class) @endphp
                <div class="sub-menu" onmousemove="menuAppear()" onmouseout="menuDisappear()">
                    <div class="sub-title">
                        <a href="{{ route('category', ['class' => $class->class]) }}">{{ $class->class }}</a>
                        <i class="icon-down icon-plus d-none fas fa-plus"></i>
                        <i class="icon-down icon-minus d-none fas fa-minus"></i>
                    </div>
                    @if ( !empty($data_menu[$index]) && sizeof($data_menu[$index]) != 0 )
                        <div class="subject f-regular-13">
                            <div class="subject-column1">
                                @foreach($data_menu[$index][0] as $menu_element)
                                    <div class="menu-item" onclick="directTo('{{ route("category", ["class" => $class->class, "subject" => $menu_element->subject, "page" => 1]) }}')"><a href="{{ route('category', ['class' => $class->class, 'subject' => $menu_element->subject, 'page' => 1]) }}">{{ $menu_element->subject }}</a></div>
                                @endforeach
                            </div>
                            <div class="subject-column2">
                                @foreach($data_menu[$index][1] as $menu_element)
                                    <div class="menu-item" onclick="directTo('{{ route("category", ["class" => $class->class, "subject" => $menu_element->subject, "page" => 1]) }}')"><a href="{{ route('category', ['class' => $class->class, 'subject' => $menu_element->subject, 'page' => 1]) }}">{{ $menu_element->subject }}</a></div>
                                @endforeach
                            </div>
                            <div class="subject-column3">
                                @php $image_name = $class_images[$index][1] @endphp
                                <img src="{{ asset("images/all/$image_name.png") }}" alt="menu{{ $image_name }}">
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</nav>
<!-- END NAVIGATION -->
