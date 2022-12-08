@extends('layouts.app')
{{--@section('refresh')--}}
{{--<div id="active">--}}
{{--    <meta http-equiv="refresh" content="180;url=" {{ route('restaurant.order') }}" />--}}
{{--</div>--}}
{{--    refresh every 3 min--}}
{{--@endsection--}}
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.order-list') }}
                    </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ __('main.home') }}</a>
                                </li>

                                <li class="breadcrumb-item active"><a
                                        href="{{ route('restaurant.order') }}">{{ __('main.order-list') }}</a>
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
                                    <h3 class="form-section"><i class="la la-shopping-cart font-large-1"></i>
                                        {{ __('main.order-list') }}
                                    </h3>
                                </div>
                                <div class="card-header form-group" >
                                    <fieldset>
                                        <div class="float-left">
                                            <label for="show_distance" class="pr-1"><strong>{{ __('main.order_refresh') }}</strong></label>
                                            <input onchange="handleChangeFlage(this)" type="checkbox" id="refresh" class="switchery" data-size="sm" checked/>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-underline no-hover-bg nav-justified">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="active-tab32" data-toggle="tab" href="#Received" aria-controls="active32"
                                               aria-expanded="true">{{__('main.received')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="link-tab32" data-toggle="tab" href="#Preparing" aria-controls="link32"
                                               aria-expanded="false">{{__('main.preparing')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="linkOpt-tab2" data-toggle="tab" href="#On_the_way" aria-controls="linkOpt2">{{__('main.on_the_way')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="linkOpt-tab2" data-toggle="tab" href="#Delivered" aria-controls="linkOpt2">{{__('main.old_orders')}}</a>
                                        </li>
                                    </ul>
                                    {{--tabs content --}}
                                    <div class="tab-content px-1 pt-1">

                                        <div role="tabpanel" class="tab-pane active" id="Received" aria-labelledby="Received" aria-expanded="true">
                                            <div class="table-responsive">
                                                <table id="" class="table table-white-space table-bordered row-grouping display no-wrap  table-middle">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">{{ __('main.order_number') }}</th>
                                                        <th class="text-center">{{ __('main.customer_name') }}</th>
                                                        <th class="text-center">{{ __('main.email') }}</th>
                                                        <th class="text-center">{{ __('main.phone') }}</th>
                                                        <th class="text-center">{{ __('main.address') }}</th>
                                                        <th class="text-center">{{ __('main.order_time') }}</th>
                                                        <th class="text-center">{{ __('main.price') }}</th>
                                                        <th class="text-center">{{ __('main.order_details') }}</th>
                                                        <th class="text-center">{{ __('main.actions') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($status->count == 0)
                                                        <tr>
                                                            <td class = "text-center" colspan = "9" ><h4>{{ __('main.no_data') }}</h4></td>
                                                        </tr>
                                                    @else
                                                        @foreach($orders as $order)
                                                            @if($order->status == 1)
                                                                <tr class="selected_row{{$order->id}}">
                                                                    <td class="text-center">{{$order->order_number}}</td>
                                                                    <td class="text-center">
                                                                        {{$order->username}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->email}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->country_code}}-{{$order->phone_number}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank">
                                                                            <button type="button" class="btn btn-warning btn-sm">
                                                                                <i class="white"></i>
                                                                                {{ __('main.address') }}</button>
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->created_at}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->total_price}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                            <button type="submit" class="show_order btn btn-warning btn-sm"
                                                                                    order_id="{{$order->id}}"
                                                                            ><i class="white"></i>
                                                                                {{ __('main.order_details') }}</button>
                                                                    </td>
                                                                    <td class="text-center">
                                                            <span class="dropdown">
                                                            <button id="SearchDrop2" type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="true"
                                                                    class="btn btn-warning dropdown-toggle dropdown-menu-right"><i
                                                                    class="ft-settings"></i></button>
                                                                <span aria-labelledby="SearchDrop2"
                                                                      class="dropdown-menu mt-1 dropdown-menu-left">
                                                                    <a class="dropdown-item primary"
                                                                       onclick="event.preventDefault();
                                                                        document.getElementById('Prepare-order-form-{{$order->id}}').submit();">
                                                                        <i class="ft-plus primary"></i>
                                                                        {{ __('main.prepare_order') }}</a>
                                                                    <a class="dropdown-item primary"
                                                                       onclick="event.preventDefault();
                                                                        document.getElementById('On_Way_order-form-{{$order->id}}').submit();">
                                                                        <i class="ft-plus primary"></i>
                                                                        {{ __('main.on_Way_order') }}</a>

                                                                </span>
                                                            </span>
                                                            <form id="Prepare-order-form-{{$order->id}}" action="{{ route('prepare_order',$order->id)}}" method="POST" class="d-none">@csrf</form>
                                                            <form id="On_Way_order-form-{{$order->id}}" action="{{ route('on_way_order',$order->id)}}" method="POST" class="d-none">@csrf</form>

                                                                    </td>
                                                                </tr>
                                                            @endif

                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="Preparing" role="tabpanel" aria-labelledby="Preparing" aria-expanded="false">
                                            <div class="table-responsive">
                                                <table id="" class="table table-white-space table-bordered row-grouping display no-wrap table-middle">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">{{ __('main.order_number') }}</th>
                                                        <th class="text-center">{{ __('main.customer_name') }}</th>
                                                        <th class="text-center">{{ __('main.email') }}</th>
                                                        <th class="text-center">{{ __('main.phone') }}</th>
                                                        <th class="text-center">{{ __('main.address') }}</th>
                                                        <th class="text-center">{{ __('main.order_time') }}</th>
                                                        <th class="text-center">{{ __('main.price') }}</th>
                                                        <th class="text-center">{{ __('main.order_details') }}</th>
                                                        <th class="text-center">{{ __('main.actions') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($status->count_preparing == 0)
                                                        <tr>
                                                            <td class = "text-center" colspan = "9" ><h4>{{ __('main.no_data') }}</h4></td>
                                                        </tr>
                                                    @else
                                                        @foreach($orders as $order)
                                                            @if($order->status == 2)
                                                                <tr>
                                                                    <td class="text-center">
                                                                        {{$order->order_number}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->username}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->email}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->country_code}}-{{$order->phone_number}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank">
                                                                            <button type="button" class="btn btn-warning btn-sm">
                                                                                <i class="white"></i>
                                                                                {{ __('main.address') }}</button>
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->created_at}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->total_price}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <button type="submit" class="show_order btn btn-warning btn-sm"
                                                                                order_id="{{$order->id}}"
                                                                        ><i class="white"></i>
                                                                            {{ __('main.order_details') }}</button>
                                                                    </td>
                                                                    <td class="text-center">
                                                            <span class="dropdown">
                                                            <button id="SearchDrop2" type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="true"
                                                                    class="btn btn-warning dropdown-toggle  dropdown-menu-right "><i
                                                                    class="ft-settings"></i></button>
                                                                <span aria-labelledby="SearchDrop2"
                                                                      class="dropdown-menu mt-1 dropdown-menu-left">
                                                                    <a class="dropdown-item primary"
                                                                       onclick="event.preventDefault();
                                                                        document.getElementById('On_Way_order-form-{{$order->id}}').submit();">
                                                                        <i class="ft-plus primary"></i>
                                                                        {{ __('main.on_Way_order') }}</a>

                                                                </span>
                                                            </span>
                                                            <form id="On_Way_order-form-{{$order->id}}" action="{{ route('on_way_order',$order->id)}}" method="POST" class="d-none">@csrf</form>
                                                                    </td>

                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="On_the_way" role="tabpanel" aria-labelledby="On_the_way" aria-expanded="false">
                                            <div class="table-responsive">
                                                <table id="" class="table table-white-space table-bordered row-grouping display no-wrap  table-middle">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">{{ __('main.order_number') }}</th>
                                                        <th class="text-center">{{ __('main.customer_name') }}</th>
                                                        <th class="text-center">{{ __('main.email') }}</th>
                                                        <th class="text-center">{{ __('main.phone') }}</th>
                                                        <th class="text-center">{{ __('main.address') }}</th>
                                                        <th class="text-center">{{ __('main.order_time') }}</th>
                                                        <th class="text-center">{{ __('main.price') }}</th>
                                                        <th class="text-center">{{ __('main.order_details') }}</th>
                                                        <th class="text-center">{{ __('main.actions') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($status->count_on_way == 0)
                                                        <tr>
                                                            <td class = "text-center" colspan = "9" ><h4>{{ __('main.no_data') }}</h4></td>
                                                        </tr>
                                                    @else
                                                        @foreach($orders as $order)
                                                            @if($order->status == 3)
                                                                <tr>
                                                                    <td class="text-center">
                                                                        {{$order->order_number}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->username}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->email}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->country_code}}-{{$order->phone_number}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank">
                                                                            <button type="button" class="btn btn-warning btn-sm">
                                                                                <i class="white"></i>
                                                                                {{ __('main.address') }}</button>
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->created_at}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->total_price}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <button type="submit" class="show_order btn btn-warning btn-sm"
                                                                                order_id="{{$order->id}}"
                                                                        ><i class="white"></i>
                                                                            {{ __('main.order_details') }}</button>
                                                                    </td>
                                                                    <td class="text-center">
                                                            <span class="dropdown">
                                                            <button id="SearchDrop2" type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="true"
                                                                    class="btn btn-warning dropdown-toggle  dropdown-menu-right "><i
                                                                    class="ft-settings"></i></button>
                                                                <span aria-labelledby="SearchDrop2"
                                                                      class="dropdown-menu mt-1 dropdown-menu-left">
                                                                    <a class="dropdown-item primary"
                                                                       onclick="event.preventDefault();
                                                                        document.getElementById('delivered_order-form-{{$order->id}}').submit();">
                                                                        <i class="ft-plus primary"></i>
                                                                        {{ __('main.delivered_order') }}</a>
                                                                </span>
                                                            </span>
                                                                <form id="delivered_order-form-{{$order->id}}" action="{{ route('delivered_order',$order->id)}}" method="POST" class="d-none">@csrf</form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="Delivered" role="tabpanel" aria-labelledby="On_the_way" aria-expanded="false">
                                            <div class="table-responsive">
                                                <table id="" class="table table-white-space table-bordered row-grouping display no-wrap  table-middle">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">{{ __('main.order_number') }}</th>
                                                        <th class="text-center">{{ __('main.customer_name') }}</th>
                                                        <th class="text-center">{{ __('main.email') }}</th>
                                                        <th class="text-center">{{ __('main.phone') }}</th>
                                                        <th class="text-center">{{ __('main.address') }}</th>
                                                        <th class="text-center">{{ __('main.order_time') }}</th>
                                                        <th class="text-center">{{ __('main.price') }}</th>
                                                        <th class="text-center">{{ __('main.order_details') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($status->count_delivered == 0)
                                                        <tr>
                                                            <td class = "text-center" colspan = "8" ><h4>{{ __('main.no_data') }}</h4></td>
                                                        </tr>
                                                    @else
                                                        @foreach($old_orders as $order)

                                                                <tr>
                                                                    <td class="text-center">
                                                                        {{$order->order_number}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->username}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->email}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->country_code}}-{{$order->phone_number}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank">
                                                                            <button type="button" class="btn btn-warning btn-sm">
                                                                                <i class="white"></i>
                                                                                {{ __('main.address') }}</button>
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->updated_at}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{$order->total_price}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <button type="submit" class="show_order btn btn-warning btn-sm"
                                                                                order_id="{{$order->id}}"
                                                                        ><i class="white"></i>
                                                                            {{ __('main.order_details') }}</button>
                                                                    </td>
                                                                </tr>

                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- start of detail modal --}}
                                        <div class="modal fade text-left" id="details_modal" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel12" aria-hidden="true" data-backdrop="false"
                                             outsidedata-backdrop="false">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning white">
                                                        <h4 class="modal-title white" id="myModalLabel12">
                                                            {{ __('main.order_details') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5><i class="la la-arrow-right"></i>
                                                            {{ __('main.order_detail_header') }}</h5>
                                                        <hr>
                                                        <div class="table-responsive">
                                                        <table id="" class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th class="col-2">{{ __('main.meal_name') }}</th>
                                                                <th class="col-2">{{ __('main.Restaurant_name') }}</th>
                                                                <th class="col-2">{{ __('main.meal_description')}}</th>
                                                                <th class="col-2">{{ __('main.meal_price') }}</th>
                                                                <th class="col-2">{{ __('main.quantity') }}</th>
                                                                <th class="col-2">{{ __('main.Adds-on') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="order_details_content">

                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn grey btn-outline-secondary"
                                                                data-dismiss="modal">{{ __('main.close') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end of detail modal --}}
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
    {{-- get detials--}}
    <script>
        $(document).on('click','.show_order',function (e){
            e.preventDefault();
             let order_id = $(this).attr('order_id');

            $.ajax({
                type:'post',
                url:"{{Route('order.show')}}",
                enctype:'multipart/form-data',
                data:{'_token':"{{csrf_token()}}",
                    'id':order_id,
                },
                success: function (data){
                    $("#order_details_content").html(data.html);
                    $("#details_modal").modal('show');
                },
                error:function(reject){

                }
            });
        });
    </script>
    {{--    prepared --}}
    @if (Session::has('prepare_msg'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('prepare_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('prepare_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    on_way--}}
    @if (Session::has('on_way_msg'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('on_way_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('on_way_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    {{--    delivered_msg --}}
    @if (Session::has('delivered_msg'))
        @if (App::getLocale() == 'ar')
            <script>
                toastr.success('{{ Session::get('delivered_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000,
                    positionClass: 'toast-top-left',
                    containerId: 'toast-top-left'
                });
            </script>
        @else
            <script>
                toastr.success('{{ Session::get('delivered_msg') }}', '{{ Session::get('success_title') }}', {
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    timeOut: 3000
                });
            </script>
        @endif
    @endif
    <script>
        let flage = true;
        function handleChangeFlage(element){
            flage = element.checked;
            console.log(flage)
        }
        setInterval(refresh,3*60*1000);
        function refresh(){
            if(flage ){
                window.location.reload()
            }
        }

    </script>
@endsection



