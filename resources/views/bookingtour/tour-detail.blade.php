@extends('widgets.bookingtour.master')

@section('content')

    <!-- PAGE CONTENT -->
    <section class="mainContentSection singlePackage">
        <div class="container">
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
                                {{ Html::image(config('setting.tour_default_img') , 'First slide') }}
                            </div>
                            <div class="item ">
                                {{ Html::image(config('setting.tour_default_img') , 'Second slide') }}
                            </div>
                            <div class="item ">
                                {{ Html::image(config('setting.tour_default_img') , 'Third slide') }}
                            </div>
                        </div>
                        <a class="left carousel-control" href="#package-carousel" data-slide="prev"><span class="glyphicon glyphicon-menu-left"></span></a>

                        <a class="right carousel-control" href="#package-carousel" data-slide="next"><span class="glyphicon glyphicon-menu-right"></span></a>
                    </div>
                    <div class="row form-group rate-group">
                        <div class="col-md-4 rate-show-form col-xs-12 row form-group" >
                            <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.places'):</span>
                            <div class="col-md-9 col-xs-12">
                                <label class="star-show checked-1"></label>
                                <label class="star-show checked-1"></label>
                                <label class="star-show "></label>
                                <label class="star-show "></label>
                                <label class="star-show "></label>
                            </div>
                        
                        </div>
                        <div class="col-md-4 rate-show-form col-xs-12 row form-group">
                            <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.foods'):</span>
                            <div class="col-md-9 col-xs-12">
                                <label class="star-show checked-1"></label>
                                <label class="star-show checked-1"></label>
                                <label class="star-show "></label>
                                <label class="star-show "></label>
                                <label class="star-show "></label>
                            </div>
                        </div>
                        <div class="col-md-4 rate-show-form col-xs-12 row form-group">
                            <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.services'):</span>
                            <div class="col-md-9 col-xs-12">
                                <label class="star-show checked-1"></label>
                                <label class="star-show checked-1"></label>
                                <label class="star-show "></label>
                                <label class="star-show "></label>
                                <label class="star-show "></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 row form-group total-rate" >
                            <span class="col-md-4 col-xs-12 rate-big-title">@lang('lang.rate'): <strong>4.2</strong>/<strong>5</strong></span>
                            <div class="col-md-5 col-xs-12">
                                <label class="star-show star-big-show checked-1"></label>
                                <label class="star-show star-big-show checked-1"></label>
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
                                                    <div class="input-group date ed-datepicker" data-provide="datepicker">
                                                        {{ Form::text('date-start', $tour->time_start_format, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                                        <div class="input-group-addon">
                                                            <span class="fa fa-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-5 col-sm-12 col-xs-5" for="inputSuccess3">@lang('lang.date_finish'):</label>
                                                <div class="col-md-7 col-sm-12 col-xs-7 datepickerWrap">
                                                    <div class="input-group date ed-datepicker filterDate" data-provide="datepicker">
                                                        {{ Form::text('date-finish', $tour->time_finish_format, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                                        <div class="input-group-addon">
                                                            <span class="fa fa-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-5 col-sm-12 col-xs-5" for="inputSuccess3">@lang('lang.participants_max')</label>
                                                <div class="col-md-7 col-sm-12 col-xs-7 datepickerWrap">
                                                    <div class="input-group date ed-datepicker filterDate" data-provide="datepicker">
                                                        {{ Form::text('participants_max', $tour->participants_max, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'participants_max']) }}
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
                                                        {{ Html::link('', '-', ['class' => 'incr-btn decrease-btn', 'data-action' => 'decrease']) }}
                                                        {{ Form::text('quantity', 1, ['class' => 'quantity adult']) }}
                                                        {{ Html::link('', '+', ['class' => 'incr-btn increase-btn', 'data-action' => 'increase']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <p class="price" value="{{ $tour->price }}">${{ $tour->price }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-5 col-sm-12 col-xs-5" for="inputSuccess3">@lang('lang.children'):</label>
                                                <div class="col-md-5 col-sm-12 col-xs-7 datepickerWrap">
                                                    <div class="count-input">
                                                        {{ Html::link('', '-', ['class' => 'incr-btn decrease-btn', 'data-action' => 'decrease']) }}
                                                        {{ Form::text('quantity', 0, ['class' => 'quantity child']) }}
                                                        {{ Html::link('', '+', ['class' => 'incr-btn increase-btn', 'data-action' => 'increase']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <p class="price" value="{{ $tour->price_child }}">${{ $tour->price_child }}</p>
                                                </div>
                                                <div class="col-md-5 col-sm-12 col-xs-12">
                                                    <p class="message-total-people" value="{{ trans('lang.message_total_people') }}"></p>
                                                </div>
                                            </div>
                                            <div class="totalCost">
                                                <div class="col-xs-8 totalCostLeft">
                                                    <p>@lang('lang.total_cost'):</p>
                                                </div>
                                                <div class="col-xs-4 totalCostRight" value="{{ $tour->price }}">${{ $tour->price }}</div>
                                            </div>
                                            <div class="col-sm-12">
                                                {!! html_entity_decode(Html::link('#', trans('lang.check_now') . '<i class="fa fa-angle-right" aria-hidden="true"></i>', ['class' => 'btn btn-block buttonTransparent '])) !!}
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
                    <p>{!! $tour->description !!}</p>
                </div>
                <div class="row">
                    @foreach ($tour->activityDates->chunk(2) as $chunk)
                        <div class="col-xs-12 col-sm-6">
                            <ul class="descriptionList">
                                @foreach ($chunk as $activityDate)
                                    <li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{ str_limit($activityDate->content, 50) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="information-aria">
            <h3 class="program-title">@lang('lang.program_overview')</h3>
            <section id="special-offers" class="section wide-fat">
                <div id="mi-slider" class="mi-slider">
                    @foreach ($tour->activityDates as $activity)
                        <ul>
                            <li>
                                <a href="#">
                                    {{ Html::image('', 'Date Program') }}
                                    <div class="container">
                                        <article class="special-offers section-intro">
                                            <h2 class="page-title date-content">{{ $activity->content }}</h2>
                                        </article>     
                                    </div>
                                </a>
                            </li>
                        </ul>
                    @endforeach
                    <nav id="mi-nav">
                        @foreach ($tour->activityDates as $activity)
                            <a href="#"><span>@lang('lang.day') {{ $loop->iteration }}</span></a>
                        @endforeach
                    </nav>
                </div>     
                <div class="clearfix"></div>
            </section>
        </div>
        <div class="container">
            <div class="review-aria">
                <div class="sectionTitle2">
                    <h2>@lang('lang.reviews')</h2>
                    <p>@lang('lang.review_text')</p>
                </div>
                <div class="reviewContent">
                    <h2 class="reviewTitle">@lang('lang.reviews') ({{ count($tour->reviews) }})</h2>
                    <div class="reviewMedia">
                        <ul class="media-list">
                            @foreach ($tour->reviews as $review)
                                <li class="media">
                                    <div class="media-left">
                                        {!! html_entity_decode(Html::link('#', Html::image('', 'image-avatar', ['class' => 'media-object']))) !!}
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
                            @endforeach
                        </ul>
                    </div>
                    @auth
                        {{ Form::open(['class' => 'commentsForm', 'role' => 'form']) }}
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
                                    <div class="col-md-9 col-xs-12 rating-select" value="3" id="x">
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
                                    <div class="col-md-9 col-xs-12 rating-select" value="3">
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
                                    <div class="col-md-9 col-xs-12 rating-select" value="3">
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
                                        {{ Form::textarea('comment', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => trans('lang.comment')]) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::submit(trans('lang.submit'), ['class' => 'btn buttonCustomPrimary']) }}
                        {{ Form::close() }}
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
