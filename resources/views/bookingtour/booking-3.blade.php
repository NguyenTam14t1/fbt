@extends('widgets.bookingtour.master')

@section('change-header', 'changeHeader1')
@section('header-type', 'lightHeader lightHeader1')

@section('content')
    <!-- PAGE TITLE -->
    @if (isset($booking->tour))
        <section class="pageTitle page-title-3">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="titleTable">
                            <div class="titleTableInner">
                                <div class="pageTitleInfo">
                                    <h1>{{ $booking->tour->name }}</h1>
                                    <div class="under-border"></div>
                                </div>
                                <ol class="page-title-content">
                                    <li>
                                       {{ Html::link(route('home'), trans('lang.home')) }}
                                    </li>
                                    @foreach ($categories as $category)
                                        <i class="fa fa-caret-right"></i>
                                        <li>
                                            {{ Html::link(route('client.category.show', $category->id), $category->name) }}
                                        </li>
                                    @endforeach
                                    <i class="fa fa-caret-right"></i>
                                    <li>
                                        {{ Html::link(route('client.tour.show', $booking->tour->id), $booking->tour->name) }}
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
                    <div class="col-sm-4 col-xs-12 progress-wizard-step complete">
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <div class="progress-wizard-dot">
                            <i class="fa fa-envelope-open" aria-hidden="true"></i>2. @lang('lang.mail_confirm')
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12 progress-wizard-step active">
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <div class="progress-wizard-dot">
                            <i class="fa fa-usd" aria-hidden="true"></i>3. @lang('lang.payment')
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-push-8 col-xs-12">
                        <aside>
                            <div class="infoTitle">
                                <h2>@lang('lang.booking_detail')</h2>
                            </div>
                            <div class="bookDetailsInfo">
                                {{ Html::image($booking->tour->picture_path, 'tour-image') }}
                                <div class="infoArea">
                                    <h3>{{ $booking->tour->name }}</h3>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>@lang('lang.from'):  <span>{{ $booking->tour->time_start_format }}</span></li>
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>@lang('lang.to'):  <span>{{ $booking->tour->time_finish_format }}</span></li>
                                        <li><i class="fa fa-user" aria-hidden="true"></i></i>@lang('lang.guest'):  <span>{{ $booking->number_of_people }} @lang('lang.adults'), {{ $booking->number_of_children }} @lang('lang.children')</span></li>
                                    </ul>
                                    <div class="priceTotal">
                                        <h2>@lang('lang.total'): <span><strong>${{ $booking->debt }}</strong></span></h2>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-sm-8 col-sm-pull-4 col-xs-12">
                        <div class="infoTitle">
                            <h2>@lang('lang.payment_info')</h2>
                        </div>
                        <div class="bookingForm">
                            <form action="{{ route('paymentOnline') }}" method="POST" role="form" class="form">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.first_name')</label>
                                        <input type="text" name="booking_id" class="hide" value="{{ $booking->id }}">
                                        <input type="text" name="tour_id" class="hide" value="{{ $booking->tour->id }}">
                                        <input type="text" name="tour_debt" class="hide" value="{{ $booking->debt }}">
                                        <input type="text" name="tour_name" class="hide" value="{{ $booking->tour->name }}">
                                        {{ Form::text('first_name', $booking->first_name, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.last_name')</label>
                                        {{ Form::text('last_name', $booking->last_name, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.address')</label>
                                        {{ Form::text('address', $booking->address, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.phone')</label>
                                        {{ Form::text('phone', str_limit($booking->phone, 5, '*****'), ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.email')</label>
                                        {{ Form::text('email', str_limit($booking->user->email, 5, '*****'), ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.identity_card')</label>
                                        {{ Form::text('identity_card', str_limit($booking->identity_card, 4, '****'), ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.city')</label>
                                        {{ Form::text('city', old('city'), ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.zip_code')</label>
                                        {{ Form::text('zip_code', old('zip_code'), ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="infoTitle">
                                            <h2>@lang('lang.card_info')</h2>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.card_name')</label>
                                        {{ Form::text('card_name', old('card_name'), ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.card_number')</label>{{ Form::text('card_number', old('card_number'), ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="">@lang('lang.cvv')</label>
                                        {{ Form::text('cvv', old('cvv'), ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="" class="blankLabel"></label>
                                        <ul class="list-inline">
                                            <li>
                                                {!! html_entity_decode(Html::link('#', Html::image(config('setting.master_card_icon'), 'master-card-icon'))) !!}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for="" class="blankLabel">@lang('lang.expiration_date')</label>
                                        <div class="bookingDrop">
                                            {{ Form::select('month', ['0' => trans('lang.month'), '1' => 'July', '2' => 'August', '3' => 'September'], '', ['class' => 'select-drop form-control']) }}
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                        <label for=""></label>
                                        <div class="bookingDrop">
                                            {{ Form::select('year', ['0' => trans('lang.year'), '1' => '2018', '2' => '2019', '3' => '2020'], '', ['class' => 'select-drop form-control']) }}
                                        </div>
                                    </div>
                                    <div class="buttonArea btn-group-mail">
                                        <input type="submit" name="btn-payment-online" class="btn buttonTransparent" value="Payment">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <h4>Something error!</h4>
    @endif
@endsection
