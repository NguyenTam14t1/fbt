@extends('widgets.admin.master')
@section('title', 'Chỉnh sửa thông tin khách sạn')
@section('content')
  <section class="content-header">
    <h1>
      Chỉnh sửa thông tin khách sạn
    </h1>
  </section>
  <section class="content add-hotel check-edit-hotel">
    <div class="box box-primary">
      <form role="form"
        id="edit-hotel"
        action="{{route('admin.hotel.update', ['hotel' => $hotel->id])}}"
        method="POST"
        enctype="multipart/form-data"
        data-url-index="{{route('admin.hotel.index')}}">
        @csrf
        {{ method_field('PATCH') }}
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="name">Tên </label><span class="field-required">*</span>
                <input class="form-control" name="name"
                  id="name"
                  required="required"
                  maxlength="{{config('setting.hotel.maxlength_name')}}"
                  minlength="{{config('setting.hotel.minlength_name')}}"
                  placeholder="Tên..."
                  value="{{ $hotel->name }}">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Số điện thoại </label><span class="field-required">*</span>
                <input class="form-control" name="phone"
                  id="name"
                  maxlength="{{config('setting.hotel.length_phone')}}"
                  minlength="{{config('setting.hotel.length_phone')}}"
                  placeholder="Số điện thoại..."
                  value="{{ $hotel->phone }}">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label for="place">Địa chỉ </label><span class="field-required">*</span>
                <input class="form-control" name="address"
                  id="place"
                  placeholder="Địa chỉ..."
                  maxlength="{{config('setting.hotel.maxlength_address')}}"
                  minlength="{{config('setting.hotel.minlength_name')}}"
                  value="{{ $hotel->address }}"
                  required="required">
                  <span class="text-danger place-error" role="alert"></span>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="place">Rating </label>
                <span class="form-control" readonly="readonly">{!! renderHtmlRating($hotel->rating) !!}</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group name">
                <label for="place">Website </label>
                <input class="form-control" type="text" name="website" value="{{ $hotel->website }}" readonly="readonly">
              </div>
            </div>
          </div>
        </div>

        <div id="submit-form">
          <p class="btn-danger btn" data-url="{{ route('admin.hotel.index') }}"
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
  {{ Html::style('css/bootstrap-datetimepicker.css') }}
  {{ Html::style('css/dropzone.css') }}
  {{ Html::style('css/quill.snow.css') }}
  {{ Html::style('css/bootstrap-select.min.css') }}
  {{ Html::style('css/select2.min.css') }}
  {{ Html::style('templates/admin/css/hotel.css') }}
@endsection
@section('scripts')
  {{ Html::script('templates/admin/js/hotel.js') }}
  {{ Html::script('js/moment.js') }}
  {{ Html::script('js/bootstrap-datetimepicker.min.js') }}
  {{ Html::script('js/dropzone.js') }}
  {{ Html::script('js/screenfull.js') }}
  {{ Html::script('js/quill.min.js') }}
  {{ Html::script('js/image-resize.min.js') }}
  {{ Html::script('js/bootstrap-select.min.js') }}
  {{ Html::script('js/select2.min.js') }}
@endsection
