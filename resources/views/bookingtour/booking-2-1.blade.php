@extends('widgets.bookingtour.master')

@section('change-header', 'changeHeader1')
@section('header-type', 'lightHeader lightHeader1')

@section('content')
    <!-- PAGE TITLE -->
    <section class="pageTitle page-title-3">
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
                                    {{ Html::link(route('client.tour.show', $data['tour']->id), $data['tour']->name) }}
                                </li>
                                <i class="fa fa-caret-right"></i>
                                <li>
                                    @lang('lang.booking')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mainContentSection">
        <div class="container">
            <div class="row progress-wizard progress-group">
                <div class="col-sm-4 col-xs-12 progress-wizard-step complete">
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="progress-wizard-dot">
                        <i class="fa fa-user" aria-hidden="true"></i>1. @lang('lang.personal_info')
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 progress-wizard-step active">
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="progress-wizard-dot">
                        <i class="fa fa-envelope" aria-hidden="true"></i>2. @lang('lang.mail_confirm')
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 progress-wizard-step disabled">
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="progress-wizard-dot">
                        <i class="fa fa-usd" aria-hidden="true"></i>3. @lang('lang.payment')
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="infoTitle">
                        <h2>@lang('lang.mail_confirm')</h2>
                    </div>
                    @if (Session::has('send_success'))
                        <div class="alert alert-success alert-dismissible sending-access" role="alert">
                            {{ Form::button('<span aria-hidden="true">x</span>', ['class' => 'close', 'data-dismiss' => 'alert']) }}
                            {!! Session::get('send_success') !!}
                        </div>
                    @elseif (Session::has('send_error'))
                        <div class="alert alert-danger alert-dismissible sending-error" role="alert">
                            {{ Form::button('<span aria-hidden="true">x</span>', ['class' => 'close', 'data-dismiss' => 'alert']) }}
                            <i class="fa fa-info"></i>
                            {{ Session::get('send_error') }}
                        </div>
                    @endif
                    <div class="buttonArea btn-group-mail">
                        <ul class="list-inline">
                            <li>
                                {{ Html::link(route('client.user.index'), trans('lang.my_booking'), ['class' => 'btn buttonTransparent']) }}
                            </li>
                            <li>
                                {{ Html::link('#', trans('lang.send_again'), ['class' => 'btn buttonTransparent', 'id' => 'send-again-btn']) }}
                            </li>
                        </ul>
                    </div>
                    <div class="confirmDetilas">
                        {{ Html::image($data['tour']->picture_path, 'tour-image') }}
                        <div class="confirmInfo">
                            <div class="infoTitle">
                                <h2>{{ $data['tour']->name }}</h2>
                            </div>
                            <p>{!! $data['tour']->description !!}</p>
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                    <dl class="dl-horizontal">
                                        <dt><i class="fa fa-map-marker" aria-hidden="true"></i> @lang('lang.place'):</dt>
                                        <dd>{{ $data['tour']->place }}</dd>
                                    </dl>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <dl class="dl-horizontal">
                                        <dt><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang.from'):</dt>
                                        <dd>{{ $data['tour']->time_start_format }}</dd>
                                        <dt><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang.to'):</dt>
                                        <dd>{{ $data['tour']->time_finish_format }}</dd>
                                        <dt><i class="fa fa-user" aria-hidden="true"></i> @lang('lang.guest'):</dt>
                                        <dd id="paticipants" adults="{{ $data['number_of_people'] }}" children="{{ $data['number_of_children'] }}">{{ $data['number_of_people'] }} @lang('lang.adults'), {{ $data['number_of_children'] }} @lang('lang.children')</dd>
                                    </dl>
                                </div>
                                <div class="col-sm-4 col-xs-12 priceTotal">
                                    <h2>@lang('lang.total'): <span><strong> ${{ $data['debt'] }}</strong></span></h2>
                                </div>
                            </div>
                            <div class="row">
                                @include('bookingtour.tour-info-hotel-guide')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
