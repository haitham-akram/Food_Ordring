<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="keywords" content="admin dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a class="navbar-brand" href="{{ route('Home') }}">
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
            <li class=" @if (Route::currentRouteName() == 'admin_index') active @endif">
                <a href="{{ route('Home') }}"><i class="la la-home"></i><span class="menu-title"
                                                                                     data-i18n="nav.dash.main">{{ __('main.Dashboard') }}</span></a>
            </li>

            {{-- restaurants section--}}
            <li class=" navigation-header">
                <span data-i18n="nav.category.People">{{ __('main.restaurants-section') }}</span><i
                    class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right"
                    data-original-title="restaurants"></i>
            </li>
            {{-- Restaurants Category--}}

            <li class=" nav-item"><a href="#"><i class="la la-th-list"></i><span class="menu-title"
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

            {{-- Meals Category --}}
            <li class=" nav-item"><a href="#"><i class="la la-list"></i><span class="menu-title"
                                                                                 data-i18n="nav.Meals.main">{{ __('main.Meal-category') }}</span></a>
                <ul class="menu-content">
                    <li class="@if (Route::currentRouteName() == 'meal.category.index') active @endif"><a class="menu-item"
                                                                                                     href="{{ route('meal.category.index') }}"
                                                                                                     data-i18n="nav.Meals.add">{{ __('main.Meal-category-list') }}</a>
                    </li>
                </ul>
            </li>

            {{-- Meals --}}
            <li class=" nav-item"><a href="#"><i class="la la-cutlery"></i><span class="menu-title"
                                                                                 data-i18n="nav.Meals.main">{{ __('main.Meals') }}</span></a>
                <ul class="menu-content">
                    <li class="@if (Route::currentRouteName() == 'meal.create') active @endif"><a class="menu-item"
                                                                                                     href="{{ route('meal.create') }}"
                                                                                                     data-i18n="nav.Meals.add">{{ __('main.add-meal') }}</a>
                    </li>
                    <li class="@if (Route::currentRouteName() == 'meal.index') active @endif"><a class="menu-item"
                                                                                               href="{{ route('meal.index') }}"
                                                                                               data-i18n="nav.Meals.list">{{ __('main.meals-list') }}</a>
                    </li>
                </ul>
            </li>
            {{-- Adds-on --}}
            <li class=" nav-item"><a href="#"><i class="la la-plus-square-o"></i><span class="menu-title"
                                                                                 data-i18n="nav.Meals.main">{{ __('main.Adds-on') }}</span></a>
                <ul class="menu-content">
                    <li class="@if (Route::currentRouteName() == 'RM_create_meal') active @endif"><a class="menu-item"
                                                                                                     href="{{ route('Home') }}"
                                                                                                     data-i18n="nav.Meals.add">{{ __('main.add-adds-on') }}</a>
                    </li>
                    <li class="@if (Route::currentRouteName() == 'RM_Meals') active @endif"><a class="menu-item"
                                                                                               href="{{ route('Home') }}"
                                                                                               data-i18n="nav.Meals.list">{{ __('main.Adds-on-list') }}</a>
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
@include('includes.appJS')
@yield('search js')
</body>

</html>

