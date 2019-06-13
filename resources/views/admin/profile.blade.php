@extends('widgets.admin.master')
@section('title', 'Thông tin tài khoản')
@section('content')
  <section class="content-header">
    <h1>
      Thông tin tài khoản
    </h1>
  </section>
  <section class="content add-user check-add-user">
    <div class="box box-primary">
      <form role="form"
        id="add-user"
        action="{{route('admin.profile.update', ['user' => $user->id])}}"
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
                  maxlength="{{config('setting.hotel.maxlength_name')}}"
                  minlength="{{config('setting.hotel.minlength_name')}}"
                  placeholder="Tên..."
                  value="{{  old('name') ?? $user->name }}">
                  @if ($errors->has('name'))
                      <span class="input-error">{{ $errors->first('name') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Email </label><span class="field-required">*</span>
                <input class="form-control" name="email"
                  id="name"
                  readonly="readonly"
                  minlength="{{config('setting.user.length_phone')}}"
                  placeholder="Email..."
                  value="{{ old('email') ?? $user->email }}">
                  @if ($errors->has('mail'))
                      <span class="input-error">{{ $errors->first('mail') }}</span>
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
                  maxlength="{{config('setting.hotel.maxlength_address')}}"
                  minlength="{{config('setting.hotel.minlength_name')}}"
                  value="{{ old('address') ?? $user->address }}">
                  @if ($errors->has('address'))
                      <span class="input-error">{{ $errors->first('address') }}</span>
                  @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Số điện thoại </label>
                <input class="form-control" name="phone"
                  id="name"
                  maxlength="{{config('setting.hotel.length_phone')}}"
                  minlength="{{config('setting.hotel.length_phone')}}"
                  placeholder="Số điện thoại..."
                  value="{{ old('phone') ?? $user->phone }}">
                  @if ($errors->has('phone'))
                      <span class="input-error">{{ $errors->first('phone') }}</span>
                  @endif
              </div>
            </div>
          </div>
        </div>

        <div id="submit-form">
          <p class="btn-danger btn" data-url="{{ route('admin.dashboard') }}"
            data-toggle="modal" data-target="#modal-default">@lang('admin/global.btn.cancel')</p>
          <input type="submit" class="btn btn-primary" value="@lang('admin/global.btn.submit')">
        </div>
      </form>
    </div>
    @component('widgets.admin.modal')
      @slot('class')
        danger
      @endslot
      @slot('headerText')
        @lang('admin/global.message.cancel')
      @endslot
    @endcomponent
  </section>

@endsection

