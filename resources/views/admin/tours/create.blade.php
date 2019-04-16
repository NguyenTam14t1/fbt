@extends('widgets.admin.master')
@section('title', trans('admin/tour.title.create'))
@section('content')
  <section class="content-header">
    <h1>
      @lang('admin/tour.header.add')
    </h1>
  </section>
  <section class="content add-tour check-add-tour">
    <div class="box box-primary">
      <form role="form" id="add-tour"
        action="{{route('admin.tour.store')}}"
        method="POST"
        enctype="multipart/form-data"
        data-url-index="{{route('admin.tour.index')}}">
        @csrf
        <input type="number" name="time_zone_browser" value="" style="display: none;">
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="name">@lang('admin/tour.form.name.label')</label><span class="field-required">*</span>
                <input class="form-control" name="name" id="name"
                  placeholder="@lang('admin/tour.form.name.placeholder')"
                  maxlength="{{config('setting.tour.maxlength_name')}}"
                  value="">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group group-selectbox">
                <label>@lang('admin/tour.form.category')</label><span class="field-required">*</span>
                <select
                  name="category_id[]"
                  class="form-control selectpicker"
                  data-live-search="true" multiple
                  title="@lang('admin/tour.form.none')">
                  @foreach ($subCategories as $category)
                      <option value="{{$category->id}}">{{ $category->name }}</option>
                  @endforeach
                </select>
                <span class="text-danger category_id" role="alert"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4" id="thumbnail">
              <p for="thumbnail">@lang('admin/tour.form.thumbnail')</p>
              <div class="input-group">
                <label class="input-group-btn">
                  <span class="btn btn-primary">
                    @lang('admin/tour.form.browse')
                    <input type="file" style="display: none;" name="thumbnail" accept="image/jpeg,image/jpg,image/png" id="file-img-thumbnail">
                  </span>
                </label>
                <input type="text" class="form-control" readonly="">
              </div>
              <div class="row">
                <img id="preview-thumbnail" class="img-responsive">
              </div>
              <span class="text-danger thumbnail-mes" role="alert"></span>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group group-selectbox">
                    <label>@lang('admin/tour.form.guide')</label><span class="field-required">*</span>
                    <select
                      name="guide_id[]"
                      class="form-control selectpicker"
                      data-live-search="true" multiple
                      title="@lang('admin/tour.form.none')">
                      @foreach ($guides as $guide)
                          <option value="{{$guide->id}}">{{ $guide->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger guide_id" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group group-selectbox">
                    <label>@lang('admin/tour.form.hotel')</label>
                    <select
                      name="hotel_id[]"
                      class="form-control selectpicker"
                      data-live-search="true" multiple
                      title="@lang('admin/tour.form.none')">
                      @foreach ($hotels as $hotel)
                          <option value="{{$hotel->id}}">{{ $hotel->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger hotel_id" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>@lang('admin/tour.form.publish.start')</label>
                    <div class="input-group date" id="publish_start_date">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      <input type="text"
                        name="publish_start_date"
                        class="form-control pull-right"
                        placeholder="YYYY-MM-DD HH:mm"
                        autocomplete="off"
                        value="">
                    </div>
                    <span class="text-danger publish_start_date" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>@lang('admin/tour.form.publish.end')</label>
                    <div class="input-group date" id="publish_end_date">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      <input type="text"
                        name="publish_end_date"
                        class="form-control pull-right"
                        placeholder="YYYY-MM-DD HH:mm"
                        autocomplete="off"
                        value="">
                    </div>
                    <span class="text-danger publish_end_date" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">@lang('admin/tour.label.participants_min')</label>
                    <div class="input-group date" id="participants_min">
                      <span class="input-group-addon">
                        <span class="fa fa-male"></span>
                      </span>
                      <input type="number"
                        name="participants_min"
                        class="form-control pull-right"
                        placeholder="Participants min"
                        value="0">
                    </div>
                    <span class="text-danger participants_min" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">@lang('admin/tour.label.participants_max')</label>
                    <div class="input-group date" id="participants_max">
                      <span class="input-group-addon">
                        <span class="fa fa-child"></span>
                      </span>
                      <input type="number"
                        name="participants_max"
                        class="form-control pull-right"
                        placeholder="Participants max"
                        value="0">
                    </div>
                    <span class="text-danger participants_max" role="alert"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group name">
                <label for="name">@lang('admin/tour.form.content')</label><span class="field-required">*</span>
                <div id="tab-quill">
                  <div id="content-quill">
                  </div>
                </div>
                <span class="text-danger content-mes-error" role="alert"></span><br>
              </div>
            </div>
          </div>
        </div>
        <textarea id="content-tour" name="content" style="display: none;"></textarea>
        <div id="submit-form">
          <p class="btn-danger btn" data-url="{{ route('admin.tour.index') }}"
            data-toggle="modal" data-target="#modal-default">@lang('admin/tour.cancel')</p>
          <input type="submit" class="btn btn-primary" value="@lang('admin/tour.submit')">
        </div>
      </form>
      <div
        id="dataFromServer"
        data-trans="{{json_encode(trans('admin/tour.quill'))}}"
        style="display: none">
        </div>
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
  {{ Html::style('templates/admin/css/tour.css') }}
  {{ Html::style('css/bootstrap-datetimepicker.css') }}
  {{ Html::style('css/dropzone.css') }}
  {{ Html::style('css/quill.snow.css') }}
  {{ Html::style('css/bootstrap-select.min.css') }}
  {{ Html::style('css/select2.min.css') }}
@endsection
@section('scripts')
  {{ Html::script('js/moment.js') }}
  {{ Html::script('js/bootstrap-datetimepicker.min.js') }}
  {{ Html::script('js/dropzone.js') }}
  {{ Html::script('js/screenfull.js') }}
  {{ Html::script('js/quill.min.js') }}
  {{ Html::script('js/image-resize.min.js') }}
  {{ Html::script('js/bootstrap-select.min.js') }}
  {{ Html::script('js/select2.min.js') }}
  {{ Html::script('templates/admin/js/tour.js') }}
@endsection
