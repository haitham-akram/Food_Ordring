@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.banners-list') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ __('main.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('banner.index') }}">{{ __('main.banners-list') }}</a>
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
                                    <h3 class="form-section"><i class="la la-photo font-large-1"></i>
                                        {{ __('main.banners') }}
                                    </h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <!--  Button trigger modal -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#add_form"><i class="ft-plus white"></i>
                                            {{ __('main.add-new-banner') }}</button>
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
                                                        {{ __('main.add-new-banner') }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('banner.store')}}" method="POST" name="bannerForm" onsubmit="return validateForm()" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <h5><i class="la la-arrow-right"></i>
                                                            {{ __('main.add-banner-form-header') }}</h5>
                                                        <hr>
                                                        <div class="form-group">

                                                            <label for="logo">{{ __('main.image') }}</label>
                                                            <fieldset class="form-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                           id="image" name="image" accept="image/gif, image/jpeg, image/png" >
                                                                    <label class="custom-file-label"
                                                                           id="image_name"  for="inputGroupFile01">{{ __('main.choose-image') }}</label>
                                                                    <small class="form-text text-danger" id="error_image" style="display: none">
                                                                        <strong>{{ __('main.meal_image_messages') }}</strong></small>
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
                                               class="table table-white-space table-bordered row-grouping display no-wrap table-middle">
                                            <thead>
                                            <tr>
                                                <th class="text-center">{{ __('main.order') }}
                                                </th>
                                                <th class="text-center">
                                                    {{ __('main.banner') }}</th>
                                                <th class="text-center">{{ __('main.created_at') }}
                                                </th>
                                                <th class="text-center">{{ __('main.actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($banners as $banner)
                                                <tr>
                                                    <td class="text-center">
                                                        {{$banner->order}}
                                                    </td>

                                                    <td class="text-center">
                                                        <img style="width:250px; hight:100px" src="{{asset( $banner->banner_url ) }}" alt="image">
                                                    </td>
                                                    <td class="text-center">
                                                        {{$banner->created_at}}
                                                    </td>
                                                    <td class="text-center">
                                                       <span class="dropdown">
                                                           <button id="SearchDrop2" type="button" data-toggle="dropdown"
                                                                   aria-haspopup="true" aria-expanded="true"
                                                                   class="btn btn-warning dropdown-toggle  dropdown-menu-right "><i
                                                                   class="ft-settings"></i></button>
                                                           <span aria-labelledby="SearchDrop2"
                                                                 class="dropdown-menu mt-1 dropdown-menu-left">
                                                               <a  class="show_edit dropdown-item primary" data-toggle="modal"
                                                                   data-target="#edit_form_{{$banner->id}}" >
                                                                   <i class="ft-edit-2 primary"></i>
                                                                   {{ __('main.edit') }}</a>
                                                               <a href="{{route('banner.delete',$banner->id)}}" class="dropdown-item danger">
                                                                   <i class="ft-trash-2 danger"></i>
                                                                   {{ __('main.delete') }}</a>
                                                       </span>
                                                     </span>
                                                    </td>
                                                </tr>
                                                <div class="modal fade text-left" id="edit_form_{{$banner->id}}" tabindex="-1"
                                                     role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true"
                                                     data-backdrop="false" outsidedata-backdrop="false">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary white">
                                                                <h4 class="modal-title white" id="myModalLabel12">
                                                                    {{ __('main.edit-banner') }}
                                                                </h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('banner.update',$banner->id) }}"  method="POST" enctype="multipart/form-data" >
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <h5><i class="la la-arrow-right"></i>
                                                                        {{ __('main.edit-banner-form-header') }}
                                                                    </h5>
                                                                    <hr>
                                                                    <div class="form-group">
                                                                        <label for="order">{{ __('main.order') }}</label>
                                                                        <fieldset class="form-group">
                                                                            <select class="form-control" name="order"
                                                                                    id="order">
                                                                                <option  value="">{{ __('main.order_msg') }}</option>
                                                                                @foreach($orders as $order)
                                                                                    <option  value="{{$order->order}}" @if( $banner->order  == $order->order )selected @endif>
                                                                                        {{$order->order}}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </fieldset>
                                                                        @error('order')
                                                                        <small
                                                                            class="form-text text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="logo">{{ __('main.image') }}</label>
                                                                        <fieldset class="form-group">
                                                                            <div class="custom-file"  >
                                                                                <input type="file" class="custom-file-input"
                                                                                       banner_id ={{$banner->id}}
                                                                                       id="image_edit" name="image_edit" accept="image/gif, image/jpeg, image/png" >
                                                                                <label class="custom-file-label"
                                                                                       id="image_edit_name{{$banner->id}}"  for="inputGroupFile01">{{ __('main.choose-image') }}</label>
                                                                                @error('image_edit')
                                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                                @if(Session::has('uploaded2'))
                                                                                    <small class="form-text text-success"><strong>{{Session::get('uploaded2')}}</strong></small>
                                                                                @elseif(Session::has('not_uploaded2'))
                                                                                    <small class="form-text text-danger"><strong>{{Session::get('not_uploaded2')}}</strong></small>
                                                                                @endif
                                                                            </div>
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
    <script>
        $('input[name="image"]').change(function(e){
            var fileName = e.target.files[0].name;
            document.getElementById('image_name').innerHTML = fileName;
        });
    </script>
    <script>
        $(document).on('click','#image_edit',function (e){
            let id = $(this).attr('banner_id');
            $('input[name="image_edit"]').change(function(e){
                var fileName = e.target.files[0].name;
                let element = 'image_edit_name'+id;
                document.getElementById(element).innerHTML = fileName;
            });
        });
    </script>
    <script>
        function validateForm(){
            let image = document.forms['bannerForm']['image'].value;
            if(image == ""){
                document.getElementById('error_image').style.display = "inline";
                return false;
            }
        }
    </script>
    {{--    create--}}
    @if (Session::has('create_banner_msg'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('create_banner_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('create_banner_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    update--}}
    @if (Session::has('update_banner_msg'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('update_banner_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('update_banner_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    not found--}}
    @if (Session::has('not_found_msg_banner'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.error('{{ Session::get('not_found_msg_banner') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.error('{{ Session::get('not_found_msg_banner') }}', '{{ Session::get('error_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    delete--}}
    @if (Session::has('delete_banner_msg'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('delete_banner_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('delete_banner_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
@endsection

