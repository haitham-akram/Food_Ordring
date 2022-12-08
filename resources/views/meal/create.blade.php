@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.add-new-meal') }} {{__('main.for_restaurant')}}
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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('meal.create',$restaurant->id) }}">{{ __('main.add-new-meal') }}</a>
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
                    <a href="{{ route('meal.index',$restaurant->id) }}">
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
                <!-- form start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="form-section"><i class="la la-cutlery font-large-1"></i>
                                        {{ __('main.meal-info') }}
                                    </h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="post" name="create_form" onsubmit="return validateForm(event)"
                                              action="{{ route('meal.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- resaturant Name ar Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ __('main.name_ar') }}</label>
                                                            <input type="text" id="name_ar" class="form-control"
                                                                   placeholder="{{ __('main.name_ar') }}"
                                                                   name="name_ar">
                                                            <small class="form-text text-danger" id="error_name_ar" style="display: none">
                                                                <strong>{{ __('main.meal_name_ar_messages') }}</strong></small>
                                                            @error('name_ar')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- resaturant Name en Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ __('main.name_en') }}</label>
                                                            <input type="text" id="name_en" class="form-control"
                                                                   placeholder="{{ __('main.name_en') }}"
                                                                   name="name_en">
                                                            <small class="form-text text-danger" id="error_name_en" style="display: none">
                                                                <strong>{{ __('main.meal_name_en_messages') }}</strong></small>
                                                            @error('name_en')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- description_ar Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="description_ar">{{ __('main.description_ar') }}</label>
                                                            <textarea style="resize: none" class="form-control" id="description_ar" rows="3" name="description_ar"
                                                                      placeholder="{{ __('main.description_ar') }}"></textarea>
                                                            <small class="form-text text-danger" id="error_description_ar" style="display: none">
                                                                <strong>{{ __('main.meal_description_ar_messages') }}</strong></small>
                                                            @error('description_ar')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- description_en Field --}}
                                                        <div class="form-group">
                                                            <label for="description_en">{{ __('main.description_en') }}</label>
                                                            <textarea style="resize: none" class="form-control" id="description_en" rows="3" name="description_en"
                                                                      placeholder="{{ __('main.description_en') }}"></textarea>
                                                            <small class="form-text text-danger" id="error_description_en" style="display: none">
                                                                <strong>{{ __('main.meal_description_en_messages') }}</strong></small>
                                                            @error('description_en')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- price Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ __('main.price') }}</label>
                                                            <input type="number" step="0.01" id="price" class="form-control"
                                                                   placeholder="{{ __('main.price') }}"
                                                                   name="price">
                                                            <small class="form-text text-danger" id="error_price" style="display: none">
                                                                <strong>{{ __('main.meal_price_messages') }}</strong></small>
                                                            @error('price')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        {{-- image Field --}}
                                                        <label for="logo">{{ __('main.image') }}</label>
                                                        <fieldset class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       id="image" name="image" accept=".png,.jpg,.gif" >
                                                                <label class="custom-file-label"
                                                                     id="image_name"  for="inputGroupFile01">{{ __('main.choose-image') }}</label>
                                                                @error('image')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                                @enderror
                                                                <small class="form-text text-danger" id="error_image" style="display: none">
                                                                    <strong>{{ __('main.meal_image_messages') }}</strong></small>
                                                                @if(Session::has('uploaded'))
                                                                    <small class="form-text text-success"><strong>{{Session::get('uploaded')}}</strong></small>
                                                                @elseif(Session::has('not_uploaded'))
                                                                    <small class="form-text text-danger"><strong>{{Session::get('not_uploaded')}}</strong></small>
                                                                @endif
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{--meal category--}}
                                                        <div class="form-group">
                                                            <label for="meal_category">{{ __('main.meal-category') }}</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-control" name="meal_category"
                                                                        id="meal_category">
                                                                    <option  value="" disabled>{{ __('main.meal-category') }}</option>
                                                                    @foreach($meal_categories as $meal_category)
                                                                        <option  value="{{$meal_category->id}}" >
                                                                            @if (App::getLocale() == 'en')
                                                                                {{ $meal_category->name_en }}
                                                                            @else
                                                                                {{ $meal_category->name_ar }}
                                                                            @endif</option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                            @error('meal_category')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                            <small class="form-text text-danger" id="error_mealCategory" style="display: none">
                                                                <strong>{{ __('main.meal_category_messages') }}</strong></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{--Adds on Category Field --}}
                                                        <div class="form-group">
                                                            <label for="category">{{ __('main.Adds_on_category') }}</label>
                                                            <select class="select2 form-control" multiple="multiple"
                                                                    id="Adds_on_category" name="Adds_on_category_id[]">
                                                                @foreach($addsOnCategories as $AddsOnCategory)
                                                                    <option  value="{{$AddsOnCategory->id}}" >
                                                                        @if (App::getLocale() == 'en')
                                                                            {{ $AddsOnCategory->name_en }}
                                                                        @else
                                                                            {{ $AddsOnCategory->name_ar }}
                                                                        @endif</option>
                                                                @endforeach
                                                            </select>

                                                            @error('Adds_on_category_id')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Add and Cancel button --}}
                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>
                                                    {{ __('main.add-meal') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- //  Form section end -->
            </div>
        </div>
    </div>

@endsection
@section('search js')
    @include('includes.mealValidation')
    <script>
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            document.getElementById('image_name').innerHTML
                = fileName;
        });
    </script>
    {{--create--}}
    @if (Session::has('create_msg_Meal'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('create_msg_Meal') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('create_msg_Meal') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
@endsection
