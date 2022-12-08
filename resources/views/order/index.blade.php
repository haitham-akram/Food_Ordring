@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.order-list') }}</h3>
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
                                    <h3 class="form-section"><i class="la la-building font-large-1"></i>
                                        {{ __('main.All-restaurant-with-orders') }}
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
                                                <th class = "text-center">{{ __('main.Restaurant_name') }}</th>
                                                <th class = "text-center">{{ __('main.New_orders') }}</th>
                                                <th class = "text-center">{{ __('main.old_orders') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="table_body">
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
    <script>
        get();
        setInterval(get, 180000); //180000 MS == 3 minutes to refresh the table every 3 minutes
        function get() {

            $.get('{{ route('restaurant.order.get') }}',
                function(data) {
                     table_post_row(data);
                });
        }

        // table row with ajax
        function table_post_row(res) {
            let htmlView = '';
            if (res.restaurants.length <= 0) {
                htmlView += `<tr>
                <td class = "text-center" colspan = "4" ><h4>{{ __('main.no_data') }}</h4></td>
                    </tr>`;
            }
            let name = '';
            for (let i = 0; i < res.restaurants.length; i++) {
            let id = res.restaurants[i].id;
            let currentURL = "{{ route('restaurant.order.current', ':id') }}";
                currentURL =  currentURL.replace(':id', id);
            let oldURL = "{{ route('restaurant.order.old', ':id') }}";
                oldURL = oldURL.replace(':id', id);
            let lang = "{{App::getLocale()}}";
                if(lang === 'en'){
                    name = res.restaurants[i].name_en;
                }else {
                    name = res.restaurants[i].name_ar;
                }
                htmlView += `<tr>
                    <td class = "text-center"> ` + res.restaurants[i].id + ` </td>
                    <td class = "text-center"> ` + name + ` </td>
                    <td class = "text-center"> <a href=" `+ currentURL+`">
                     <button type="button" class="btn btn-warning btn-sm" ><i class="white"></i>
                      {{ __('main.New_orders') }} (` +res.restaurants[i].current_order_count + `)</button></a>
                    </td>
                    <td class = "text-center"> <a href=" ` + oldURL+ `">
                     <button type="button" class="btn btn-warning btn-sm" ><i class="white"></i>
                      {{ __('main.old_orders') }} (` +res.restaurants[i].previous_order_count + `)</button></a>
                    </td>
                    </tr>`;
            }
            $('#table_body').html(htmlView);
        }
    </script>

@endsection

