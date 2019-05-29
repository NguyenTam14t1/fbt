<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="./templates/bookingtour/css/mail-form.css">
<div class="mail-form">
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ $message->embed(public_path() . config('setting.logo-page')) }}">
        </a>
    </div>
    <div class="content-form">
        <h2 class="greeting">@lang('lang.hi'){{ $data['first_name'] }}</h2>
        <p><i>@lang('lang.mail_content')</i></p>
        <hr/>
        <h1 class="header">@lang('lang.booking_confirm')</h1>
        <h2>@lang('lang.personal_info')</h2>
        <div>
            <div class="group-form">
                <div class="left">@lang('lang.first_name'):</div>
                <div class="right">{{ $data['first_name'] }}</div>
            </div>
            <div class="group-form">
                <div class="left">@lang('lang.last_name'):</div>
                <div class="right">{{ $data['last_name'] }}</div>
            </div>
            <div class="group-form">
                <div class="left">@lang('lang.address'):</div>
                <div class="right">{{ $data['address'] }}</div>
            </div>
            <div class="group-form">
                <div class="left">@lang('lang.phone'):</div>
                <div class="right">{{ str_limit($data['phone'], 5, '*****') }}</div>
            </div>
            <div class="group-form">
                <div class="left">@lang('lang.identity_card'):</div>
                <div class="right">{{ str_limit($data['identity_card'], 4, '*****') }}</div>
            </div>
            <div class="group-form">
                <div class="left">@lang('lang.email'):</div>
                <div class="right">{{ $data['email'] }}</div>
            </div>
        </div>
        <div>
            <h2>@lang('lang.booking_info')</h2>
            <div>
                <div class="group-form">
                    <div class="left">@lang('lang.tour_name'):</div>
                    <div class="right">{{ $data['tour']->name }}</div>
                </div>
                <div class="group-form">
                    <div class="left">@lang('lang.adults'):</div>
                    <div class="right">{{ $data['number_of_people'] }}</div>
                </div>
                <div class="group-form">
                    <div class="left">@lang('lang.children'):</div>
                    <div class="right">{{ $data['number_of_children'] }}</div>
                </div>
                <div class="group-form">
                    <div class="left">@lang('lang.total_cost'):</div>
                    <div class="right">${{ $data['debt'] }}</div>
                </div>
                <div class="group-form">
                    <div class="left">@lang('lang.requiments'):</div>
                    <div class="right">{{ $data['requiments'] }}</div>
                </div>
            </div>
        </div>
        <div>
            <h2>@lang('lang.tour_info')</h2>
            <a href="{{ route('client.tour.show', $data['tour']->id) }}">
                <img src="{{ $message->embed(public_path() . $data['tour']->picture_path) }}">
            </a>
            <div class="confirmInfo">
                <p>{!! $data['tour']->description !!}</p>
                <div class="booking-detail">
                  <div class="col">
                    <div class="group-form">
                        <div class="left">@lang('lang.from'):</div>
                        <div class="right">{{ $data['tour']->time_start_format }}</div>
                    </div>
                    <div class="group-form">
                        <div class="left">@lang('lang.to'):</div>
                        <div class="right">{{ $data['tour']->time_finish_format }}</div>
                    </div>
                    <div class="group-form">
                        <div class="left">@lang('lang.place'):</div>
                        <div class="right">{{ $data['tour']->place }}</div>
                    </div>
                  </div>
                  <div class="price-content">
                    <h2>@lang('lang.price'): <span class="price">${{ $data['tour']->price }}</span></h2>
                    <p>@lang('lang.price_text')</p>
                  </div>
                </div>
                @include('bookingtour.tour-info-hotel-guide')
            </div>
        </div>
        <div>
            {{ Html::link(route('confirm', $data['confirm_code']), trans('lang.confirm'), ['class' => 'btn-confirm']) }}
        </div>
    </div>
    <div class="footerContent">
        <h3>@lang('lang.contact_us'):</h3>
        <p><i class="fa fa-home" aria-hidden="true"></i>@lang('lang.address_contact')</p>
        <p><i class="fa fa-phone" aria-hidden="true"></i>@lang('lang.phone_contact')</p>
        <p><i class="fa fa-envelope-o" aria-hidden="true"></i>{{ Html::link('#', trans('lang.email_contact')) }}</p>
    </div>
</div>
