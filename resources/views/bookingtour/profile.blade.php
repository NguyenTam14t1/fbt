
@extends('widgets.bookingtour.dashboard')

@section('change-header', 'changeHeader1')
@section('header-type', 'lightHeader lightHeader1')

@section('main-content')
    <section class="recentActivitySection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="recentActivityContent bg-ash">
                        <div class="dashboardPageTitle">
                            <h2>Tài khoản</h2>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible sending-access" role="alert">
                                {{ Form::button('<span aria-hidden="true">x</span>', ['class' => 'close', 'data-dismiss' => 'alert']) }}
                                {!! Session::get('message') !!}
                            </div>
                        @elseif (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible sending-error" role="alert">
                                {{ Form::button('<span aria-hidden="true">x</span>', ['class' => 'close', 'data-dismiss' => 'alert']) }}
                                <i class="fa fa-info"></i>
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div data-pattern="priority-columns">
                          <form role="form"
                            id="edit-user"
                            action="{{route('client.user.update', ['user' => $data['user']->id])}}"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="name">Tên </label><span class="field-required">*</span>
                                    <input class="form-control" name="name"
                                      id="name"
                                      required="required"
                                      maxlength="{{config('setting.user.maxlength_name')}}"
                                      minlength="{{config('setting.user.minlength_name')}}"
                                      placeholder="Tên..."
                                      value="{{ old('name') ?? $data['user']->name }}">
                                      @if ($errors->has('name'))
                                        <span class="input-error">{{ $errors->first('name') }}</span>
                                    @endif
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="name">Email </label><span class="field-required">*</span>
                                    <input class="form-control" name="email"
                                      id="email"
                                      maxlength="60"
                                      placeholder="Email..."
                                      value="{{ old('email') ?? $data['user']->email }}">
                                    @if ($errors->has('email'))
                                        <span class="input-error">{{ $errors->first('email') }}</span>
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="place">Địa chỉ </label>
                                    <input class="form-control" name="address"
                                      id="place"
                                      placeholder="Địa chỉ..."
                                      maxlength="{{config('setting.user.maxlength_address')}}"
                                      minlength="{{config('setting.user.minlength_name')}}"
                                      value="{{ old('address') ?? $data['user']->address }}">
                                      <span class="text-danger place-error" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="place">Số điện thoại </label><span class="field-required">*</span>
                                    <input class="form-control" name="phone"
                                      id="phone"
                                      placeholder="Số điện thoại..."
                                      maxlength="{{config('setting.hotel.length_phone')}}"
                                      minlength="{{config('setting.hotel.length_phone')}}"
                                      value="{{ old('phone') ?? $data['user']->phone }}">
                                      <span class="text-danger place-error" role="alert"></span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="buttonArea btn-group-mail" style="margin-bottom: 0px">
                              <a class="btn btn-danger" href="{{ route('home') }}"  style="width: 100px; height: 45px; margin-right: 20px">Thoát</a>
                              <input type="submit" id="btn-update-profile" name="btn-update-profile" class="btn btn-primary" value="Cập nhật" style="width: 100px; height: 45px">
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
