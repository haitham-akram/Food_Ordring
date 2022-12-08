@extends('layouts.app')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.old_orders') }} {{__('main.for_restaurant')}}
                        @if (App::getLocale() == 'en')
                            {{$restaurant->name_en}}
                        @else
                            {{$restaurant->name_ar}}
                        @endif
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
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('restaurant.order.old',$restaurant->id) }}">{{ __('main.old_orders') }}</a>
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
                                        {{ __('main.old_orders') }}
                                    </h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                            <div class="table-responsive">
                                                <table id="" class="table table-white-space table-bordered row-grouping display no-wrap  table-middle">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">{{ __('main.id') }}</th>
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
                                                    @if($restaurant->count == 0)
                                                        <tr>
                                                            <td class = "text-center" colspan = "9" ><h4>{{ __('main.no_data') }}</h4></td>
                                                        </tr>
                                                    @else
                                                        @foreach($orders as $order)
                                                                <tr class="selected_row{{$order->id}}">
                                                                    <td class="text-center" id="order_id">{{$order->id}}</td>
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
                                                                        {{$order->address}}, ({{$order->latitude}},{{$order->longitude}})
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
                                                                </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
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

                                                        <table id="" class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th class="col-2">{{ __('main.meal_name') }}</th>
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
                    // $('#onshown').on('shown.bs.modal', function() {
                    //     alert('onShown event fired.');
                    // });
                },
                error:function(reject){

                }
            });
        });
    </script>

@endsection



