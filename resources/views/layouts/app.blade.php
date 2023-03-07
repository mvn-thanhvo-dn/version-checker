<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        function showMovieOption() {
            document.getElementsByClassName('movie-option')[0].style.display = 'block';
        }
        function hideMovieOption() {
            document.getElementsByClassName('movie-option')[0].style.display = 'none';
        }
    </script>

</head>
<body>
    <header class="header">
        <div class="header-container">
            <a href="{{route('home')}}"><img src="https://www.cgv.vn/skin/frontend/cgv/default/images/cgvlogo.png" alt="Logo" class="logo-page"></a>
            <ul class="nav-list">
                <li class="nav-list-item" onmouseenter="showMovieOption()" onmouseleave="hideMovieOption()">
                    Phim
                    <ul class="movie-option">
                        <li class="movie-option-item"><a href="{{route('home')}}">Phim đang chiếu</a></li>
                        <li class="movie-option-item"><a href="{{route('movie-coming')}}">Phim sắp chiếu</a></li>
                    </ul>
                </li>
                <li class="nav-list-item" style="min-width: 120px;"><a href="/cinema">Rạp CGV</a></li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-list-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-list-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-list-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Đăng xuất') }}
                            </a>
                            @if (Auth::user()->role_id == \App\Models\User::ROLE_CUSTOMER)                                
                                <a href="{{route('order.index',[Auth::user()->id])}}" class="dropdown-item">Vé của tôi</a>                                
                            @elseif (Auth::user()->role_id == \App\Models\User::ROLE_MANAGER)
                                {{-- <a href="{{route('order.cinema',[Auth::user()->id])}}" class="dropdown-item">Danh sách vé tại rạp</a>       --}}
                            @endif
                            @isset(Auth::user()->role_id)
                                @if (Auth::user()->role_id == \App\Models\User::ROLE_MANAGER) 
                                    <a href="{{route('schedule.create')}}" class="dropdown-item">Đăng ký lịch chiếu phim</a>
                                @elseif (Auth::user()->role_id == \App\Models\User::ROLE_ADMIN)
                                    <a href="{{route('schedule.create')}}" class="dropdown-item">Đăng ký lịch chiếu phim</a>
                                    <a href="{{route('movie.create')}}" class="dropdown-item">Đăng ký phim</a>
                                @endif        
                            @endisset

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </header>
    <main>
        @yield('content')
        @yield('sub-content')
    </main>
    <footer>
        <section class="footer-container">
            <ul class="about-me">
                <li class="about-me-item">
                    <h4 class="heading-page-third">CGV Việt Nam</h4>
                    <ul class="about-company">
                        <li class="about-company-item">Giới thiệu</li>
                        <li class="about-company-item">Tiện Ích Online</li>
                        <li class="about-company-item">Thẻ Quà Tặng</li>
                        <li class="about-company-item">Tuyển Dụng</li>
                        <li class="about-company-item">Liên Hệ Quảng Cáo CGV</li>
                    </ul>
                </li>
                <li class="about-me-item">
                    <h4 class="heading-page-third">Điều khoản sử dụng</h4>
                    <ul class="term">
                        <li class="term-item">Điều Khoản Chung</li>
                        <li class="term-item">Điều Khoản Giao Dịch</li>
                        <li class="term-item">Chính Sách Thanh Toán</li>
                        <li class="term-item">Chính Sách Bảo Mật</li>
                        <li class="term-item">Câu Hỏi Thường Gặp</li>
                    </ul>
                </li>
                <li class="about-me-item">
                    <h4 class="heading-page-third">Kết nối với chúng tôi</h4>
                    <ul class="connect-company">
                        <li class="connect-company-item" style="margin-left: -30px;">
                            <a href="" class="sociated">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/2048px-Facebook_icon_2013.svg.png"
                                    alt="Facebook">
                            </a>
                        </li>
                        <li class="connect-company-item">
                            <a href="" class="sociated">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/YouTube_full-color_icon_%282017%29.svg/2560px-YouTube_full-color_icon_%282017%29.svg.png"
                                    alt="Youtube">
                            </a>
                        </li>
                        <li class="connect-company-item">
                            <a href="" class="sociated">
                                <img src="https://i.pinimg.com/736x/2c/da/19/2cda1925dcf4fb8f0644413f49671ffa.jpg"
                                    alt="Instagram">
                            </a>
                        </li>
                        <li class="connect-company-item">
                            <a href="" class="sociated">
                                <img src="https://cdn1.iconfinder.com/data/icons/logos-brands-in-colors/2500/zalo-seeklogo.com-512.png"
                                    alt="Zalo">
                            </a>
                        </li>
                    </ul>
                    <a href=""><img src="http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png"
                            alt=""></a>
                </li>
                <li class="about-me-item">
                    <h4 class="heading-page-third">Chăm sóc khách hàng</h4>
                    <ul class="support">
                        <li class="support-item">Hotline: 1900 6017</li>
                        <li class="support-item">Giờ làm việc: 8:00 - 22:00 (Tất cả các ngày bao gồm cả Lễ Tết)</li>
                        <li class="support-item">Email hỗ trợ: hoidap@cgv.vn</li>
                    </ul>
                </li>
            </ul>
        </section>
        <section class="footer-contact">
            <h4 class="heading-page-third">CÔNG TY TNHH CJ CGV VIETNAM</h4>
            <p>Giấy CNĐKDN: 0303675393, đăng ký lần đầu ngày 31/7/2008, đăng ký thay đổi lần thứ 5 ngày 14/10/2015, cấp
                bởi Sở KHĐT thành phố Hồ Chí Minh.</p>
            <p>Địa Chỉ: Tầng 2, Rivera Park Saigon - Số 7/28 Thành Thái, P.14, Q.10, TPHCM.</p>
            <p>Hotline: 1900 6017</p>
            <p>COPYRIGHT 2017 CJ CGV. All RIGHTS RESERVED .</p>
        </section>
        <section class="end-page"></section>
    </footer>
</body>
</html>
