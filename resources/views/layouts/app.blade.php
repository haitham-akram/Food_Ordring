<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="keywords" content="admin dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('refresh')
    <title>Admin Dashboard</title>
    @if (App::getLocale() == 'en')
        @include('includes.LTRStyle')
    @else
        @include('includes.RTLStyle')
    @endif

</head>

<body class="vertical-layout vertical-menu-modern content-detached-right-sidebar  menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu-modern" data-col="content-detached-right-sidebar">
{{-- Start Top Fixed nav --}}
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark bg-warning bg-darken-2  navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header ">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img class="brand-logo" alt="logo"
                             src="{{ asset('app-assets/images/logo/120.120.png') }}">
                        @if (App::getLocale() == 'en')
                            <h5 class="brand-text">{{ __('main.brand') }}</h5>
                        @else
                            <h3 class="brand-text">{{ __('main.brand') }}</h3>
                        @endif
                    </a>
                </li>
                <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0"
                                                                      data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white"
                                                                                                data-ticon="ft-toggle-right"></i></a></li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                            class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        {{-- start content of top navbar --}}
        <div class="navbar-container content bg-warning bg-darken-2">
            <div class="collapse navbar-collapse" id="navbar-mobile">

                <ul class="nav navbar-nav mr-auto float-left">
                </ul>
                <ul class="nav navbar-nav float-left">
                    {{-- start profile dropdown --}}
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#"
                           data-toggle="dropdown">
                                <span class="mr-1">{{ __('main.Hello') }},
                                    <span class="user-name text-bold-700">{{ Auth::user()->name }}</span>
                                </span>
                            <span class="avatar avatar-online">
                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-19.png') }} "
                                         alt="avatar"><i></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <i class="ft-power"></i>
                                {{ __('main.Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    {{-- end profile dropdown --}}
                    {{-- start language switcher --}}
                    <li class="dropdown dropdown-language nav-item">
                        <a id="dropdown-flag1" href="#" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" class="dropdown-toggle nav-link">
                            <i class="{{ __('main.flag') }}"></i>
                            <span class="selected-language" data-toggle="tooltip" data-popup="tooltip-custom"
                                  data-original-title="{{ __('main.Change-The-Language') }}">{{ __('main.lang') }}</span>
                            <i class="caret"></i>
                        </a>
                        <div aria-labelledby="dropdown-flag1" class="dropdown-menu dropdown-menu-right">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <i
                                        class="flag-icon @if ($properties['native'] == 'English') flag-icon-gb
                                    @else
                                    flag-icon-sa @endif  "></i>{{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                    {{-- end of lang switcher --}}
                </ul>
            </div>
        </div>
        {{-- end content of top navbar --}}
    </div>
</nav>
{{-- End Top Fixed nav --}}
{{-- start side menu --}}
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Dashboard --}}
            <li class=" @if (Route::currentRouteName() == 'home') active @endif">
                <a href="{{ route('home') }}"><i class="la la-home"></i><span class="menu-title"
                                                                              data-i18n="nav.dash.main">{{ __('main.Dashboard') }}</span></a>
            </li>

            {{-- restaurants section--}}
            <li class=" navigation-header">
                <span data-i18n="nav.category.People">{{ __('main.restaurants-section') }}</span><i
                    class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right"
                    data-original-title="restaurants"></i>
            </li>
            {{-- Restaurants Category--}}

            <li class="nav-item"><a href="#"><i class="la la-th-list"></i><span class="menu-title"
                                                                                 data-i18n="nav.restaurants.main">{{ __('main.Restaurant-Category') }}</span></a>
                <ul class="menu-content">
                    <li class="@if (Route::currentRouteName() == 'category.restaurant.index') active @endif"><a class="menu-item"
                                                                                                                href="{{route('category.restaurant.index')}}"
                                                                                                                data-i18n="nav.restaurants.list">{{ __('main.category-list') }}</a>
                    </li>

                </ul>
            </li>
            {{-- Restaurants --}}
            <li class=" nav-item"><a href="#"><i class="la la-building"></i><span class="menu-title"
                                                                                  data-i18n="nav.restaurants.main">{{ __('main.Restaurants') }}</span></a>
                <ul class="menu-content">
                    <li class="@if (Route::currentRouteName() == 'restaurant.create') active @endif"><a class="menu-item"
                                                                                                        href="{{route('restaurant.create')}}"
                                                                                                        data-i18n="nav.restaurants.list">{{ __('main.add-Restaurant') }}</a>
                    </li>
                    <li class="@if (Route::currentRouteName() == 'restaurant.list') active @endif"><a class="menu-item"
                                                                                                      href="{{route('restaurant.list')}}"
                                                                                                      data-i18n="nav.restaurants.list">{{ __('main.Restaurant-list') }}</a>
                    </li>
                </ul>
            </li>
            {{-- orders section--}}
            <li class=" navigation-header">
                <span data-i18n="nav.category.People">{{ __('main.orders-section') }}</span><i
                    class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right"
                    data-original-title="orders"></i>
            </li>
            {{-- Orders --}}
            <li class="nav-item"><a href="#"><i class="la la-shopping-cart"></i><span class="menu-title"
                                                                                       data-i18n="nav.orders.main">{{ __('main.Orders') }}</span></a>
                <ul class="menu-content">
                    <li class="@if (Route::currentRouteName() == 'restaurant.order') active @endif"><a class="menu-item"
                                                                                                       href="{{route('restaurant.order')}}"
                                                                                                       data-i18n="nav.restaurants.list">{{ __('main.order-list') }}</a>
                    </li>
                </ul>
            </li>
            {{-- banners section--}}
            <li class=" navigation-header">
                <span data-i18n="nav.category.People">{{ __('main.banners-section') }}</span><i
                    class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right"
                    data-original-title="banners"></i>
            </li>
            {{--banners--}}
            <li class="nav-item"><a href="#"><i class="la la-photo"></i><span class="menu-title"
                                                                                      data-i18n="nav.orders.main">{{ __('main.banners') }}</span></a>
                <ul class="menu-content">
                    <li class="@if (Route::currentRouteName() == 'banner.index') active @endif"><a class="menu-item"
                                                                                                       href="{{route('banner.index')}}"
                                                                                                       data-i18n="nav.banners-list">{{ __('main.banners-list') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
{{-- end side menu --}}
{{-- start page content --}}
@yield('content')
{{-- end page content --}}
{{-- Start Footer --}}
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2022 <a
                    class="text-bold-800 grey darken-2" href="#" target="_blank">Food Ordering And Delivery
                </a>, All rights reserved. </span>
        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i
                class="ft-heart pink"></i></span>
    </p>
</footer>
{{-- End Footer --}}

<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/core/libraries/bootstrap.min.js') }}" type="text/javascript"></script>
{{-- for toastr --}}
<script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/scripts/forms/switch.js') }}" type="text/javascript"></script>

@yield('search js')
</body>

</html>

