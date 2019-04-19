@extends('widgets.bookingtour.master')

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
                    <div class="col-sm-3 col-xs-12">
                        <div class="sectionTitleDouble">
                            <p>@lang('lang.search')</p>
                            <h2>@lang('lang.your') <span>@lang('lang.tours')</span></h2>
                        </div>
                    </div>
                    <div class="col-sm-7 col-xs-12">
                        <div class="row">
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
                            <div class="col-sm-3 col-xs-12">
                                <div class="input-group date ed-datepicker" data-provide="datepicker">
                                    {{ Form::text('check_in', '', ['class' => 'form-control', 'placeholder' => trans('lang.check_in')]) }}
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="input-group date ed-datepicker" data-provide="datepicker">
                                    {{ Form::text('check_out', '', ['class' => 'form-control', 'placeholder' => trans('lang.check_out')]) }}
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
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
                                            {!! html_entity_decode(Html::link(route('client.category.show', $tour->category->id), '<span>' . $tour->category->name . '</span>')) !!}
                                            <ul class="list-inline rating rate-home">
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                                <li><i class="fa" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                        <p>{{ str_limit($tour->description, 150) }}</p>
                                        <ul class="list-inline detailsBtn">
                                            <li><span class="textInfo"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang.from'): {{ $tour->time_start_format }}</span></li>
                                            <li><span class="textInfo"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang.to'): {{ $tour->time_finish_format }}</span></li>
                                        </ul>
                                    </div>
                                    <div class="bodyRight">
                                        <div class="bookingDetails">
                                            <h2 class="tour-list-header">${{ $tour->price }}</h2>
                                            <p>@lang('lang.per_person')</p>
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
