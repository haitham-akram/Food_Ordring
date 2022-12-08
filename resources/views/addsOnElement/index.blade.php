@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.Adds-on-list-element') }} {{__('main.in_category')}}
                        @if (App::getLocale() == 'en')
                            {{$AddOnList->name_en}}
                        @else
                            {{$AddOnList->name_ar}}
                        @endif
                        @if (App::getLocale() == 'en')
                            {{__('main.for_restaurant')}} {{$restaurant->name_en}}
                        @else
                            {{__('main.for_restaurant')}} {{$restaurant->name_ar}}
                        @endif

                    </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('main.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('restaurant.list') }}">{{ __('main.Restaurant-list') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('addsOn.index',$AddOnList->resturant_id) }}">{{ __('main.Adds-on-list') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('addsOn_element.index',$AddOnList->id) }}">{{ __('main.Adds-on-list-element') }}</a>
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
                    <a href="{{ route('restaurant.edit',$AddOnList->resturant_id) }}">
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
                    <a href="{{ route('meal.category.index',$AddOnList->resturant_id) }}">
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
                    <a href="{{ route('meal.index',$AddOnList->resturant_id) }}">
                        <div class="card pull-up">
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
                    </a>
                </div>
                {{-- adds on --}}
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('addsOn.index',$AddOnList->resturant_id) }}">
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
                    <a href="{{ route('report.index',$AddOnList->resturant_id) }}">
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
                                    <h3 class="form-section"><i class="la la-plus-square-o font-large-1"></i>
                                        {{ __('main.Adds_on') }}
                                    </h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <!--  Button trigger modal -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#add_form"><i class="ft-plus white"></i>
                                            {{ __('main.add-adds-on-element') }}</button>
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
                                                        {{ __('main.add-new-adds-on-element') }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('addsOn_element.store',$AddOnList->id)}}" method="POST" name="form0" onsubmit="return validateForm(event)">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <h5><i class="la la-arrow-right"></i>
                                                            {{ __('main.add-adds_on-category-form-header') }}</h5>
                                                        <hr>
                                                        <div class="form-group">
                                                            <fieldset class="form-group">
                                                                <label for="name_ar0">{{ __('main.AddsOn-name-ar') }} </label>
                                                                <input type="text" id="name_ar0" class="form-control"
                                                                       placeholder="{{ __('main.category-name-ar') }}"
                                                                       name="name_ar">
                                                                @error('name_ar')
                                                                <small  class="form-text text-danger">{{$message}}</small>
                                                                @enderror
                                                                <small class="form-text text-danger" id="error_name_ar0" style="display: none">
                                                                    <strong>{{ __('main.addsOn_name_ar_messages') }}</strong></small>
                                                            </fieldset>
                                                            <fieldset class="form-group">
                                                                <label for="name_en0">{{ __('main.AddsOn-name-en') }} </label>
                                                                <input type="text" id="name_en0" class="form-control"
                                                                       placeholder="{{ __('main.AddsOn-name-ar') }}"
                                                                       name="name_en">
                                                                @error('name_en')
                                                                <small  class="form-text text-danger">{{$message}}</small>
                                                                @enderror
                                                                <small class="form-text text-danger" id="error_name_en0" style="display: none">
                                                                    <strong>{{ __('main.addsOn_name_en_messages') }}</strong></small>
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
                                                <th class="text-center">{{ __('main.AddsOn-name-ar') }}</th>
                                                <th class="text-center">{{ __('main.AddsOn-name-en') }}</th>
                                                <th class="text-center">{{ __('main.actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($AddOnElements as $AddOnElement)
                                                <tr>
                                                    <td class="text-center">
                                                        {{$AddOnElement->name_ar}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$AddOnElement->name_en}}
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
                                                                  data-target="#edit_form_{{$AddOnElement->id}}" element_id = {{$AddOnElement->id}} id="element_edit">
                                                                   <i class="ft-edit-2 primary"></i>
                                                                   {{ __('main.edit') }}</a>
                                                               <a href="{{route('addsOn_element.delete',$AddOnElement->id)}}" class="dropdown-item danger">
                                                                   <i class="ft-trash-2 danger"></i>
                                                                   {{ __('main.delete') }}</a>
                                                       </span>
                                                     </span>
                                                    </td>
                                                </tr>
                                                <div class="modal fade text-left" id="edit_form_{{$AddOnElement->id}}" tabindex="-1"
                                                     role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true"
                                                     data-backdrop="false" outsidedata-backdrop="false">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary white">
                                                                <h4 class="modal-title white" id="myModalLabel12">
                                                                    {{ __('main.edit-adds_on-category') }}
                                                                </h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('addsOn_element.update',$AddOnElement->id) }}" method="POST" name="form{{$AddOnElement->id}}" onsubmit="return validateForm(event)">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <h5><i class="la la-arrow-right"></i>
                                                                        {{ __('main.edit-adds_on-category-form-header') }}
                                                                    </h5>
                                                                    <hr>
                                                                    <div class="form-group">
                                                                        <fieldset class="form-group">
                                                                            <label for="name_ar">{{ __('main.category-name-ar') }} </label>
                                                                            <input type="text" id="name_ar{{$AddOnElement->id}}" class="form-control"
                                                                                   placeholder="{{ __('main.category-name-ar') }}"
                                                                                   name="name_ar" value="{{$AddOnElement->name_ar}}">
                                                                            @error('name_ar')
                                                                            <small  class="form-text text-danger">{{$message}}</small>
                                                                            @enderror
                                                                            <small class="form-text text-danger" id="error_name_ar{{$AddOnElement->id}}" style="display: none">
                                                                                <strong>{{ __('main.addsOn_name_ar_messages') }}</strong></small>
                                                                        </fieldset>
                                                                        <fieldset class="form-group">
                                                                            <label for="name_en">{{ __('main.category-name-en') }} </label>
                                                                            <input type="text" id="name_en{{$AddOnElement->id}}" class="form-control"
                                                                                   placeholder="{{ __('main.category-name-en') }}"
                                                                                   name="name_en" value="{{$AddOnElement->name_en}}">
                                                                            @error('name_en')
                                                                            <small  class="form-text text-danger">{{$message}}</small>
                                                                            @enderror
                                                                            <small class="form-text text-danger" id="error_name_en{{$AddOnElement->id}}" style="display: none">
                                                                                <strong>{{ __('main.addsOn_name_en_messages') }}</strong></small>
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
    @include('includes.addsElementValidation')
    {{--    create--}}
    @if (Session::has('create_msg_Adds_on'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('create_msg_Adds_on') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('create_msg_Adds_on') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    update--}}
    @if (Session::has('update_msg_Adds_on'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('update_msg_Adds_on') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('update_msg_Adds_on') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    not found--}}
    @if (Session::has('not_found_msg_Adds_on'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.error('{{ Session::get('not_found_msg_Adds_on') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.error('{{ Session::get('not_found_msg_Adds_on') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    delete--}}
    @if (Session::has('delete_msg_Adds_on'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('delete_msg_Adds_on') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('delete_msg_Adds_on') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
@endsection



