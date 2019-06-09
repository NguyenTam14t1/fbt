@extends('widgets.bookingtour.master')

@section ('change-header', 'changeHeader')

@section('content')
    <!-- PAGE TITLE -->
    <section class="pageTitle page-title-2">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="titleTable">
                        <div class="titleTableInner">
                            <div class="pageTitleInfo">
                                <h1>{{ $data['title'] }}</h1>
                                <div class="under-border"></div>
                            </div>
                            <ol class="page-title-content">
                                <li>
                                   {{ Html::link(route('home'), trans('lang.home')) }}
                                </li>
                                <i class="fa fa-caret-right"></i>
                                <li>
                                    {{ $data['title'] }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEARCH TOUR -->
    <section class="darkSection">
        <div class="container">
            <div class="row gridResize">
                {{ Form::open(['route' => 'search', 'method' => 'GET']) }}
                    <div class="col-sm-10 col-xs-12">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12">
                                <div class="input-group key-search"
                                    style="border-bottom: 1px solid #656565;
                                    margin-top: 3px;
                                    width: 220px;
                                    margin-right: 10px;">
                                    <input type="text" name="key_search"
                                            class="form-control"
                                            style="color: #fff; margin-left: 20px;"
                                            value="{{ $data['key_search'] ?? '' }}"
                                            placeholder="NHẬP VÀO TỪ KHÓA">
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="searchTour">
                                    <select name="category" class="select-drop">
                                        <option value="0">@lang('lang.all')</option>
                                        @foreach ($data['categories'] as $category)
                                            <option value="{{ $category->id }}" {{ (isset($data['category']) && $data['category'] == $category->id) ? 'selected' : '' }}>{{ str_limit($category->name, 10) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-12">
                                <div class="input-group date ed-datepicker" data-provide="datepicker">
                                    <input type="text" name="check_in"
                                        value="{{ $data['check_in'] ?? '' }}"
                                        class="form-control" placeholder="@lang('lang.check_in')"
                                        style="color: #fff; margin-left: 20px;">
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-12">
                                <div class="input-group date ed-datepicker" data-provide="datepicker">
                                    <input type="text" name="check_out"
                                        value="{{ $data['check_out'] ?? '' }}"
                                        class="form-control" placeholder="@lang('lang.check_out')"
                                        style="color: #fff; margin-left: 20px;">
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-12">
                                <div class="searchTour">
                                    {{ Form::select('price', ['0' => trans('lang.all'), '1' => '< $500', '2' => '$500 - $1000', '3' => '$1000 - $2000', '4' => '> $2000'], '', ['class' => 'select-drop form-control']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-12">
                        {{ Form::button(trans('lang.search'), ['type' => 'submit', 'class' => 'btn btn-block buttonCustomPrimary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    <section class="mainContentSection packagesSection">
        <div class="container">
            <div class="row">
                @if(count($data['tours']))
                    @foreach ($data['tours'] as $tour)
                        <div class="col-xs-12">
                            <div class="media packagesList">
                                {!! html_entity_decode(Html::link(route('client.tour.show', $tour->id), Html::image($tour->picture_path, 'tour-img', ['class' => 'media-object']), ['class' => 'media-left fancybox-pop'])) !!}
                                <div class="media-body">
                                    <div class="bodyLeft">
                                        <h4 class="media-heading">
                                            {{ Html::link(route('client.tour.show', $tour->id), $tour->name) }}
                                        </h4>
                                        <div class="discountInfo countryRating" value="{{ $tour->rate }}">
                                            @if (isset($tour->category))
                                                {!! html_entity_decode(Html::link(route('client.category.show', $tour->category->id), '<span>' . $tour->category->name . '</span>')) !!}
                                            @endif
                                            <ul class="list-inline rating rate-home">
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                        <p>{{ str_limit($tour->description, 150) }}</p>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <span><i class="fa fa-clock-o"></i> Số ngày: {{ $tour->duration }}</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <span><i class="fa fa-user"></i> Số chỗ còn nhận: {{ $tour->seat_available }}</span>
                                            </div>
                                        </div>
                                        <ul class="list-inline detailsBtn">
                                            <li><span class="textInfo"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang.from'): {{ $tour->time_start_format }}</span></li>
                                            <li><span class="textInfo"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang.to'): {{ $tour->time_finish_format }}</span></li>
                                        </ul>
                                    </div>
                                    <div class="bodyRight">
                                        <div class="bookingDetails">
                                            <h2 class="tour-list-header">${{ $tour->price }}</h2>
                                            {{ Html::link(route('client.tour.show', $tour->id), trans('lang.view'), ['class' => 'btn buttonTransparent clearfix']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="paginationCenter">
                        {{ $data['tours']->links() }}
                    </div>
                @else
                    <h1 class="no_result">@lang('lang.no_result_search')</h1>
                @endif
            </div>
        </div>
    </section>
@endsection
