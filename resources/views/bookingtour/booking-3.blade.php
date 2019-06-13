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
                            <form action="{{ route('paymentOnline') }}" method="POST" id="form-payment" role="form" class="form">
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
                                        <label for="">@lang('lang.card_number')</label>{{ Form::text('card_number', old('card_number'), ['class' => 'form-control', 'id' => 'card_number']) }}
                                    </div>
                                    <div class="form-group col-sm-4 col-xs-12">
                                        <label for="">@lang('lang.cvv')</label>
                                        {{ Form::number('cvv', old('cvv'), ['class' => 'form-control', 'id' => 'cvc']) }}
                                    </div>

                                    <div class="form-group col-sm-4 col-xs-12 group-selectbox">
                                        <label for="" class="blankLabel">@lang('lang.expiration_date')</label>
                                        <div>
                                            {{ Form::select('month',
                                                [
                                                    '1' => 'Tháng 1', '2' => 'Tháng 2', '3' => 'Tháng 3', '4' => 'Tháng 4', '5' => 'Tháng 5',
                                                    '6' => 'Tháng 6', '7' => 'Tháng 7', '8' => 'Tháng 8', '9' => 'Tháng 9', '10' => 'Tháng 10', '11' => 'Tháng 11', '12' => 'Tháng 12'
                                                ],
                                                '',
                                                [
                                                    'class' => 'selectpicker',
                                                    'id' => 'exp_month',
                                                    'data-live-search' => 'true',
                                                    'multiple',
                                                    'data-max-options' => '1',
                                                    'title' => 'Chọn tháng'])
                                            }}
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4 col-xs-12  group-selectbox">
                                        <label for=""></label>
                                        <div class="bookingDrop">
                                            @php
                                                $years = [];
                                                for ($year=2018; $year <= 2050; $year++) $years[$year] = $year;
                                            @endphp
                                            <select
                                                name="year"
                                                id="exp_year"
                                                class="form-control selectpicker"
                                                data-live-search="true"
                                                multiple
                                                require="required"
                                                data-max-options="1"
                                                title="Chọn năm">
                                                @foreach ($years as $year)
                                                    <option value="{{$year}}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="buttonArea btn-group-mail">
                                        <input type="submit" id="btn-payment-stripe" name="btn-payment-online" class="btn buttonTransparent" value="Payment">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <h4>Có lỗi xảy ra!</h4>
    @endif
@endsection
@section('styles')
    {{ Html::style('css/bootstrap-select.min.css') }}
    {{ Html::style('css/select2.min.css') }}
@endsection
@section('scripts')
    {{ Html::script('templates/bookingtour/js/tour.js') }}
    {{ Html::script('js/bootstrap-select.min.js') }}
    {{ Html::script('js/select2.min.js') }}
@endsection
<!--
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    document.getElementById("form-payment").submit(function() {
        e.preventDefault()
        var stripe = Stripe('pk_test_6gWjm1D4weGWS0YNMAxtPfhN00cMO6Smxp');
        var number = $('#card_number').val() || null
        var exp_month = $('#exp_month').val() || null
        var exp_year = $('#exp_year').val() || null
        var cvc = $('#cvc').val() || null
        stripe.createToken('bank_account', {
          number: number,
          exp_month: exp_month,
          exp_year: exp_year,
          cvc: cvc,
        }).then(function(result) {
          alert(result);
        });
    })
</script>
 -->
