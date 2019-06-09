@extends('widgets.admin.master')
@section('title', 'Chỉnh sửa tour')
@section('content')
  <section class="content-header">
    <h1>
      Chỉnh sửa tour
    </h1>
  </section>
  <section class="content add-tour check-edit-tour">
    <div class="box box-primary">
      <form role="form"
        id="edit-tour"
        action="{{route('admin.tour.update', ['tour' => $tour->id])}}"
        method="POST"
        enctype="multipart/form-data"
        data-url-index="{{route('admin.tour.index')}}">
        @csrf
        {{ method_field('PATCH') }}
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Tiêu đề </label><span class="field-required">*</span>
                <input class="form-control" name="name"
                  id="name"
                  required="required"
                  maxlength="{{config('setting.tour.maxlength_name')}}"
                  minlength="{{config('setting.tour.minlength_name')}}"
                  placeholder="Tiêu đề..."
                  value="{{ $tour->name }}">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="place">Địa điểm </label><span class="field-required">*</span>
                <input class="form-control" name="place"
                  id="place"
                  placeholder="Địa điểm..."
                  maxlength="{{config('setting.tour.maxlength_name')}}"
                  minlength="{{config('setting.tour.minlength_name')}}"
                  value="{{ $tour->place }}"
                  required="required">
                  <span class="text-danger place-error" role="alert"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4" id="thumbnail">
              <p for="thumbnail">Hình ảnhDanh mục </p>
              <div class="input-group">
                <label class="input-group-btn">
                  <span class="btn btn-primary">
                    Hình ảnhDanh mục
                    <input type="file" style="display: none;" accept="image/jpeg,image/jpg,image/png" id="file-img-thumbnail">
                  </span>
                </label>
                <input type="text" class="form-control" name='name_thumbnail' readonly="" value="{{ $tour->name_thumbnail }}">
                <label class="input-group-btn clear-file"><span class="btn btn-default">X</span></label>
              </div>
              <div class="row">
                <img id="preview-thumbnail"
                  class="img-responsive"
                  src="{{ $tour->picture_path }}">
              </div>
              <span class="text-danger thumbnail-mes" role="alert"></span>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group group-selectbox">
                    <label>Danh mục </label><span class="field-required">*</span>
                      <select
                        name="category_id"
                        class="form-control selectpicker"
                        data-live-search="true"
                        multiple
                        require="required"
                        data-max-options="1"
                        title="Chọn danh mục">
                        @foreach ($subCategories as $category)
                          @if ($tour->category_id == $category->id)
                            <option selected="true" value="{{$category->id}}">{{ $category->name }}</option>
                          @else
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                          @endif
                        @endforeach
                      </select>
                    <span class="text-danger category_id" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group group-selectbox">
                    <label>Khách sạn </label>
                      <select
                        name="hotel_id[]"
                        class="form-control selectpicker"
                        data-live-search="true"
                        multiple
                        title="Chọn khách sạn theo tên hoặc thành phố">
                        @php
                          $tourHotels = $tour->hotels->pluck('id')->all();
                        @endphp
                        @foreach ($hotels as $hotel)
                            @if (in_array($hotel->id, $tourHotels))
                              <option selected="true" value="{{$hotel->id}}" data-tokens="{{ $hotel->address }}">{{ $hotel->name }}</option>
                            @else
                              <option value="{{$hotel->id}}" data-tokens="{{ $hotel->address }}">{{ $hotel->name }}</option>
                            @endif
                        @endforeach
                      </select>
                    <span class="text-danger hotel_id" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group group-selectbox">
                    <label>Hướng dẫn viên </label><span class="field-required">*</span>
                      <select
                        name="guide_id[]"
                        class="form-control selectpicker"
                        data-live-search="true"
                        multiple
                        required="required"
                        title="Chọn Hướng dẫn viên">
                        @php
                          $tourGuides = $tour->guides->pluck('id')->all();
                        @endphp
                        @foreach ($guides as $guide)
                            @if (in_array($guide->id, $tourGuides))
                              <option selected="true" value="{{$guide->id}}">{{ $guide->name }}</option>
                            @else
                              <option value="{{$guide->id}}">{{ $guide->name }}</option>
                            @endif
                        @endforeach
                      </select>
                    <span class="text-danger guide_id" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">Giá </label><span class="field-required">*</span>
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
                        placeholder="Giá"
                        value="{{ $tour->price }}">
                    </div>
                    <span class="text-danger price" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Thời gian bắt đầu </label><span class="field-required">*</span>
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
                        data-val="{{ $tour->time_start }}"
                        value="">
                    </div>
                    <span class="text-danger time_start" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Thời gian kết thúc </label><span class="field-required">*</span>
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
                        data-val="{{ $tour->time_finish }}"
                        value="">
                    </div>
                    <span class="text-danger time_finish" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">Số người tối thiểu </label><span class="field-required">*</span>
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
                        value="{{ $tour->participants_min }}">
                    </div>
                    <span class="text-danger participants_min" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">Số người tối đa </label><span class="field-required">*</span>
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
                        value="{{ $tour->participants_max }}">
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
                <label for="name">Nội dung </label><span class="field-required">*</span>
                <div id="tab-quill">
                  <div id="content-quill">
                  </div>
                </div>
                <span class="text-danger description-mes-error" role="alert"></span><br>
              </div>
            </div>
          </div>
        </div>
        <textarea id="content-tour" name="description" style="display: none;">{{ $tour->description }}</textarea>

        <div class="box-body">
          <div class="panel-body" id="edit-active-date">
            <label style="margin-left: 15px; display: none" id="label-detail-progam" for="edit-active-date">Chi tiết lịch trình
            <div id="active_date" data-total-date="{{ $tour->activityDates->count() }}">
              @if (isset($tour->activityDates))
                @foreach ($tour->activityDates as $activeDate)
                  <div id="active-{{ $loop->index }}">
                    <div class="col-sm-5 nopadding">
                      <div class="form-group">
                        <input type="text"
                          name="id" class="hide"
                          id="active-date-id-{{ $loop->index }}" value="{{ $activeDate->id }}">
                        <label for="day-active-date">Thời gian</label>
                        <input type="text"
                          name="activity_dates[time][]"
                          readonly
                          maxlength="350"
                          id="time-{{ $loop->index }}"
                          class="form-control pull-right time-active-date"
                          value="{{ $activeDate->time }}">
                      </div>
                      <div class="form-group">
                        <label for="title-active-date">Chủ đề: </label><span class="field-required">*</span>
                        <div class="input-group date">
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-book"></span>
                          </span>
                          <input type="text"
                            name="activity_dates[title][]"
                            required="required"
                            maxlength="{{config('setting.tour.maxlength_name')}}"
                            class="form-control pull-right title-active-date"
                            placeholder="Chủ đề"
                            id="title-{{ $loop->index }}"
                            value="{{ $activeDate->title }}">
                        </div>
                        <span class="text-danger title_active_date" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-7 nopadding">
                      <div class="form-group">
                        <label for="content-active-date">Chi tiết: </label><span class="field-required">*</span>
                        <div>
                          <textarea type="text"
                            class="form-control content-active-date" rows="7"
                            required="required"
                            maxlength="{{config('setting.tour.maxlength_description')}}"
                            id="detail-{{ $loop->index }}"
                            name="activity_dates[detail][]" placeholder="Hoạt động trong ngày ">{{ $activeDate->detail }}</textarea>
                        </div>
                        <span class="text-danger content_active_date" role="alert"></span>
                      </div>
                    </div>
                  </div>
                @endforeach
              @endif
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
      data-trans="Mô tả cho tour"
      style="display: none">
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
