<?php
// use App\Models\Category;
//Get Categories and Sub Categories
// $categories = Category::getCategories();
// echo "<pre>"; print_r($categories); die;
?>


<header id="header" class="header header-sticky header-sticky-smart disable-transition-all z-index-5">

    <div class="sticky-area">
        <div class="main-header nav navbar bg-body navbar-light navbar-expand-xl py-6 py-xl-0">
            <div class="container-wide container flex-nowrap">
                <div class="w-72px d-flex d-xl-none">
                    <button class="navbar-toggler align-self-center  border-0 shadow-none px-0 canvas-toggle p-4"
                        type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasNavBar"
                        aria-controls="offCanvasNavBar" aria-expanded="false" aria-label="Toggle Navigation">
                        <span class="fs-24 toggle-icon"></span>
                    </button>
                </div>
                <div class="d-none d-xl-flex w-xl-50">
                    <ul class="navbar-nav">
                        <li
                            class="nav-item transition-all-xl-1 py-11 me-xxl-12 me-xl-10 dropdown dropdown-hover dropdown-fullwidth">
                            <a class="nav-link d-flex justify-content-between position-relative py-0 px-0 text-uppercase fw-semibold ls-1 fs-14px"
                                href="{{ url('/') }}" id="menu-item-home" aria-haspopup="true"
                                aria-expanded="false">Home</a>

                         </li>
                        <li
                            class="nav-item transition-all-xl-1 py-11 me-xxl-12 me-xl-10 dropdown dropdown-hover dropdown-fullwidth position-static">
                            <a class="nav-link d-flex justify-content-between position-relative py-0 px-0 text-uppercase fw-semibold ls-1 fs-14px dropdown-toggle"
                                href="store.html" data-bs-toggle="dropdown" id="menu-item-shop" aria-haspopup="true"
                                aria-expanded="false">Shop NOw</a>
                            <div class="dropdown-menu mega-menu start-0 py-6  w-100" aria-labelledby="menu-item-shop">
                                <div class="megamenu-shop container-wide py-8 px-12">
                                    <div class="row">
                                        @foreach ($categories as $category)
                                            <div class="col">

                                                <a href="{{ url($category['url']) }}">
                                                    <h6 class="fs-18px">{{ $category['category_name'] }}</h6>
                                                </a>
                                                <ul class="list-unstyled mb-0">
                                                    @if (count($category['subcategories']))
                                                        @foreach ($category['subcategories'] as $subcategory)
                                                            <li>
                                                                <a href="{{ url($subcategory['url']) }}"
                                                                    class="border-hover text-decoration-none py-3 d-block"><span
                                                                        class="border-hover-target">{{ $subcategory['category_name'] }}
                                                                    </span></a>

                                                                @if (count($subcategory['subcategories']))
                                                                    @foreach ($subcategory['subcategories'] as $subsubcategory)
                                                            <li>
                                                                <a href="{{ url($subsubcategory['url']) }}"
                                                                    class="border-hover text-decoration-none py-3 d-block"><span
                                                                        class="border-hover-target">{{ $subsubcategory['category_name'] }}
                                                                    </span></a>
                                                            </li>
                                                        @endforeach
                                                    @endif

                        </li>
                        @endforeach
                        @endif



                    </ul>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    </li>
    {{-- <li class="nav-item transition-all-xl-1 py-11 me-xxl-12 me-xl-10 dropdown dropdown-hover">
        <a class="nav-link d-flex justify-content-between position-relative py-0 px-0 text-uppercase fw-semibold ls-1 fs-14px"
            href="{{ url('deals') }}" id="menu-item-pages" aria-haspopup="true" aria-expanded="false">Deals</a>
    </li> --}}



    </ul>
    </div>
    <a href="index-2.html" class="navbar-brand px-8 py-4 mx-auto">
        <img class="light-mode-img" src="{{ asset('front/assets/images/others/logo.png') }}" width="179"
            height="26" alt="Glowing - Bootstrap 5 HTML Templates">
        <img class="dark-mode-img" src="{{ asset('front/assets/images/others/logo-white.png') }}" width="179"
            height="26" alt="Glowing - Bootstrap 5 HTML Templates"></a>
    <div class="icons-actions d-flex justify-content-end w-xl-50 fs-28px text-body-emphasis">

        {{-- <div class="px-5 d-none d-xl-inline-block">
            <a class="position-relative lh-1 color-inherit text-decoration-none" href="shop/wishlist.html">
                <svg class="icon icon-star-light">
                    <use xlink:href="#icon-star-light"></use>
                </svg>
                <span
                    class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle mt-4 rounded-circle fs-13px p-0 square"
                    style="--square-size: 18px">3</span>
            </a>
        </div> --}}
        <div class="px-5 d-none d-xl-inline-block">
            <a class="position-relative lh-1 color-inherit text-decoration-none" href="{{ url('cart') }}" id="cartLink">
                <svg class="icon icon-star-light">
                    <use xlink:href="#icon-shopping-bag-open-light"></use>
                </svg>

            </a>
        </div>
        <div class="color-modes position-relative ps-5">
            <a class="bd-theme btn btn-link nav-link dropdown-toggle d-inline-flex align-items-center justify-content-center text-primary p-0 position-relative rounded-circle"
                href="#" aria-expanded="true" data-bs-toggle="dropdown" data-bs-display="static"
                aria-label="Toggle theme (light)">
                <svg class="bi my-1 theme-icon-active">
                    <use href="#sun-fill"></use>
                </svg>
            </a>
            <ul class="dropdown-menu dropdown-menu-end fs-14px" data-bs-popper="static">
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center active"
                        data-bs-theme-value="light" aria-pressed="true">
                        <svg class="bi me-4 opacity-50 theme-icon">
                            <use href="#sun-fill"></use>
                        </svg>
                        Light
                        <svg class="bi ms-auto d-none">
                            <use href="#check2"></use>
                        </svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                        aria-pressed="false">
                        <svg class="bi me-4 opacity-50 theme-icon">
                            <use href="#moon-stars-fill"></use>
                        </svg>
                        Dark
                        <svg class="bi ms-auto d-none">
                            <use href="#check2"></use>
                        </svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto"
                        aria-pressed="false">
                        <svg class="bi me-4 opacity-50 theme-icon">
                            <use href="#circle-half"></use>
                        </svg>
                        Auto
                        <svg class="bi ms-auto d-none">
                            <use href="#check2"></use>
                        </svg>
                    </button>
                </li>
            </ul>

        </div>


        <div class="px-5 d-none d-xl-inline-block">
            @if (Route::has('login'))
                @auth
                <div class="dropdown pl-2 py-2">
                    <a class="dropdown-toggle bd-theme btn btn-link nav-link d-inline-flex align-items-center justify-content-center text-primary p-0 position-relative rounded-circle" data-bs-toggle="dropdown"
                        href="{{ url('/user/profile') }}" aria-expanded="true"
                        data-bs-display="static" aria-label="{{ Auth::user()->name }}">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                            class="rounded-circle theme-icon-active" style="width: 30px; height: 30px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end w-100">
                        <a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a>
                        @if (Auth::user()->role == 1)
                            <a class="dropdown-item" href="{{ url('admin/dashboard') }}">Admin Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('loginnew') }}" class="login-link">
                    <svg class="icon icon-user-light">
                        <use xlink:href="#icon-user-light"></use>
                    </svg>
                </a>
                @endauth
            @endif
        </div>










    </div>
    </div>
    </div>
    </div>
</header>
