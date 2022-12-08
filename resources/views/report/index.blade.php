@extends('layouts.mainLayout')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('main.reports-list') }} {{__('main.for_restaurant')}}
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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('restaurant.list') }}">{{ __('main.Restaurant-list') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('report.index',$restaurant->id) }}">{{ __('main.reports-list') }}</a>
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
                    <div class="card" style="pointer-events: none;background-color: #d1d7e0;
                         opacity: .75;">
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
                </div>
            </div>
            <!--/upper nav -->
            <div class="content-body">
            {{-- search by date 'month'--}}
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-header">
                                    <h3 class="form-section"><i class="la la-search font-large-1"></i>
                                        {{ __('main.search-by-date') }}
                                    </h3>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <!-- start form   -->
                                    <form class="form" id="search_form">
{{--                                        method="post"  action="{{ route('report.show',$restaurant->id) }}" enctype="multipart/form-data"--}}
                                        @csrf
                                        <div class="form-body">
                                            <div class="row pl-1 pr-1">
                                                <div class="col-md-6">
                                                    {{--  Start date Field --}}
                                                    <div class="form-group">
                                                        <label for="start_date">{{ __('main.start-date') }}</label>
                                                        <input type="month" id="start_date" class="form-control"
                                                               value="{{$current_date}}"
                                                               name="start_date">
                                                        @error('start_date')
                                                        <small
                                                            class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    {{--  End date Field --}}
                                                    <div class="form-group">
                                                        <label for="end_date">{{ __('main.end-date') }}</label>
                                                        <input type="month" id="end_date" class="form-control"
                                                               value="{{$next_date}}"
                                                               name="end_date">
                                                        @error('end_date')
                                                        <small
                                                            class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-warning">
                                                {{ __('main.search') }}
                                            </button>
                                        </div>
                                    </form>

                                    {{-- end of the form--}}
                                </div>
                                {{-- end of the card body --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-header">
                                    <h3 class="form-section"><i class="la la-folder-open font-large-1"></i>
                                        {{ __('main.reports') }}
                                    </h3>
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
                                                <th class="text-center">{{ __('main.date') }}</th>
                                                <th class="text-center">{{ __('main.total_price') }}</th>
                                                <th class="text-center">{{ __('main.total_orders') }}</th>
                                                <th class="text-center">{{ __('main.total_delivery') }}</th>
                                                <th class="text-center">{{ __('main.order_count') }}</th>
                                                <th class="text-center">{{ __('main.order_meal_count') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="table_body">

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
    <script type="text/javascript">

        $('#search_form').on('submit',function(e){
            e.preventDefault();
            search();
        });
        search();

        function search() {
            let start_date =$('#start_date').val();
            let end_date =$('#end_date').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: "{{ route('report.show',$restaurant->id) }}",
                data:{
                    start_date:start_date,
                    end_date:end_date,
                },
                success: function(data) {
                    $('#table_body').html(data.html);
                }
            });
        }
    </script>
@endsection
