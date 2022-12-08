@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.general-management') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ __('main.home') }}</a>
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
                                    <h3 class="form-section"><i class="la la-gears font-large-1"></i>
                                        {{ __('main.options-general-management') }}
                                    </h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="post" action="{{ route('general.store') }}" name="create_form" onsubmit="return validateForm(event)" >
                                            @csrf
                                            <div class="form-body">
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- show_distance_restaurant --}}
                                                        <div class="form-group">
                                                            <fieldset>
                                                                <div class="float-left">
                                                                    <label for="show_distance" class="pr-1">{{ __('main.show_distance_restaurant') }}</label>
                                                                    <input type="checkbox" class="switch" id="show_distance"
                                                                           name="show_distance"
                                                                           data-icon-cls="fa" data-off-icon-cls="ft-thumbs-down"
                                                                           data-on-icon-cls="ft-thumbs-up"
                                                                           data-group-cls="btn-group-sm"
                                                                           data-on-label="{{__('main.yes')}}"
                                                                           data-off-label="{{__('main.no')}}"
                                                                           data-switch-always
                                                                            value="{{$general_management->show_resturant_distance}}"
                                                                           @if($general_management->show_resturant_distance ==1) checked @endif
                                                                    />
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- Show_closed_restaurants --}}
                                                        <div class="form-group">
                                                            <fieldset>
                                                                <div class="float-left">
                                                                    <label for="show_closed" class="pr-1">{{ __('main.Show_closed_restaurants') }}</label>
                                                                    <input type="checkbox" class="switch" id="show_closed"
                                                                           name="show_closed"
                                                                           data-icon-cls="fa" data-off-icon-cls="ft-thumbs-down"
                                                                           data-on-icon-cls="ft-thumbs-up"
                                                                           data-group-cls="btn-group-sm"
                                                                           data-on-label="{{__('main.yes')}}"
                                                                           data-off-label="{{__('main.no')}}"
                                                                           data-switch-always
                                                                           value="{{$general_management->show_closed_restaurants}}"
                                                                           @if($general_management->show_closed_restaurants ==1) checked @endif
                                                                    />
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- Show_working_hours Field --}}
                                                        <fieldset>
                                                            <div class="float-left">
                                                                <label for="show_closed" class="pr-1">{{ __('main.Show_working_hours') }}</label>
                                                                <input type="checkbox" class="switch" id="show_working_hours"
                                                                       name="show_working_hours"
                                                                       data-icon-cls="fa" data-off-icon-cls="ft-thumbs-down"
                                                                       data-on-icon-cls="ft-thumbs-up"
                                                                       data-group-cls="btn-group-sm"
                                                                       data-on-label="{{__('main.yes')}}"
                                                                       data-off-label="{{__('main.no')}}"
                                                                       data-switch-always
                                                                       value="{{$general_management->show_restaurant_working_hours}}"
                                                                       @if($general_management->show_restaurant_working_hours ==1) checked @endif
                                                                />
                                                            </div>
                                                        </fieldset>
                                                        </div>
                                                    <div class="col-md-6">
                                                        {{-- payment_options Field --}}
                                                        <label for="payment_options" class="pr-1">{{ __('main.payment_options') }}</label>
                                                            <div class="d-inline-block">
                                                            <div class="d-inline-block pr-1">
                                                                <input type="radio" name="payment_options" id="cash" value="2" @if($general_management->available_payment ==2) checked @endif>
                                                                <label for="cash">{{ __('main.cash') }}</label>
                                                            </div>
                                                             <div class="d-inline-block pr-1">
                                                                <input type="radio" name="payment_options" id="visa" value="3" @if($general_management->available_payment ==3) checked @endif>
                                                                <label for="visa">{{ __('main.visa') }}</label>
                                                            </div>
                                                            <div class="d-inline-block pr-1">
                                                                <input type="radio" name="payment_options" id="both" value="1" @if($general_management->available_payment ==1) checked @endif>
                                                                <label for="both">{{ __('main.both') }}</label>
                                                            </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- Maximum_range Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="Maximum_range">{{ __('main.Maximum_range') }}</label>
                                                            <input type="number" step="0.01" id="maximum_range" class="form-control"
                                                                   placeholder="{{ __('main.Maximum_range') }}"
                                                                   name="maximum_range" value="{{$general_management->maximum_range_users_see}}">
                                                            @error('maximum_range')
                                                            <small
                                                                class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                                            @enderror
                                                            <small class="form-text text-danger" id="maximum_range_price_error" style="display: none">
                                                                <strong>{{ __('main.maximum_range_messages') }}</strong></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- Price_kilometer Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="Price_kilometer">{{ __('main.Price_kilometer') }}</label>
                                                            <input type="number" step="0.01" id="price_kilometer" class="form-control"
                                                                   placeholder="{{ __('main.Price_kilometer') }}"
                                                                   name="price_kilometer" value="{{$general_management->price_per_kilometer}}">
                                                            @error('price_kilometer')
                                                            <small
                                                                class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                                            @enderror
                                                            <small class="form-text text-danger" id="Price_kilometer_error" style="display: none">
                                                                <strong>{{ __('main.price_kilometer_messages') }}</strong></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- Start_calculating Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="start_calculating">{{ __('main.Start_calculating') }}</label>
                                                            <input type="number" step="0.01" id="start_calculating" class="form-control"
                                                                   placeholder="{{ __('main.Start_calculating') }}"
                                                                   name="start_calculating" value="{{$general_management->delivery_price_from}}">
                                                            @error('start_calculating')
                                                            <small
                                                                class="form-text text-danger"> <strong>{{ $message }}</strong></small>
                                                            @enderror
                                                            <small class="form-text text-danger" id="start_calculating_error" style="display: none">
                                                                <strong>{{ __('main.start_calculating_messages') }}</strong></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-center pt-1">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4>{{ __('main.choose_countries') }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-12">
                                                        {{-- countries list --}}
                                                        <div class="form-group">
                                                            <select multiple="multiple" size="10" class="duallistbox-with-filter" name="countries[]">
                                                                @foreach($countries as $country)
                                                                <option value="{{$country->id}}" @if($country->selected == 1)selected="selected" @endif>
                                                                    @if (App::getLocale() == 'en')
                                                                        {{$country->country_name_en}}
                                                                    @else
                                                                        {{$country->country_name_ar}}
                                                                    @endif
                                                                </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            {{-- save button --}}
                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>
                                                    {{ __('main.save-changes') }}
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
    @include('includes.generalValidation')
    <script>
        //With Filter Options
        $('.duallistbox-with-filter').bootstrapDualListbox({
            showFilterInputs: false,
            nonSelectedListLabel: '{{__('main.Non-selected')}}',
            selectedListLabel: '{{__('main.selected')}}',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: true,
            infoTextEmpty: '{{__('main.Empty-list')}}',
            infoText:'{{__('main.Showing-all')}}{0}'
        });
    </script>
    {{--create--}}
    @if (Session::has('save_msg_changes'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('save_msg_changes') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('save_msg_changes') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif

@endsection

