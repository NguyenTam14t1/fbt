@extends('widgets.bookingtour.master')

@section('change-header', 'changeHeader1')
@section('header-type', 'lightHeader lightHeader1')

@section('content')
    <!-- PAGE TITLE -->
    <section class="pageTitle page-title-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="titleTable">
                        <div class="titleTableInner">
                            <div class="pageTitleInfo">
                                <h1>{{ $data['tour']->name }}</h1>
                                <div class="under-border"></div>
                            </div>
                            <ol class="page-title-content">
                                <li>
                                   {{ Html::link(route('home'), trans('lang.home')) }}
                                </li>
                                @foreach ($data['categories'] as $category)
                                    <i class="fa fa-caret-right"></i>
                                    <li>
                                        {{ Html::link(route('client.category.show', $category->id), $category->name) }}
                                    </li>
                                @endforeach
                                <i class="fa fa-caret-right"></i>
                                <li>
                                    {{ $data['tour']->name }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE CONTENT -->
    <section class="mainContentSection singlePackage" style="padding: 30px 0px">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" style="margin-bottom: 30px">
                    <div style="font-weight: bold;font-size:18px;line-height: 22px;padding: 15px 80px 15px 15px;background:#f5f4ef;" class="tentour">
                        <h4 itemprop="name">{{ $data['tour']->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-8 col-xs-12">
                    <div id="package-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#package-carousel" data-slide-to="0" class=""></li>
                            <li data-target="#package-carousel" data-slide-to="1" class=""></li>
                            <li data-target="#package-carousel" data-slide-to="2" class="active"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                {{ Html::image($data['tour']->picture_path , 'First slide') }}
                            </div>
                            <div class="item ">
                                {{ Html::image($data['tour']->picture_path , 'Second slide') }}
                            </div>
                            <div class="item ">
                                {{ Html::image($data['tour']->picture_path , 'Third slide') }}
                            </div>
                        </div>
                        {!! html_entity_decode(Html::link('#package-carousel', '<span class="glyphicon glyphicon-menu-left"></span>', ['class' => 'left carousel-control' ,'data-slide' => 'prev'])) !!}
                        {!! html_entity_decode(Html::link('#package-carousel', '<span class="glyphicon glyphicon-menu-right"></span>', ['class' => 'right carousel-control' ,'data-slide' => 'next'])) !!}
                    </div>
                    <div class="row form-group rate-group">
                        <div class="col-md-4 rate-show-form col-xs-12 row form-group" >
                            <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.places'):</span>
                            <div class="col-md-9 col-xs-12 rating-show" value="{{ $data['place_rate'] }}" id="place-rate-info">
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                            </div>

                        </div>
                        <div class="col-md-4 rate-show-form col-xs-12 row form-group">
                            <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.foods'):</span>
                            <div class="col-md-9 col-xs-12 rating-show" value="{{ $data['food_rate'] }}" id="food-rate-info">
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                            </div>
                        </div>
                        <div class="col-md-4 rate-show-form col-xs-12 row form-group">
                            <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.services'):</span>
                            <div class="col-md-9 col-xs-12 rating-show" value="{{ $data['service_rate'] }}" id="service-rate-info">
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                                <label class="star-show"></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 row form-group total-rate" >
                            <span class="col-md-4 col-xs-12 rate-big-title">@lang('lang.rate'): <strong id="total-show">{{ $data['total_rate'] }}</strong>/<strong>5</strong></span>
                            <div class="col-md-5 col-xs-12 rating-show" value="{{ $data['total_rate'] }}" id="total-rate-info">
                                <label class="star-show star-big-show "></label>
                                <label class="star-show star-big-show "></label>
                                <label class="star-show star-big-show "></label>
                                <label class="star-show star-big-show "></label>
                                <label class="star-show star-big-show "></label>
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="col-sm-4 col-xs-12">
                    <div class="singleCartSidebar">
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('lang.booking')</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        {{ Form::open(['class' => 'form-horizontal']) }}
                                            <div class="form-group">
                                                <label class="control-label col-md-5 col-sm-12 col-xs-5" for="inputSuccess3">@lang('lang.date_start'):</label>
                                                <div class="col-md-7 col-sm-12 col-xs-7 datepickerWrap">
                                                    <div class="input-group date" id="date_start" readonly>
                                                        {{ Form::text('date_start', $data['tour']->time_start_format, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                                        <div class="input-group-addon">
                                                            <span class="fa fa-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-5 col-sm-12 col-xs-5" for="inputSuccess3">@lang('lang.date_finish'):</label>
                                                <div class="col-md-7 col-sm-12 col-xs-7 datepickerWrap">
                                                    <div class="input-group date filterDate" id="date_finish" readonly>
                                                        {{ Form::text('date_finish', $data['tour']->time_finish_format, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                                        <div class="input-group-addon">
                                                            <span class="fa fa-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-5 col-sm-12 col-xs-5" for="inputSuccess3">Số chỗ còn nhận: </label>
                                                <div class="col-md-7 col-sm-12 col-xs-7">
                                                    <div class="input-group">
                                                        {{ Form::text('participants_max', $data['tour']->seat_available, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'participants_max']) }}
                                                        <div class="input-group-addon">
                                                            <span class="fa fa-child"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-5 col-sm-12 col-xs-5" for="inputSuccess3">@lang('lang.adults'):</label>
                                                <div class="col-md-5 col-sm-12 col-xs-7 datepickerWrap">
                                                    <div class="count-input">
                                                        {{ Form::text('quantity_adults', $data['booking']->number_of_people, ['class' => 'quantity adult', 'readonly' => 'readlonly']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-5 col-sm-12 col-xs-5" for="inputSuccess3">@lang('lang.children'):</label>
                                                <div class="col-md-5 col-sm-12 col-xs-7 datepickerWrap">
                                                    <div class="count-input">
                                                        {{ Form::text('quantity_children', $data['booking']->number_of_children, ['class' => 'quantity child', 'readonly' => 'readlonly']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-xs-8 totalCostLeft">
                                                        <p>@lang('lang.total_cost'):</p>
                                                    </div>
                                                    <div name="price" class="col-xs-4 totalCostRight" value="{{ $data['tour']->price }}">${{ $data['booking']->debt }}</div>
                                                </div>

                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="description-aria">
                <div class="sectionTitle2">
                    <h2>@lang('lang.description')</h2>
                    <p>{!! $data['tour']->description !!}</p>
                </div>
                <div class="row">
                    @if (isset($data['tour']->activityDates))
                        @foreach ($data['tour']->activityDates as $activityDate)
                            <div class="col-xs-12 col-sm-12">
                                <ul class="descriptionList">
                                    <li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{ $activityDate->title }}</li>
                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="information-aria">
            <h3 class="program-title">@lang('lang.program_overview')</h3>
            <section id="special-offers" class="section wide-fat">
                <div id="mi-slider" class="mi-slider">
                    @if (isset($data['tour']->activityDates))
                        @foreach ($data['tour']->activityDates as $activity)
                            <ul>
                                <li>
                                    <a href="#">
                                        {{ Html::image($activity->picture_path, 'Date Program') }}
                                        <div class="container">
                                            <article class="special-offers section-intro">
                                                <h2 class="page-title date-content">{{ $activity->title }}</h2>
                                            </article>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        @endforeach
                        <nav id="mi-nav">
                            @foreach ($data['tour']->activityDates as $activity)
                                {!! html_entity_decode(Html::link('#', '<span>' . $activity->time . '</span>')) !!}
                            @endforeach
                        </nav>
                    @endif
                </div>
                <div class="clearfix"></div>
            </section>
        </div>
        <div class="container">
            <div class="sectionTitle2">
                <h2>@lang('lang.program_detail')</h2>
            </div>
            <section class="design-process-section" id="process-tab">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            @if (isset($data['tour']->activityDates))
                                <ul class="nav nav-tabs process-model more-icon-preocess" role="tablist">
                                    @foreach ($data['tour']->activityDates as $activity)
                                        <li role="presentation" id="{{ ($loop->iteration == 1) ? 'day-icon-1' : '' }}">
                                            {!! html_entity_decode(Html::link('#day-' . $loop->iteration, '<i class="fa fa-binoculars" aria-hidden="true"></i><p>' . $activity->time . '</p>', ['aria-controls' => 'day-' . $loop->iteration, 'role' => 'tab', 'data-toggle' => 'tab'])) !!}
                                        </li>
                                    @endforeach
                                </ul>
                                @foreach ($data['tour']->activityDates as $activity)
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane " id="day-{{ $loop->iteration }}">
                                            <div class="design-process-content">
                                                <h3 class="program-header">{{ $activity->time . ': ' . $activity->title }}</h3>
                                                <div class="description-aria">
                                                    <p>{{ $activity->detail }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="container">
            <div class="sectionTitle2">
            </div>
            <div class="main-contain">
                <p style="text-transform: uppercase; color: #333; font-weight: bold; font-size: 15px; margin-bottom: 15px; margin-top: 10px"><i class="fa fa-building" aria-hidden="true"></i>&nbsp;&nbsp;Khách sạn</p>
                <section class="design-process-section" id="list-hotel">
                    <table class="table table-bordered" id="table-hotel">
                        @if (isset($data['tour']->hotels))
                            <thead>
                                <tr style="font-weight: bold; font-size: 16px;">
                                    <td style="width:300px; padding-left: 20px" >Tên</td>
                                    <td colspan="2" style="width:200px; padding-left: 20px">Địa chỉ</td>
                                    <td style="width:150px; padding-left: 20px">Số điện thoại</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['tour']->hotels as $hotel)
                                    <tr>
                                      <td class="name-hotel" data-name-hotel="{{ $hotel->name }}" scope="row" style="padding-left: 20px">{{ $hotel->name }}</td>
                                      <td class="address-hotel" data-address-hotel="{{ $hotel->address }}" colspan="2" style="padding-left: 20px">{{ $hotel->address }}</td>
                                      <td class="phone-hotel" data-phone-hotel="{{ $hotel->phone }}" style="padding-left: 20px">{{ $hotel->phone }}</td>
                                      <td class="latitude-hotel" data-latitude-hotel="{{ $hotel->latitude }}" class="hide"></td>
                                      <td class="longitude-hotel" data-longitude-hotel="{{ $hotel->longitude }}" class="hide"></td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="padding-left: 20px">  Đang cập nhập  </td>
                                </tr>
                                @endforelse
                            </tbody>
                        @else
                            <tbody>
                                <tr>
                                    <td colspan="4" style="padding-left: 20px">  Đang cập nhập  </td>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                </section>
            </div>

            <div class="main-contain">
                <p style="text-transform: uppercase; color: #333; font-weight: bold; font-size: 15px; margin-bottom: 15px; margin-top: 10px"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Hướng dẫn viên</p>
                <section class="design-process-section" id="list-hotel">
                    <table class="table table-bordered table-hotel">
                        @if (isset($data['tour']->guides))
                            <thead>
                                <tr style="font-weight: bold; font-size: 16px;">
                                    <td style="width:300px; padding-left: 20px" >Tên</td>
                                    <td colspan="2" style="width:200px; padding-left: 20px">Địa chỉ</td>
                                    <td style="width:150px; padding-left: 20px">Số điện thoại</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['tour']->guides as $guide)
                                    <tr>
                                      <td class="name-guide" data-name-guide="{{ $guide->name }}" scope="row" style="padding-left: 20px">{{ $guide->name }}</td>
                                      <td class="address-guide" data-address-guide="{{ $guide->address }}" colspan="2" style="padding-left: 20px">{{ $guide->address }}</td>
                                      <td class="phone-guide" data-phone-guide="{{ $guide->phone }}" style="padding-left: 20px">{{ $guide->phone }}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="padding-left: 20px">  Đang cập nhập  </td>
                                </tr>
                                @endforelse
                            </tbody>
                        @else
                            <tbody>
                                <tr>
                                    <td colspan="4" style="padding-left: 20px">  Đang cập nhập  </td>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                </section>
            </div>
        </div>
        <div class="container">
            <div class="review-aria">
                @if (isset($data['note']->content))
                    <div class="sectionTitle2">
                        <h2>Notes</h2>
                        <div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="tab-content">
                                        <div class="design-process-content" style="border:1px solid #ccc;padding: 20px 30px 20px 30px;text-align: justify;word-wrap: break-word;height: 300px;overflow-y: scroll;line-height: 22px">
                                            <div class="description-aria">
                                                <p>{{ $data['note']->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="reviewContent" id="review-show" value="{{ $data['tour']->id }}">
                    {{ Form::hidden('rate-info', '', ['id' => 'rate-info', 'place' => $data['place_rate'], 'food' => $data['food_rate'], 'service' => $data['service_rate'], 'total' => $data['total_rate']]) }}
                    @auth
                        {{ Form::open(['class' => 'commentsForm', 'role' => 'form', 'id' => 'review', 'tour' => $data['tour']->id]) }}
                            <h3 class="reviewTitle">@lang('lang.leave_review')</h3>
                            <p>@lang('lang.want_rate')</p>
                            <div value="3" class="rating-show" id="rating-total-show">
                                <label class="star-show star-large-show"></label>
                                <label class="star-show star-large-show"></label>
                                <label class="star-show star-large-show"></label>
                                <label class="star-show star-large-show"></label>
                                <label class="star-show star-large-show "></label>
                            </div>
                            <div class="row form-group rate-group">
                                <div class="col-md-4 col-xs-12 row form-group" >
                                    <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.places'):</span>
                                    <div class="col-md-9 col-xs-12 rating-select" value="3" id="place-rate">
                                        {{ Form::radio('star-place', 5, '', ['class' => 'star-place star-place-5' , 'id' => 'star-place-5']) }}
                                        <label class="star-place star-place-5" for="star-place-5"></label>
                                        {{ Form::radio('star-place', 4, '', ['class' => 'star-place star-place-4' , 'id' => 'star-place-4']) }}
                                        <label class="star-place star-place-4" for="star-place-4"></label>
                                        {{ Form::radio('star-place', 3, '', ['class' => 'star-place star-place-3' , 'id' => 'star-place-3']) }}
                                        <label class="star-place star-place-3" for="star-place-3"></label>
                                        {{ Form::radio('star-place', 2, '', ['class' => 'star-place star-place-2' , 'id' => 'star-place-2']) }}
                                        <label class="star-place star-place-2" for="star-place-2"></label>
                                        {{ Form::radio('star-place', 1, '', ['class' => 'star-place star-place-1' , 'id' => 'star-place-1']) }}
                                        <label class="star-place star-place-1" for="star-place-1"></label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 row form-group">
                                    <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.foods'):</span>
                                    <div class="col-md-9 col-xs-12 rating-select" value="3" id="food-rate">
                                        {{ Form::radio('star-food', 5, '', ['class' => 'star-food star-food-5' , 'id' => 'star-food-5']) }}
                                        <label class="star-food star-food-5" for="star-food-5"></label>
                                        {{ Form::radio('star-food', 4, '', ['class' => 'star-food star-food-4' , 'id' => 'star-food-4']) }}
                                        <label class="star-food star-food-4" for="star-food-4"></label>
                                        {{ Form::radio('star-food', 3, '', ['class' => 'star-food star-food-3' , 'id' => 'star-food-3']) }}
                                        <label class="star-food star-food-3" for="star-food-3"></label>
                                        {{ Form::radio('star-food', 2, '', ['class' => 'star-food star-food-2' , 'id' => 'star-food-2']) }}
                                        <label class="star-food star-food-2" for="star-food-2"></label>
                                        {{ Form::radio('star-food', 1, '', ['class' => 'star-food star-food-1' , 'id' => 'star-food-1']) }}
                                        <label class="star-food star-food-1" for="star-food-1"></label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 row form-group">
                                    <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.services'):</span>
                                    <div class="col-md-9 col-xs-12 rating-select" value="3" id="service-rate">
                                        {{ Form::radio('star-service', 5, '', ['class' => 'star-service star-service-5' , 'id' => 'star-service-5']) }}
                                        <label class="star-service star-service-5" for="star-service-5"></label>
                                        {{ Form::radio('star-service', 4, '', ['class' => 'star-service star-service-4' , 'id' => 'star-service-4']) }}
                                        <label class="star-service star-service-4" for="star-service-4"></label>
                                        {{ Form::radio('star-service', 3, '', ['class' => 'star-service star-service-3' , 'id' => 'star-service-3']) }}
                                        <label class="star-service star-service-3" for="star-service-3"></label>
                                        {{ Form::radio('star-service', 2, '', ['class' => 'star-service star-service-2' , 'id' => 'star-service-2']) }}
                                        <label class="star-service star-service-2" for="star-service-2"></label>
                                        {{ Form::radio('star-service', 1, '', ['class' => 'star-service star-service-1' , 'id' => 'star-service-1']) }}
                                        <label class="star-service star-service-1" for="star-service-1"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        {{ Form::textarea('comment', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => trans('lang.review_here'), 'id' => 'review-content']) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::submit(trans('lang.submit'), ['class' => 'btn buttonCustomPrimary']) }}
                        {{ Form::close() }}
                    @endauth
                    <h2 class="reviewTitle">@lang('lang.reviews') ({{ count($data['tour']->reviews) }})</h2>
                    <div class="reviewMedia">
                        <ul class="media-list">
                            @foreach ($data['reviews'] as $review)
                                @if (isset($review->user))
                                    <li class="media review-list">
                                        <div class="media-left">
                                            {!! html_entity_decode(Html::link('#', Html::image($review->user->avatar_path, 'image-avatar', ['class' => 'media-object']))) !!}
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading">{{ $review->user->name }}</h5>
                                            <div value="{{ $review->total_rate }}" class="rating-show">
                                                <label class="star-show"></label>
                                                <label class="star-show"></label>
                                                <label class="star-show"></label>
                                                <label class="star-show"></label>
                                                <label class="star-show"></label>
                                            </div>
                                            <p>{{ $review->content }}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="paginationCenter">
                            {{ $data['reviews']->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
