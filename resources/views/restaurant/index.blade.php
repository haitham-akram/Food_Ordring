@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.Restaurant-list') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ __('main.home') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('restaurant.list') }}">{{ __('main.Restaurant-list') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-header">
                                    <h3 class="form-section"><i class="la la-building font-large-1"></i>
                                        {{ __('main.All-restaurant') }}
                                    </h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- start table List  -->
                                    <div class="table-responsive">
                                        <table id=""
                                               class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                            <thead>
                                            <tr>
                                                <th class = "text-center">{{ __('main.id') }}</th>
                                                <th class = "text-center">{{ __('main.logo') }}</th>
                                                <th class = "text-center">{{ __('main.cover_image') }}</th>
                                                <th class = "text-center">{{ __('main.name_ar') }}</th>
                                                <th class = "text-center">{{ __('main.name_en') }}</th>
                                                <th class = "text-center">{{ __('main.category') }}</th>
                                                <th class = "text-center">{{ __('main.latitude') }}</th>
                                                <th class = "text-center">{{ __('main.longitude') }}</th>
                                                <th class = "text-center">{{ __('main.status') }}</th>
                                                <th class = "text-center">{{ __('main.created_at') }}</th>
                                                <th class = "text-center">{{ __('main.actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($restaurants as $restaurant)
                                                <tr>
                                                    <td class = "text-center">{{$restaurant->id}}</td>
                                                    <td class = "text-center"> <img style="width:100px; hight:100px" src="{{ $restaurant->logo}}" alt="logo"> </td>
                                                    <td class = "text-center"> <img style="width:100px; hight:100px" src="{{ $restaurant->cover_image}}" alt="cover_image"> </td>
                                                    <td class = "text-center">{{$restaurant->name_ar}}</td>
                                                    <td class = "text-center">{{$restaurant->name_en}}</td>
                                                    <td class = "text-center">
                                                        @foreach($categories as $category)
                                                            @if($category->resturant_id == $restaurant->id )
                                                                @if (App::getLocale() == 'en')
                                                                ,{{$category->name_en}}
                                                                @else
                                                                ,{{$category->name_ar}}
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>

                                                    <td class = "text-center">{{$restaurant->latitude}}</td>
                                                    <td class = "text-center">{{$restaurant->longitude}}</td>

                                                    <td class = "text-center">
                                                        @if($restaurant->status == 1)
                                                            {{__('main.active')}}
                                                        @else
                                                            {{__('main.hidden')}}
                                                        @endif
                                                        </td>
                                                    <td class = "text-center">{{$restaurant->created_at}}</td>
                                                    <td class = "text-center">
                                                                   <span class="dropdown">
                                                            <button id="SearchDrop2" type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="true"
                                                                    class="btn btn-warning dropdown-toggle  dropdown-menu-right "><i
                                                                    class="ft-settings"></i></button>
                                                            <span aria-labelledby="SearchDrop2"
                                                                  class="dropdown-menu mt-1 dropdown-menu-left">
                                                                <a href="{{route('restaurant.edit',$restaurant->id)}}" class="dropdown-item primary">
                                                                    <i class="ft-edit-2 primary"></i>
                                                                    {{ __('main.edit') }}</a>
                                                                <a href="{{route('restaurant.delete',$restaurant->id)}}" class="dropdown-item danger">
                                                                    <i class="ft-trash-2 danger"></i>
                                                                    {{ __('main.delete') }}</a>
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('search js')

    @if (Session::has('delete_msg_Restaurant'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('delete_msg_Restaurant') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('delete_msg_Restaurant') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
{{--     this script for toastr alert error--}}
    @if (Session::has('not_found_msg_restaurant'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.error('{{ Session::get('not_found_msg_restaurant') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.error('{{ Session::get('not_found_msg_restaurant') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
@endsection
