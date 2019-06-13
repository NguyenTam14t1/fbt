@extends ('widgets.bookingtour.dashboard')

@section ('main-content')
    <section class="mainContentSection view-booking">
        <div class="container">
            @if ($booking->status == config('setting.booking_cancel') || $booking->status == config('setting.booking_finished'))
                <div class="row progress-wizard progress-group">
                    <div class="col-sm-4 col-xs-12 progress-wizard-step iconTd">
                        <div class="progress-wizard-dot status-block-{{ $booking->status }}">
                            <i class="icon-status-{{ $booking->status }}" aria-hidden="true"></i>{{ $data['status_message'] }}
                        </div>
                    </div>
                </div>
            @else
            <div class="row progress-wizard progress-group">
                <div class="col-sm-4 col-xs-12 progress-wizard-step complete">
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="progress-wizard-dot">
                        <i class="fa fa-user" aria-hidden="true"></i>1. @lang('lang.personal_info')
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 progress-wizard-step {{ $data['step-2'] }}">
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="progress-wizard-dot">
                        <i class="fa fa-envelope" aria-hidden="true"></i>2. @lang('lang.mail_confirm')
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 progress-wizard-step {{ $data['step-3'] }}">
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="progress-wizard-dot">
                        <i class="fa fa-usd" aria-hidden="true"></i>3. @lang('lang.payment')
                    </div>
                </div>
            </div>
            @endif
            @if (Session::has('msg_success'))
                <div class="alert alert-success alert-dismissible sending-access" role="alert">
                    {{ Form::button('<span aria-hidden="true">x</span>', ['class' => 'close', 'data-dismiss' => 'alert']) }}
                    {!! Session::get('msg_success') !!}
                </div>
            @elseif (Session::has('msg_error'))
                <div class="alert alert-danger alert-dismissible sending-error" role="alert">
                    {{ Form::button('<span aria-hidden="true">x</span>', ['class' => 'close', 'data-dismiss' => 'alert']) }}
                    <i class="fa fa-info"></i>
                    {{ Session::get('msg_error') }}
                </div>
            @endif
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
                    @if (count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="infoTitle">
                        <h2>@lang('lang.payment_info')</h2>
                    </div>
                    <div class="bookingForm">
                        @if ($data['update'])
                            {{ Form::open(['route' => ['client.user.manager.update', $booking->user->id, $booking->id], 'id' => 'update-booking-form', 'class' => 'form', 'role' => 'form']) }}
                            @method('PUT')
                        @else
                        {{ Form::open(['route' => ['client.user.manager.store', $booking->user->id] ,'class' => 'form', 'role' => 'form', 'id' => 'send-mail-again-form']) }}
                            {{ Form::hidden('booking', $booking->id) }}
                        @endif
                            <div class="row">
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.first_name')</label>
                                    {{ Form::text('first_name', $booking->first_name, ['class' => 'form-control', $data['edit'] => $data['edit'], 'id' => 'x']) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.last_name')</label>
                                    {{ Form::text('last_name', $booking->last_name, ['class' => 'form-control', $data['edit'] => $data['edit']]) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.address')</label>
                                    {{ Form::text('address', $booking->address, ['class' => 'form-control', $data['edit'] => $data['edit']]) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.phone')</label>
                                    {{ Form::text('phone', $booking->phone, ['class' => 'form-control', $data['edit'] => $data['edit']]) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.email')</label>
                                    {{ Form::text('email', str_limit($booking->user->email, 5, '*****'), ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.identity_card')</label>
                                    {{ Form::text('identity_card', $booking->identity_card, ['class' => 'form-control', $data['edit'] => $data['edit']]) }}
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="">@lang('lang.requiments')</label>
                                    {{ Form::textarea('requiments', $booking->requiments, ['class' => 'form-control', $data['edit'] => $data['edit']]) }}
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                    <div class="buttonArea btn-group-mail view-booking-btn">
                        <ul class="list-inline">
                            @if ($booking->status == config('setting.booking_wait_confirm'))
                                <li>
                                    {{ Html::link('#', trans('lang.cancel'), ['class' => 'btn buttonTransparent', 'id' => 'cancel-btn', 'onclick' => 'return confirm("' . trans('lang.cancel_message') . '")']) }}
                                    {{ Form::open(['route' => ['client.user.manager.destroy', $booking->user->id, $booking->id], 'id' => 'cancel-form']) }}
                                        {{ method_field('DELETE') }}
                                    {{ Form::close() }}
                                </li>
                                <li>
                                    {{ Html::link('#', trans('lang.send_mail_again'), ['class' => 'btn buttonTransparent', 'id' => 'send-mail-again-btn']) }}
                                </li>
                            @elseif ($booking->status == config('setting.booking_confirmed'))
                                <li>
                                    {{ Html::link('#', trans('lang.cancel'), ['class' => 'btn buttonTransparent', 'id' => 'cancel-btn', 'onclick' => 'return confirm("' . trans('lang.cancel_message') . '")']) }}
                                    {{ Form::open(['route' => ['client.user.manager.destroy', $booking->user->id, $booking->id], 'id' => 'cancel-form']) }}
                                        {{ method_field('DELETE') }}
                                    {{ Form::close() }}
                                </li>
                                <li>
                                    {{ Html::link('#', trans('lang.update'), ['class' => 'btn buttonTransparent', 'id' => 'update-booking-btn']) }}
                                </li>
                                <li>
                                    {{ Html::link('#', trans('lang.continue_payment'), ['class' => 'btn buttonTransparent', 'id' => 'continue-payment-btn']) }}
                                    {{ Form::open(['route' => 'payment', 'id' => 'payment-continue-form']) }}
                                        {{ Form::hidden('booking', $booking->id) }}
                                    {{ Form::close() }}
                                </li>
                            @elseif ($booking->status == config('setting.booking_paymented') && $data['update'])
                                <li>
                                    {{ Html::link('#', trans('lang.cancel'), ['class' => 'btn buttonTransparent', 'id' => 'cancel-btn', 'onclick' => 'return confirm("' . trans('lang.cancel_message') . '")']) }}
                                    {{ Form::open(['route' => ['client.user.manager.destroy', $booking->user->id, $booking->id], 'id' => 'cancel-form']) }}
                                        {{ method_field('DELETE') }}
                                    {{ Form::close() }}
                                </li>
                                <li>
                                    {{ Html::link('#', trans('lang.update'), ['class' => 'btn buttonTransparent', 'id' => 'update-booking-btn']) }}
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
