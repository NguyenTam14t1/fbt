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
                <div class="col-sm-4 col-xs-12 progress-wizard-step active">
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="progress-wizard-dot">
                        <i class="fa fa-user" aria-hidden="true"></i>1. @lang('lang.personal_info')
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 progress-wizard-step disabled">
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
                <div class="col-sm-4 col-sm-push-8 col-xs-12">
                    <aside>
                        <div class="infoTitle">
                            <h2>@lang('lang.booking_detail')</h2>
                        </div>
                        <div class="bookDetailsInfo">
                            {{ Html::image($data['tour']->picture_path, 'image-tour') }}
                            <div class="infoArea">
                                <h3>{{ $data['tour']->name }}</h3>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>@lang('lang.from'):  <span>{{ $data['tour']->time_start_format }}</span></li>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>@lang('lang.to'):  <span>{{ $data['tour']->time_finish_format }}</span></li>
                                    <li><i class="fa fa-user" aria-hidden="true"></i></i>@lang('lang.guest'):  <span>{{ $data['adults'] }} @lang('lang.adults'), {{ $data['children'] }} @lang('lang.children')</span></li>
                                </ul>
                                <div class="priceTotal">
                                    <h2>@lang('lang.total'): <span>${{ $data['price'] }}</span></h2>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-sm-8 col-sm-pull-4 col-xs-12">
                    <div class="infoTitle">
                        <h2>Thông tin liên lạc</h2>
                    </div>
                    <div class="bookingForm">
                        @if (count($errors))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{ Form::open(['route' => ['client.tour.booking.store', $data['tour']->id], 'role' => 'form', 'class' => 'form', 'id' => 'personal-info-form']) }}
                            <div class="row">
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.first_name')</label>
                                    {{ Form::text('first_name', old('first_name'), ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.last_name')</label>
                                    {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.address')</label>
                                    {{ Form::text('address', old('address'), ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.phone')</label>
                                    {{ Form::text('phone', old('phone'), ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.email_confirm')</label>
                                    {{ Form::text('email', str_limit(Auth::user()->email, 6, '******'), ['class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly']) }}
                                </div>
                                <div class="form-group col-sm-6 col-xs-12">
                                    <label for="">@lang('lang.identity_card')</label>
                                    {{ Form::text('identity_card', old('identity_card'), ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="">@lang('lang.requiments')</label>
                                    {{ Form::textarea('requiments', old('requiments'), ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="form-group col-xs-12">
                                <div class="infoTitle">
                                    <h2>Danh sách khách hàng</h2>
                                </div>
                            </div>

                            <div>
                                <input type="text" name="num_register" id="num-register" class="hide" value="{{ $data['adults'] + $data['children'] }}">
                            </div>

                            @for ($i = 0; $i < $data['adults']; $i++)
                                <label for="">Người lớn {{ $i+1 }}</label>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <div class="col-sm-8 nopadding">
                                          <div class="form-group">
                                            <input type="text" class="form-control" id=" guest-full-name-{{ $i }}" name="guest[full_name][]" value="" placeholder="Full name">
                                          </div>
                                        </div>

                                        <div class="col-sm-4 nopadding">
                                          <div class="form-group">
                                            <div class="input-group">
                                              <input type="date" name="guest[date_born][]" id="guest-date-born-{{ $i }}" class="form-control guest-date-born" placeholder="Date of born">
                                              <input type="text" name="guest[type_guest][]" id="guest-type-{{ $i }}" class="form-control hide" value="{{config('setting.booking.adult')}}">
                                            </div>
                                          </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>
                            @endfor

                            @for ($i = 0; $i < $data['children']; $i++)
                                <label for="">Trẻ nhỏ {{ $i+1 }}</label>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <div class="col-sm-8 nopadding">
                                          <div class="form-group">
                                            <input type="text" class="form-control full_name"  id=" guest-full-name-{{ $i }}" name="guest[full_name][]" value="" placeholder="Full name">
                                          </div>
                                        </div>

                                        <div class="col-sm-4 nopadding">
                                          <div class="form-group">
                                            <div class="input-group">
                                              <input type="date" name="guest[date_born][]" id="guest-born-{{ $i }}" class="form-control born" placeholder="Date of born">
                                              <input type="text" name="guest[type_guest][]" id="guest-type-{{ $i }}" class="form-control hide" value="{{config('setting.booking.children')}}">
                                            </div>
                                          </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>
                            @endfor

                            <div class="row">
                                <div class="sectionTitle2">
                                    @if (isset($data['term']->content))
                                        <h2>Chú ý</h2>
                                        <div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="tab-content">
                                                        <div class="design-process-content" style="border:1px solid #ccc;padding: 20px 30px 20px 30px;text-align: justify;word-wrap: break-word;height: 300px;overflow-y: scroll;line-height: 22px">
                                                            <div class="description-aria">
                                                                <p>{{ $data['term']->content }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row" style="margin-top: 30px">
                                <div class="checkbox col-xs-12">
                                    <label>
                                        {{ Form::checkbox('accept', 1, false, ['required' => 'required']) }} @lang('lang.accept_text') {{ Html::link('#', trans('lang.term_condition')) }}
                                    </label>
                                </div>

                                <div class="col-xs-12">
                                    <div class="buttonArea galleryBtnArea">
                                        <ul class="list-inline">
                                            <li>
                                                {{ Html::link(route('client.tour.show', $data['tour']->id), trans('lang.back'), ['class' => 'btn buttonTransparent']) }}
                                            </li>
                                            <li class="pull-right">
                                                {{ Html::link('#', trans('lang.next'), ['class' => 'btn buttonTransparent', 'id' => 'step1-btn']) }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
