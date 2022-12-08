@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.meals-list') }} {{__('main.for_restaurant')}}
                        @if (App::getLocale() == 'en')
                            {{$restaurant->name_en}}
                        @else
                            {{$restaurant->name_ar}}
                        @endif</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ __('main.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('restaurant.list') }}">{{ __('main.Restaurant-list') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a
                                        href="{{route('meal.index',$restaurant->id)}}">{{ __('main.meals-list') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- upper nav -->
            <div class="row">
                {{-- restaurant details--}}
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('restaurant.edit',$restaurant->id) }}">
                        <div class="card pull-up" >
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info"></h3>
                                            <h3>{{ __('main.restaurant_details') }}</h3>
                                        </div>
                                        <div>
                                            <i class="la la-building danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- meals categories--}}
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('meal.category.index',$restaurant->id) }}">
                    <div class="card pull-up" >
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="info"></h3>
                                        <h3>{{ __('main.meal-categories') }}</h3>
                                    </div>
                                    <div>
                                        <i class="la la-list primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                {{-- meals --}}
                <div class="col-xl-2 col-lg-6 col-12">
                        <div class="card" style="pointer-events: none;background-color: #d1d7e0;
                         opacity: .75;">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info"></h3>
                                            <h3>{{ __('main.Meals') }}</h3>
                                        </div>
                                        <div>
                                            <i class="la la-cutlery info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                {{-- adds on --}}
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('addsOn.index',$restaurant->id) }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="warning"></h3>
                                            <h3>{{ __('main.Adds_on_categories') }}</h3>
                                        </div>
                                        <div>
                                            <i class="la la-reorder warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- reports --}}
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('report.index',$restaurant->id) }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"></h3>
                                            <h3>{{ __('main.reports') }}</h3>
                                        </div>
                                        <div>
                                            <i class="la la-file-text success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!--/upper nav -->
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-header">
                                    <h3 class="form-section"><i class="la la-cutlery font-large-1"></i>
                                        {{ __('main.All-meals') }}
                                    </h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>

                                    <div class="heading-elements">
                                        <!--  Button trigger modal -->
                                        <a href="{{ route('meal.create',$restaurant->id) }}"> <button type="button" class="btn btn-warning btn-sm" ><i class="ft-plus white"></i>
                                            {{ __('main.add-meal') }}</button></a>
                                    </div>

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
                                                <th>{{ __('main.id') }}</th>
                                                <th>{{ __('main.image') }}</th>
                                                <th>{{ __('main.name_ar') }}</th>
                                                <th>{{ __('main.name_en') }}</th>
                                                <th>{{ __('main.price') }}</th>
                                                <th>{{ __('main.meal-category') }}</th>
                                                <th>{{ __('main.actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($meals as $meal)
                                                <tr>
                                                    <td class = "text-center"> {{$meal->id}} </td>
                                                    <td class = "text-center"> <img style="width:100px; hight:100px" src="{{ asset($meal->image )}}" alt="image"> </td>
                                                    <td class = "text-center"> {{$meal->name_ar}} </td>
                                                    <td class = "text-center"> {{$meal->name_en}} </td>
                                                    <td class = "text-center"> {{$meal->price}} </td>
                                                    <td class = "text-center">
                                                        @if (App::getLocale() == 'en')
                                                            {{ $meal->rc_name_en }}
                                                        @else
                                                            {{ $meal->rc_name_ar }}
                                                        @endif
                                                    </td>
                                                    <td class = "text-center">
                                                           <span class="dropdown">
                                                                <button id="SearchDrop2" type="button" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="true"
                                                                        class="btn btn-warning dropdown-toggle  dropdown-menu-right "><i
                                                                        class="ft-settings"></i></button>
                                                                    <span aria-labelledby="SearchDrop2"
                                                                      class="dropdown-menu mt-1 dropdown-menu-left">
                                                                        <a href="{{route('meal.edit',$meal->id)}}" class="dropdown-item primary">
                                                                            <i class="ft-edit-2 primary"></i>
                                                                        {{ __('main.edit') }}</a>
                                                                        <a href="{{route('meal.delete',$meal->id)}}" class="dropdown-item danger">
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

    @if (Session::has('delete_msg_Meal'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('delete_msg_Meal') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('delete_msg_Meal') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
{{--    this script for toastr alert error--}}
    @if (Session::has('not_found_msg_meal'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.error('{{ Session::get('not_found_msg_meal') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.error('{{ Session::get('not_found_msg_meal') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
@endsection

