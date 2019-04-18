@extends ('widgets.bookingtour.master')

@section ('change-header', 'changeHeader')

@section ('content')
    @include('widgets.bookingtour.slider')
    <section class="mainContentSection packagesSection popular-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="sectionTitle">
                        <h2><span class="lightBg">@lang('lang.popular_tour')</span></h2>
                        <p>@lang('lang.popular_text')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (count($data['popular_tour']))
                    @foreach ($data['popular_tour'] as $tour)
                        <div class="col-sm-4 col-xs-12">
                            <div class="thumbnail deals tour-show">
                                {{ Html::image($tour->picture_path, 'tour-image') }}
                                {{ Html::link(route('client.tour.show', $tour->id), '', ['class' => 'pageLink']) }}
                                <div class="discountInfo" value="{{ $tour->rate }}">
                                    <ul class="list-inline rating homePage rate-home">
                                        <li><i class="fa" aria-hidden="true"></i></li>
                                        <li><i class="fa" aria-hidden="true"></i></li>
                                        <li><i class="fa" aria-hidden="true"></i></li>
                                        <li><i class="fa" aria-hidden="true"></i></li>
                                        <li><i class="fa" aria-hidden="true"></i></li>
                                    </ul>
                                </div>
                                <div class="caption">
                                    <h4>{{ $tour->name }}</h4>
                                    <p>{{ str_limit($tour->description, 60) }}</p>
                                    <div class="detailsInfo">
                                        <h5>
                                            <span class="fa fa-calendar"> @lang('lang.from'): <strong>{{ $tour->time_start_format }}</strong></span>
                                            <span class="fa fa-calendar"> @lang('lang.to'): <strong>{{ $tour->time_finish_format }}</strong></span>
                                            <strong>${{ $tour->price }}</strong>
                                        </h5>
                                        <h5 style="float: right;">
                                            <span><i class="fa fa-clock-o"></i> Duration: {{ $tour->duration }}</span>
                                            <span><i class="fa fa-user"></i> Seat Availability: {{ $tour->seat_available }}</span>
                                        </h5>
                                        <ul class="list-inline detailsBtn">
                                            <li>
                                                {{ Html::link(route('client.tour.show', $tour->id), trans('lang.view'), ['class' => 'btn buttonTransparent']) }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="btnArea">
                        {{ Html::link(route('client.category.index'), trans('lang.view_all'), ['class' => 'btn buttonTransparent']) }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="promotionWrapper amazingHtoleSection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="sectionTitleHomeCity2">
                        <div class="sectionTitleDouble">
                            <p>@lang('lang.search')</p>
                            <h2>@lang('lang.your') <span>@lang('lang.tours')</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                    {{ Form::open(['route' => 'search', 'method' => 'GET']) }}
                        <div class="amazingSelectbox">
                            <div class="searchHotel">
                                <select name="category" id="guiest_id2" class="select-drop">
                                    <option value="0">@lang('lang.all')</option>
                                    @foreach ($data['categories'] as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="searchHotel">
                                <div class="input-group date ed-datepicker" data-provide="datepicker">
                                    {{ Form::text('check_in', '', ['class' => 'form-control', 'placeholder' => trans('lang.check_in')]) }}
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="searchHotel">
                                <div class="input-group date ed-datepicker" data-provide="datepicker">
                                    {{ Form::text('check_out', '', ['class' => 'form-control', 'placeholder' => trans('lang.check_out')]) }}
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="searchHotel">
                                {{ Form::select('price', ['0' => trans('lang.all'), '1' => '< $500', '2' => '$500 - $1000', '3' => '$1000 - $2000', '4' => '> $2000'], '', ['class' => 'select-drop form-control']) }}
                            </div>
                            <div class="searchHotelBtn">
                                {{ Form::button(trans('lang.search'), ['type' => 'submit', 'class' => 'btn buttonCustomPrimary']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>

    @if (isset($allTour))
        @foreach ($allTour as $category => $tours)
            <section class="mainContentSection packagesSection tour-package">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sectionTitle">
                                <h2><span class="lightBg">{{ $category }}</span></h2>
                                <p>@lang('lang.you_like') {{ $category }} @lang('lang.tour') ?</p>
                            </div>
                        </div>
                    </div>
                    @if (count($tours))
                        <div class="row">
                            @foreach ($tours as $tour)
                                <div class="col-sm-4 col-xs-12">
                                    <div class="thumbnail deals tour-show">
                                        {{ Html::image($tour->picture_path, 'tour-image') }}
                                        {{ Html::link(route('client.tour.show', $tour->id), '', ['class' => 'pageLink']) }}
                                        <div class="discountInfo"  value="{{ $tour->rate }}">
                                            <ul class="list-inline rating homePage rate-home">
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>

                                        <div class="caption">
                                            <h4>{{ $tour->name }}</h4>
                                            <p>{{ str_limit($tour->description, 60) }}</p>
                                            <div class="detailsInfo">
                                                <h5>
                                                    <span class="fa fa-calendar"> @lang('lang.from'): <strong>{{ $tour->time_start_format }}</strong></span>
                                                    <span class="fa fa-calendar"> @lang('lang.to'): <strong>{{ $tour->time_finish_format }}</strong></span>
                                                    <strong>${{ $tour->price }}</strong>
                                                </h5>
                                                <h5 style="float: right;">
                                                    <span><i class="fa fa-clock-o"></i> Duration: {{ $tour->duration }}</span>
                                                    <span><i class="fa fa-user"></i> Seat Availability: {{ $tour->seat_available }}</span>
                                                </h5>
                                                <ul class="list-inline detailsBtn">
                                                    <li>
                                                        {{ Html::link(route('client.tour.show', $tour->id), trans('lang.view'), ['class' => 'btn buttonTransparent']) }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btnArea">
                                    {{ Html::link(route('client.category.show', $tour->category->parentCategory->id), trans('lang.view_all'), ['class' => 'btn buttonTransparent']) }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endforeach
    @endif

    <section class="promotionWrapper amazingHtoleSection news-show">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="sectionTitleHomeCity2">
                        <div class="sectionTitleDouble">
                            <h2>@lang('lang.travel_tour') <span>@lang('lang.tips')</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-sm-offset-2 col-xs-12 row">
                <div class="benifitsContent col-sm-6 travel-tips">
                    <ul>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_1')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_2')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_3')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_4')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_5')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_6')</span></li>
                    </ul>
                </div>
                <div class="benifitsContent col-sm-6">
                    <ul>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_7')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_8')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_9')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_10')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_11')</span></li>
                        <li><i class="fa fa-check-square" aria-hidden="true"></i><span> @lang('lang.tip_12')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="mainContentSection packagesSection tour-package">
        <div class="container">
            <div class="row">
                @if (count($data['news']))
                    @foreach ($data['news'] as $news)
                        <div class="col-sm-4 col-xs-12">
                                <div class="thumbnail deals tour-show">
                                    {!! html_entity_decode(Html::link('', Html::image($news->picture_path, 'guide-image'))) !!}
                                </a>
                                <div class="caption">
                                    <h3>{{ Html::link('', str_limit($news->title, 20), ['class' => 'blogTitle']) }}</h3>
                                    <ul class="list-inline blogInfo">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>{{ $news->created_time }}</li>
                                        <li><i class="fa fa-tags" aria-hidden="true"></i>Travel</li>
                                    </ul>
                                    <p>{{ str_limit($news->content, 60) }}</p>
                                    {{ Html::link('', trans('lang.view'), ['class' => 'btn buttonTransparent']) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="btnArea">
                        {{ Html::link('', trans('lang.view_all'), ['class' => 'btn buttonTransparent']) }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
