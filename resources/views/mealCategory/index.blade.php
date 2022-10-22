@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.Meal-category-list') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">{{ __('main.home') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('category.restaurant.index') }}">{{ __('main.Meal-category-list') }}</a>
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
                                    <h3 class="form-section"><i class="la la-list font-large-1"></i>
                                        {{ __('main.categories') }}
                                    </h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <!--  Button trigger modal -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#add_form"><i class="ft-plus white"></i>
                                            {{ __('main.add-meal-category') }}</button>
                                    </div>
                                    {{-- start of add modal --}}
                                    <!-- Modal -->
                                    <div class="modal fade text-left" id="add_form" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel12" aria-hidden="true" data-backdrop="false"
                                         outsidedata-backdrop="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning white">
                                                    <h4 class="modal-title white" id="myModalLabel12">
                                                        {{ __('main.add-new-meal-category') }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('meal.category.store')}}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <h5><i class="la la-arrow-right"></i>
                                                            {{ __('main.add-meal-category-form-header') }}</h5>
                                                        <hr>
                                                        <div class="form-group">
                                                            <fieldset class="form-group">
                                                                <label for="name_ar">{{ __('main.category-name-ar') }} </label>
                                                                <input type="text" id="name_ar" class="form-control"
                                                                       placeholder="{{ __('main.category-name-ar') }}"
                                                                       name="name_ar">
                                                                @error('name_ar')
                                                                <small  class="form-text text-danger">{{$message}}</small>
                                                                @enderror
                                                            </fieldset>
                                                            <fieldset class="form-group">
                                                                <label for="name_en">{{ __('main.category-name-en') }} </label>
                                                                <input type="text" id="name_en" class="form-control"
                                                                       placeholder="{{ __('main.category-name-en') }}"
                                                                       name="name_en">
                                                                @error('name_en')
                                                                <small  class="form-text text-danger">{{$message}}</small>
                                                                @enderror
                                                            </fieldset>
                                                            <label for="restaurant_id">{{ __('main.choose-restaurant') }} </label>
                                                            <fieldset class="form-group">
                                                                <select class=" form-control"  id="restaurant_id" name="restaurant_id">
                                                                    <option value=""></option>
                                                                    @foreach($restaurants as $restaurant )
                                                                    <option value="{{$restaurant->id}}">
                                                                        @if (App::getLocale() == 'en')
                                                                            {{$restaurant->name_en}}
                                                                        @else
                                                                            {{$restaurant->name_ar}}
                                                                        @endif
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('restaurant_id')
                                                                <small  class="form-text text-danger">{{$message}}</small>
                                                                @enderror
                                                            </fieldset>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn grey btn-outline-secondary"
                                                                data-dismiss="modal">{{ __('main.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-outline-warning">{{ __('main.add') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end of add modal --}}
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
                                                <th class="text-center">{{ __('main.category-name-ar') }}
                                                </th>
                                                <th class="text-center">
                                                    {{ __('main.category-name-en') }}</th>
                                                <th class="text-center">{{ __('main.restaurant') }}
                                                </th>
                                                <th class="text-center">{{ __('main.actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($RestaurantCategories as $category)
                                                <tr>
                                                    <td class="text-center">
                                                        {{$category->name_ar}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$category->name_en}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if (App::getLocale() == 'en')
                                                            {{$category->re_name_en}}
                                                        @else
                                                            {{$category->re_name_ar}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                       <span class="dropdown">
                                                           <button id="SearchDrop2" type="button" data-toggle="dropdown"
                                                                   aria-haspopup="true" aria-expanded="true"
                                                                   class="btn btn-warning dropdown-toggle  dropdown-menu-right "><i
                                                                   class="ft-settings"></i></button>
                                                           <span aria-labelledby="SearchDrop2"
                                                                 class="dropdown-menu mt-1 dropdown-menu-left">
                                                               <a class="dropdown-item primary" data-toggle="modal"
                                                                  data-target="#edit_form_{{$category->id}}"><i
                                                                       class="ft-edit-2 primary"></i>
                                                                   {{ __('main.edit') }}</a>
                                                               <a href="{{route('meal.category.delete',$category->id)}}" class="dropdown-item danger">
                                                                   <i class="ft-trash-2 danger"></i>
                                                                   {{ __('main.delete') }}</a>
                                                       </span>
                                                     </span>
                                                    </td>
                                                </tr>
                                                <div class="modal fade text-left" id="edit_form_{{$category->id}}" tabindex="-1"
                                                     role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true"
                                                     data-backdrop="false" outsidedata-backdrop="false">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary white">
                                                                <h4 class="modal-title white" id="myModalLabel12">
                                                                    {{ __('main.edit-category-meal') }}
                                                                </h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('meal.category.update',$category->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <h5><i class="la la-arrow-right"></i>
                                                                        {{ __('main.edit-category-meal-form-header') }}
                                                                    </h5>
                                                                    <hr>
                                                                    <div class="form-group">
                                                                        <fieldset class="form-group">
                                                                            <label for="name_ar">{{ __('main.category-name-ar') }} </label>
                                                                            <input type="text" id="name_ar" class="form-control"
                                                                                   placeholder="{{ __('main.category-name-ar') }}"
                                                                                   name="name_ar" value="{{$category->name_ar}}">
                                                                            @error('name_ar')
                                                                            <small  class="form-text text-danger">{{$message}}</small>
                                                                            @enderror
                                                                        </fieldset>
                                                                        <fieldset class="form-group">
                                                                            <label for="name_en">{{ __('main.category-name-en') }} </label>
                                                                            <input type="text" id="name_en" class="form-control"
                                                                                   placeholder="{{ __('main.category-name-en') }}"
                                                                                   name="name_en" value="{{$category->name_en}}">
                                                                            @error('name_en')
                                                                            <small  class="form-text text-danger">{{$message}}</small>
                                                                            @enderror
                                                                        </fieldset>
                                                                        <label for="restaurant_id">{{ __('main.choose-restaurant') }} </label>
                                                                        <fieldset class="form-group">
                                                                            <select class=" form-control"  id="restaurant_id" name="restaurant_id">
                                                                                <option value=""></option>

                                                                                @foreach($restaurants as $restaurant )
                                                                                    <option value="{{$restaurant->id}}"
                                                                                       @if($category->resturant_id == $restaurant->id )
                                                                                        selected
                                                                                        @endif>
                                                                                        @if (App::getLocale() == 'en')
                                                                                            {{$restaurant->name_en}}
                                                                                        @else
                                                                                            {{$restaurant->name_ar}}
                                                                                        @endif
                                                                                    </option>
                                                                                @endforeach

                                                                            </select>
                                                                            @error('restaurant_id')
                                                                            <small  class="form-text text-danger">{{$message}}</small>
                                                                            @enderror
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn grey btn-outline-secondary"
                                                                            data-dismiss="modal">{{ __('main.close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-outline-primary">{{ __('main.edit') }}
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- end of the list --}}
                                </div>
                                {{-- end of the card body --}}
                            </div>
                        </div>
                        {{-- end of the card --}}
                    </div>
                    {{-- end of the col --}}
                </section>
            </div>
        </div>
    </div>
@endsection
@section('search js')
    {{--    create--}}
    @if (Session::has('create_msg_Meal_category'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('create_msg_Meal_category') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('create_msg_Meal_category') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    update--}}
    @if (Session::has('update_msg_Category_Meal'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('update_msg_Category_Meal') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('update_msg_Category_Meal') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    not found--}}
    @if (Session::has('not_found_msg_Category'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.error('{{ Session::get('not_found_msg_Category') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.error('{{ Session::get('not_found_msg_Category') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    Can't Delete--}}
    @if (Session::has('cant_delete_msg_Category_Meal'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.error('{{ Session::get('cant_delete_msg_Category_Meal') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.error('{{ Session::get('cant_delete_msg_Category_Meal') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    delete--}}
    @if (Session::has('delete_msg_Category_Meal'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('delete_msg_Category_Meal') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('delete_msg_Category_Meal') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
@endsection
