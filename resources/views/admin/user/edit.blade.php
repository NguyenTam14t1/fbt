@extends('widgets.admin.master')
@section('title', 'Edit user')
@section('content')
  <section class="content-header">
    <h1>
      Edit user
    </h1>
  </section>
  <section class="content add-user check-add-user">
    <div class="box box-primary">
      <form role="form"
        id="add-user"
        action="{{route('admin.user.store')}}"
        method="POST"
        enctype="multipart/form-data"
        data-url-index="{{route('admin.user.index')}}">
        @csrf
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
                  placeholder="Name..."
                  value="{{ $user->name }}">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Số điên thoại </label><span class="field-required">*</span>
                <input class="form-control" name="phone"
                  id="name"
                  required="required"
                  maxlength="{{config('setting.hotel.length_phone')}}"
                  minlength="{{config('setting.hotel.length_phone')}}"
                  placeholder="Telephone..."
                  value="{{ $user->phone }}">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="place">Địa chỉ </label><span class="field-required">*</span>
                <input class="form-control" name="address"
                  id="place"
                  required="required"
                  placeholder="Address..."
                  maxlength="{{config('setting.hotel.maxlength_address')}}"
                  minlength="{{config('setting.hotel.minlength_name')}}"
                  value="{{ $user->address }}"
                  required="required">
                  <span class="text-danger place-error" role="alert"></span>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Email </label><span class="field-required">*</span>
                <input class="form-control" name="mail"
                  id="name"
                  required="required"
                  minlength="{{config('setting.user.length_phone')}}"
                  placeholder="Telephone..."
                  value="{{ $user->phone }}">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group name">
                <label for="place">Website </label>
                <input class="form-control" type="text" name="website" value="{{ $user->website }}" readonly="readonly">
              </div>
            </div>
          </div>
        </div>

        <div id="submit-form">
          <p class="btn-danger btn" data-url="{{ route('admin.user.index') }}"
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
@section('styles')
  {{ Html::style('css/select2.min.css') }}
@endsection
@section('scripts')
  {{ Html::script('templates/admin/js/user.js') }}
 {{ Html::script('js/moment.js') }}
  {{ Html::script('js/bootstrap-select.min.js') }}
  {{ Html::script('js/select2.min.js') }}
@endsection
