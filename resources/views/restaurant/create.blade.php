@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.add-new-restaurant') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ __('main.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('restaurant.create') }}">{{ __('main.add-new-restaurant') }}</a>
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
                                    <h3 class="form-section"><i class="la la-building font-large-1"></i>
                                        {{ __('main.restaurant-info') }}
                                    </h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="post"
                                              action="{{ route('restaurant.store') }}" name="create_form" onsubmit="return validateForm()"  enctype="multipart/form-data">
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
                                                                <strong>{{ __('main.restaurant_name_ar_messages') }}</strong></small>
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
                                                                <strong>{{ __('main.restaurant_name_en_messages') }}</strong></small>
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
                                                                <strong>{{ __('main.restaurant_description_ar_messages') }}</strong></small>
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
                                                                <strong>{{ __('main.restaurant_description_en_messages') }}</strong></small>
                                                            @error('description_en')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- logo Field --}}
                                                        <label for="logo">{{ __('main.logo') }}</label>
                                                        <fieldset class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       id="logo" name="logo" accept=".png,.jpg,.gif">
                                                                <label class="custom-file-label"
                                                                       id="logo_name"  for="inputGroupFile01">{{ __('main.choose-logo') }}</label>
                                                                @error('logo')
                                                                <small
                                                                    class="form-text text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <small class="form-text text-danger" id="error_logo" style="display: none">
                                                                <strong>{{ __('main.logo_messages') }}</strong></small>
                                                            @if(Session::has('uploaded'))
                                                                <small class="form-text text-success"><strong>{{Session::get('uploaded')}}</strong></small>
                                                            @elseif(Session::has('not_uploaded'))
                                                                <small class="form-text text-danger"><strong>{{Session::get('not_uploaded')}}</strong></small>
                                                            @endif
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- cover image Field --}}
                                                        <label for="logo">{{ __('main.cover_image_Optional') }}</label>
                                                        <fieldset class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       id="cover_image" name="cover_image" accept=".png,.jpg,.gif">
                                                                <label class="custom-file-label"
                                                                       id="cover_image_name"   for="inputGroupFile01">{{ __('main.choose-cover_image') }}</label>
                                                                @error('cover_image')
                                                                <small
                                                                    class="form-text text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            @if(Session::has('uploaded_2'))
                                                                <small class="form-text text-success"><strong>{{Session::get('uploaded')}}</strong></small>
                                                            @elseif(Session::has('not_uploaded_2'))
                                                                <small class="form-text text-danger"><strong>{{Session::get('not_uploaded')}}</strong></small>
                                                            @endif
                                                        </fieldset>
                                                    </div>
                                                </div>

                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- Available Status Field --}}
                                                        <div class="form-group">
                                                            <label for="status">{{ __('main.status') }}</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-control" name="status"
                                                                        id="status">
                                                                    <option  value="1" selected>{{ __('main.active') }}</option>
                                                                    <option  value="2">{{ __('main.hide') }}</option>
                                                                </select>
                                                            </fieldset>
                                                            @error('status')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- Category Field --}}
                                                        <div class="form-group">
                                                            <label for="category">{{ __('main.category') }}</label>
                                                                <select class="select2 form-control" multiple="multiple"
                                                                        id="category" name="category_id[]">
                                                                    @foreach($categories as $category)
                                                                    <option value="{{$category->id}}">
                                                                        @if (App::getLocale() == 'en')
                                                                            {{$category->name_en}}
                                                                        @else
                                                                            {{$category->name_ar}}
                                                                        @endif</option>
                                                                    @endforeach
                                                                </select>

                                                            @error('category_id')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                            <small class="form-text text-danger" id="error_category" style="display: none">
                                                                <strong>{{ __('main.category_id_messages') }}</strong></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-center pt-1">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4>{{ __('main.location') }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- latitude Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="latitude">{{ __('main.latitude') }}</label>
                                                            <input type="text" id="latitude" class="form-control"
                                                                   placeholder="{{ __('main.latitude') }}"
                                                                   name="latitude">
                                                            <small class="form-text text-danger" id="error_latitude" style="display: none">
                                                                <strong>{{ __('main.latitude_messages') }}</strong></small>
                                                            @error('latitude')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- longitude Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="longitude">{{ __('main.longitude') }}</label>
                                                            <input type="text" id="longitude" class="form-control"
                                                                   placeholder="{{ __('main.longitude') }}"
                                                                   name="longitude">
                                                            <small class="form-text text-danger" id="error_longitude" style="display: none">
                                                                <strong>{{ __('main.longitude_messages') }}</strong></small>
                                                            @error('longitude')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row pl-1 pr-1">
                                                    {{-- this the map --}}
                                                    <div id="map" style="height:400px; width: 800px;" class="col-md-12 my-2"></div>
                                                </div>

                                                <div class="d-flex justify-content-center pt-1">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4>{{ __('main.open_close') }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- monday_open_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="monday_open_at">{{ __('main.monday_open_at') }}</label>
                                                            <input type="time" id="monday_open_at" class="form-control"
                                                                   placeholder="{{ __('main.monday_open_at') }}"
                                                                   name="monday_open_at" value="09:00:00">
                                                            @error('monday_open_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- monday_end_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="monday_end_at">{{ __('main.monday_end_at') }}</label>
                                                            <input type="time" id="monday_end_at" class="form-control"
                                                                   placeholder="{{ __('main.monday_end_at') }}"
                                                                   name="monday_end_at" value="00:10:00">
                                                            @error('monday_end_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- tuesday_open_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="tuesday_open_at">{{ __('main.tuesday_open_at') }}</label>
                                                            <input type="time" id="tuesday_open_at" class="form-control"
                                                                   placeholder="{{ __('main.tuesday_open_at') }}"
                                                                   name="tuesday_open_at" value="09:00:00">
                                                            @error('tuesday_open_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- tuesday_end_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="tuesday_end_at">{{ __('main.tuesday_end_at') }}</label>
                                                            <input type="time" id="tuesday_end_at" class="form-control"
                                                                   placeholder="{{ __('main.tuesday_end_at') }}"
                                                                   name="tuesday_end_at" value="00:00:00">
                                                            @error('tuesday_end_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- wednesday_open_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="wednesday_open_at">{{ __('main.wednesday_open_at') }}</label>
                                                            <input type="time" id="wednesday_open_at" class="form-control"
                                                                   placeholder="{{ __('main.wednesday_open_at') }}"
                                                                   name="wednesday_open_at" value="09:00:00">
                                                            @error('wednesday_open_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- wednesday_end_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="wednesday_end_at">{{ __('main.wednesday_end_at') }}</label>
                                                            <input type="time" id="wednesday_end_at" class="form-control"
                                                                   placeholder="{{ __('main.wednesday_end_at') }}"
                                                                   name="wednesday_end_at" value="00:00:00">
                                                            @error('wednesday_end_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- thursday_open_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="thursday_open_at">{{ __('main.thursday_open_at') }}</label>
                                                            <input type="time" id="thursday_open_at" class="form-control"
                                                                   placeholder="{{ __('main.thursday_open_at') }}"
                                                                   name="thursday_open_at" value="09:00:00">
                                                            @error('thursday_open_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- thursday_end_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="thursday_end_at">{{ __('main.thursday_end_at') }}</label>
                                                            <input type="time" id="thursday_end_at" class="form-control"
                                                                   placeholder="{{ __('main.thursday_end_at') }}"
                                                                   name="thursday_end_at" value="00:00:00">
                                                            @error('thursday_end_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- friday_open_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="friday_open_at">{{ __('main.friday_open_at') }}</label>
                                                            <input type="time" id="friday_open_at" class="form-control"
                                                                   placeholder="{{ __('main.friday_open_at') }}"
                                                                   name="friday_open_at" value="09:00:00">
                                                            @error('friday_open_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- friday_end_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="friday_end_at">{{ __('main.friday_end_at') }}</label>
                                                            <input type="time" id="friday_end_at" class="form-control"
                                                                   placeholder="{{ __('main.friday_end_at') }}"
                                                                   name="friday_end_at" value="00:00:00">
                                                            @error('friday_end_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- saturday_open_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="saturday_open_at">{{ __('main.saturday_open_at') }}</label>
                                                            <input type="time" id="saturday_open_at" class="form-control"
                                                                   placeholder="{{ __('main.saturday_open_at') }}"
                                                                   name="saturday_open_at" value="09:00:00">
                                                            @error('saturday_open_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- saturday_end_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="saturday_end_at">{{ __('main.saturday_end_at') }}</label>
                                                            <input type="time" id="saturday_end_at" class="form-control"
                                                                   placeholder="{{ __('main.saturday_end_at') }}"
                                                                   name="saturday_end_at" value="00:00:00">
                                                            @error('saturday_end_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 pr-1">
                                                    <div class="col-md-6">
                                                        {{-- sunday_open_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="sunday_open_at">{{ __('main.sunday_open_at') }}</label>
                                                            <input type="time" id="sunday_open_at" class="form-control"
                                                                   placeholder="{{ __('main.sunday_open_at') }}"
                                                                   name="sunday_open_at" value="09:00:00">
                                                            @error('sunday_open_at')
                                                            <small
                                                                class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- sunday_end_at Field --}}
                                                        <div class="form-group">
                                                            <label
                                                                for="sunday_end_at">{{ __('main.sunday_end_at') }}</label>
                                                            <input type="time" id="sunday_end_at" class="form-control"
                                                                   placeholder="{{ __('main.sunday_end_at') }}"
                                                                   name="sunday_end_at" value="00:00:00">
                                                            @error('sunday_end_at')
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
                                                    {{ __('main.add-Restaurant') }}
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
    @include('includes.restaurantFromValidation')
    {{--the script is for map--}}
    <script>
        let map;
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 24.633, lng: 46.695 },
                zoom: 8,
                scrollwheel: true,
            });
            const uluru = { lat: 24.633, lng: 46.695 };
            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });
            google.maps.event.addListener(marker,'position_changed',
                function (){
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#latitude').val(lat)
                    $('#longitude').val(lng)
                })
            google.maps.event.addListener(map,'click',
                function (event){
                    pos = event.latLng
                    marker.setPosition(pos)
                })
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
            type="text/javascript"></script>

@endsection
@section('search js')
    <script>
        $('input[name="logo"]').change(function(e){
            var fileName = e.target.files[0].name;
            document.getElementById('logo_name').innerHTML
                = fileName;
        });
        $('input[name="cover_image"]').change(function(e){
            var fileName = e.target.files[0].name;
            document.getElementById('cover_image_name').innerHTML
                = fileName;
        });
    </script>
    {{--create--}}
    @if (Session::has('create_msg_Restaurant'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('create_msg_Restaurant') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('create_msg_Restaurant') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif



@endsection
