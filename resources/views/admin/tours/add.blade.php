@extends('widgets.admin.master')
@section('title', 'Add tour')
@section('content')
  <section class="content-header">
    <h1>
      Add tour
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
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Title </label><span class="field-required">*</span>
                <input class="form-control" name="name"
                  id="name"
                  required="required"
                  maxlength="{{config('setting.tour.maxlength_name')}}"
                  minlength="{{config('setting.tour.minlength_name')}}"
                  placeholder="Title..."
                  value="">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="place">Place </label><span class="field-required">*</span>
                <input class="form-control" name="place"
                  id="place"
                  placeholder="Place..."
                  maxlength="{{config('setting.tour.maxlength_name')}}"
                  minlength="{{config('setting.tour.minlength_name')}}"
                  value=""
                  required="required">
                  <span class="text-danger place-error" role="alert"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4" id="thumbnail">
              <p for="thumbnail">Thumbnail </p>
              <div class="input-group">
                <label class="input-group-btn">
                  <span class="btn btn-primary">
                    Image
                    <input type="file" style="display: none;" accept="image/jpeg,image/jpg,image/png" id="file-img-thumbnail">
                  </span>
                </label>
                <input type="text" class="form-control" name='name_thumbnail' readonly="">
                <label class="input-group-btn clear-file"><span class="btn btn-default">X</span></label>
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
                    <label>Category </label><span class="field-required">*</span>
                      <select
                        name="category_id"
                        class="form-control selectpicker"
                        data-live-search="true"
                        multiple
                        require="required"
                        data-max-options="1"
                        title="Select a category">
                        @foreach ($subCategories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    <span class="text-danger category_id" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group group-selectbox">
                    <label>Hotel </label>
                      <select
                        name="hotel_id[]"
                        class="form-control selectpicker"
                        data-live-search="true"
                        multiple
                        title="Select hotel">
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
                  <div class="form-group group-selectbox">
                    <label>Guide </label><span class="field-required">*</span>
                      <select
                        name="guide_id[]"
                        class="form-control selectpicker"
                        data-live-search="true"
                        multiple
                        required="required"
                        title="Select guide">
                        @foreach ($guides as $guide)
                            <option value="{{$guide->id}}">{{ $guide->name }}</option>
                        @endforeach
                      </select>
                    <span class="text-danger guide_id" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">Price </label><span class="field-required">*</span>
                    <div class="input-group date" id="price">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-usd"></span>
                      </span>
                      <input type="number"
                        name="price"
                        min="{{config('setting.tour.min_price')}}"
                        max="{{config('setting.tour.max_price')}}"
                        required="required"
                        class="form-control pull-right"
                        placeholder="Price"
                        value="">
                    </div>
                    <span class="text-danger price" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Time start </label><span class="field-required">*</span>
                    <div class="input-group date" id="time_start">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      <input type="text"
                        name="time_start"
                        required="required"
                        class="form-control pull-right"
                        placeholder="YYYY-MM-DD"
                        autocomplete="off"
                        value="">
                    </div>
                    <span class="text-danger time_start" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Time finish </label><span class="field-required">*</span>
                    <div class="input-group date" id="time_finish">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      <input type="text"
                        name="time_finish"
                        required="required"
                        class="form-control pull-right"
                        placeholder="YYYY-MM-DD"
                        autocomplete="off"
                        value="">
                    </div>
                    <span class="text-danger time_finish" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">Participants min </label><span class="field-required">*</span>
                    <div class="input-group date" id="participants_min">
                      <span class="input-group-addon">
                        <span class="fa fa-male"></span>
                      </span>
                      <input type="number"
                        name="participants_min"
                        required="required"
                        min="{{config('setting.tour.min_guess')}}"
                        max="{{config('setting.tour.max_guess')}}"
                        class="form-control pull-right"
                        placeholder="Participants min"
                        value="1">
                    </div>
                    <span class="text-danger participants_min" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">Participants max </label><span class="field-required">*</span>
                    <div class="input-group date" id="participants_max">
                      <span class="input-group-addon">
                        <span class="fa fa-child"></span>
                      </span>
                      <input type="number"
                        name="participants_max"
                        required="required"
                        min="{{config('setting.tour.min_guess')}}"
                        max="{{config('setting.tour.max_guess')}}"
                        class="form-control pull-right"
                        placeholder="Participants max"
                        value="1">
                    </div>
                    <span class="text-danger participants_max" role="alert"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group name">
                <label for="name">Content </label><span class="field-required">*</span>
                <div id="tab-quill">
                  <div id="content-quill">
                  </div>
                </div>
                <span class="text-danger description-mes-error" role="alert"></span><br>
              </div>
            </div>
          </div>
        </div>
        <textarea id="content-tour" name="description" style="display: none;"></textarea>

        <div class="box-body">
          <div class="panel-body" id="add-active-date">
            <label style="margin-left: 15px; display: none" id="label-detail-progam" for="add-active-date">Program detail
            <div id="active_date" data-total-date="0">
            </div>

            <div class="clear"></div>
          </div>
        </div>
        <div id="submit-form">
          <p class="btn-danger btn" data-url="{{ route('admin.tour.index') }}"
            data-toggle="modal" data-target="#modal-default">@lang('admin/global.btn.cancel')</p>
          <input type="submit" class="btn btn-primary" value="@lang('admin/global.btn.submit')">
        </div>
      </form>
    </div>
      <div
        id="dataFromServer"
        data-trans="{{json_encode('Description for tour')}}"
        style="display: none">
        </div>
    </div>
    <div class="progress-upload-form" style="display: none;"><span>0%</span></div>
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
  {{ Html::style('templates/admin/css/tour.css') }}
@endsection
@section('scripts')
  {{ Html::script('templates/admin/js/tour.js') }}
  {{ Html::script('js/moment.js') }}
  {{ Html::script('js/bootstrap-datetimepicker.min.js') }}
  {{ Html::script('js/dropzone.js') }}
  {{ Html::script('js/screenfull.js') }}
  {{ Html::script('js/quill.min.js') }}
  {{ Html::script('js/image-resize.min.js') }}
  {{ Html::script('js/bootstrap-select.min.js') }}
  {{ Html::script('js/select2.min.js') }}
@endsection
