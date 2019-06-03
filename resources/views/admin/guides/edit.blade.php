@extends('widgets.admin.master')
@section('title', 'Chỉnh sửa thông tin')
@section('content')
  <section class="content-header">
    <h1>
      Chỉnh sửa thông tin
    </h1>
  </section>
  <section class="content add-guide check-add-guide">
    <div class="box box-primary">
      <form role="form"
        id="add-guide"
        action="{{route('admin.guide.store')}}"
        method="POST"
        enctype="multipart/form-data"
        data-url-index="{{route('admin.guide.index')}}">
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
                  placeholder="Tên..."
                  value="{{ $guide->name }}">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Số điên thoại </label><span class="field-required">*</span>
                <input class="form-control" name="phone"
                  id="name"
                  required="required"
                  maxlength="{{config('setting.hotel.length_phone')}}"
                  minlength="{{config('setting.hotel.length_phone')}}"
                  placeholder="Số điên thoại..."
                  value="{{ $guide->phone }}">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <div class="form-group group-selectbox">
                  <label>Chọn khu vực </label><span class="field-required">*</span>
                    <select
                      name="category_id"
                      class="form-control selectpicker"
                      data-live-search="true"
                      multiple
                      require="required"
                      data-max-options="1"
                      title="Select a category">
                      @foreach ($subCategories as $category)
                        @if ($guide->category_id == $category->id)
                          <option selected="true" value="{{$category->id}}">{{ $category->name }}</option>
                        @else
                          <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  <span class="text-danger category_id" role="alert"></span>
                </div>
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
                  placeholder="Địa chỉ..."
                  maxlength="{{config('setting.hotel.maxlength_address')}}"
                  minlength="{{config('setting.hotel.minlength_name')}}"
                  value="{{ $guide->address }}"
                  required="required">
                  <span class="text-danger place-error" role="alert"></span>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Email </label><span class="field-required">*</span>
                <input class="form-control" name="mail"
                  id="name"
                  readonly="readonly"
                  minlength="{{config('setting.guide.length_phone')}}"
                  placeholder="Email..."
                  value="{{ $guide->mail }}">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
          </div>
        </div>

        <div id="submit-form">
          <p class="btn-danger btn" data-url="{{ route('admin.guide.index') }}"
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
  {{ Html::style('css/bootstrap-select.min.css') }}
  {{ Html::style('css/select2.min.css') }}
@endsection
@section('scripts')
  {{ Html::script('templates/admin/js/guide.js') }}
  {{ Html::script('js/dropzone.js') }}
  {{ Html::script('js/bootstrap-select.min.js') }}
  {{ Html::script('js/select2.min.js') }}
@endsection
