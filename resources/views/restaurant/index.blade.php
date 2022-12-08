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
                                                <th class = "text-center">{{ __('main.name') }}</th>
                                                <th class = "text-center">{{ __('main.category') }}</th>
                                                <th class = "text-center">{{ __('main.status') }}</th>
                                                <th class = "text-center">{{ __('main.restaurant_details') }}</th>
                                                <th class = "text-center">{{ __('main.actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($restaurants as $restaurant)
                                                <tr>
                                                    <td class = "text-center">{{$restaurant->id}}</td>
                                                    <td class = "text-center"> <img style="width:100px; hight:100px" src="{{asset( $restaurant->logo )}}" alt="logo"> </td>
                                                    <td class = "text-center"> <img style="width:100px; hight:100px" src="{{ asset($restaurant->cover_image)}}" alt="cover_image"> </td>
                                                    <td class = "text-center">
                                                        @if (App::getLocale() == 'en')
                                                            {{$restaurant->name_en}}
                                                        @else
                                                           {{$restaurant->name_ar}}
                                                        @endif
                                                    </td>

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
                                                    <td class = "text-center">
                                                        @if($restaurant->status == 1)
                                                            {{__('main.active')}}
                                                        @else
                                                            {{__('main.hidden')}}
                                                        @endif
                                                    </td>
                                                    <td class = "text-center">
                                                        <a href="{{ route('restaurant.edit',$restaurant->id) }}"> <button type="button" class="btn btn-warning btn-sm" ><i class="white"></i>
                                                                {{ __('main.restaurant_details') }}</button></a>
                                                    </td>


                                                    <td class = "text-center">
                                                        <a  id="deleteAlert{{$restaurant->id}}" >
                                                        <button type="button" class="btn btn-warning btn-sm" ><i class="white"></i>
                                                            {{ __('main.delete') }}</button></a>

                                                                {{--delete sweet alert--}}
                                                                <script>
                                                                   document.getElementById('deleteAlert{{$restaurant->id}}').addEventListener('click',function (){
                                                                       console.log('here');
                                                                      new swal({
                                                                           title: "{{__('main.are_you_sure')}}",
                                                                           text: "{{__('main.text_restaurant_delete')}}",
                                                                           icon: "warning",
                                                                           buttons: {
                                                                               cancel: {
                                                                                   text: "{{__('main.cancel')}}",
                                                                                   value: null,
                                                                                   visible: true,
                                                                                   className: "",
                                                                                   closeModal: false,
                                                                               },
                                                                               confirm: {
                                                                                   text: "{{__('main.confirm')}}",
                                                                                   value: true,
                                                                                   visible: true,
                                                                                   className: "",
                                                                                   closeModal: false
                                                                               }
                                                                           }
                                                                       })
                                                                           .then((isConfirm) => {
                                                                               if (isConfirm) {
                                                                                   location.href ="{{route('restaurant.delete',$restaurant->id)}}";
                                                                               } else {
                                                                                   new swal("{{__('main.Cancelled')}}", "{{__('main.Cancelled-text')}}", "error");
                                                                               }
                                                                           });
                                                                   });
                                                                </script>
                                                            {{--end of alert--}}
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
