@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.add-new-meal') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ __('main.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('meal.create') }}">{{ __('main.add-new-meal') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
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
                                        <form class="form" method="post"
                                              action="{{ route('meal.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- resaturant Name ar Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ __('main.name_ar') }}</label>
                                                            <input type="text" id="RestaurantName" class="form-control"
                                                                   placeholder="{{ __('main.name_ar') }}"
                                                                   name="name_ar">
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
                                                            <input type="text" id="RestaurantName" class="form-control"
                                                                   placeholder="{{ __('main.name_en') }}"
                                                                   name="name_en">
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
                                                            <input type="text" id="RestaurantName" class="form-control"
                                                                   placeholder="{{ __('main.price') }}"
                                                                   name="price">
                                                            @error('price')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{--meal category--}}
                                                        <div class="form-group">
                                                            <label for="meal_category">{{ __('main.meal-category') }}</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-control" name="meal_category"
                                                                        id="meal_category">
                                                                    <option  value="">{{ __('main.meal-category') }}</option>
                                                                    @foreach($meal_categories as $meal_category)
                                                                    <option  value="{{$meal_category->id}}" >@if (App::getLocale() == 'en'){{ $meal_category->name_en }}
                                                                        @else
                                                                            {{ $meal_category->name_ar }}
                                                                        @endif</option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                            @error('meal_category')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-12">
                                                        {{-- image Field --}}
                                                        <label for="logo">{{ __('main.image') }}</label>
                                                        <fieldset class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       id="image" name="image" accept="image/*">
                                                                <label class="custom-file-label"
                                                                       for="inputGroupFile01">{{ __('main.choose-image') }}</label>
                                                                @error('image')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                                @enderror
                                                                @if(Session::has('uploaded'))
                                                                    <small class="form-text text-success"><strong>{{Session::get('uploaded')}}</strong></small>
                                                                @elseif(Session::has('not_uploaded'))
                                                                    <small class="form-text text-danger"><strong>{{Session::get('not_uploaded')}}</strong></small>
                                                                @endif
                                                            </div>
                                                        </fieldset>
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
