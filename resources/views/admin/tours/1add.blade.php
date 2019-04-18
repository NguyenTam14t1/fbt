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
                <input class="form-control" name="name"
                  id="name"
                  required="required" 
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
                  data-live-search="true"
                  multiple
                  required="required"
                  data-max-options="1"
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
                      data-live-search="true"
                      multiple
                      required="required"
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
                      data-live-search="true"
                      multiple
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
                    <label>@lang('admin/tour.form.publish.start')</label><span class="field-required">*</span>
                    <div class="input-group date" id="publish_start_date">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      <input type="text"
                        name="publish_start_date"
                        class="form-control pull-right"
                        required="required"
                        placeholder="YYYY-MM-DD HH:mm"
                        autocomplete="off"
                        value="">
                    </div>
                    <span class="text-danger publish_start_date" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>@lang('admin/tour.form.publish.end')</label><span class="field-required">*</span>
                    <div class="input-group date" id="publish_end_date">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      <input type="text"
                        name="publish_end_date"
                        class="form-control pull-right"
                        placeholder="YYYY-MM-DD HH:mm"
                        autocomplete="off"
                        required="required"
                        value="">
                    </div>
                    <span class="text-danger publish_end_date" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">@lang('admin/tour.label.participants_min')</label><span class="field-required">*</span>
                    <div class="input-group date" id="participants_min">
                      <span class="input-group-addon">
                        <span class="fa fa-male"></span>
                      </span>
                      <input type="number"
                        name="participants_min"
                        class="form-control pull-right"
                        required="required|digits|range: [1, 1000]"
                        placeholder="Participants min"
                        value="1">
                    </div>
                    <span class="text-danger participants_min" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">@lang('admin/tour.label.participants_max')</label><span class="field-required">*</span>
                    <div class="input-group date" id="participants_max">
                      <span class="input-group-addon">
                        <span class="fa fa-child"></span>
                      </span>
                      <input type="number"
                        name="participants_max"
                        class="form-control pull-right"
                        required="required|digits|range: [1, 1000]"
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

        <div class="box-body">
          <div class="panel-body" id="add-active-date">
            <label style="margin-left: 15px;" for="add-active-date">Program detail
            <div id="active_date">
            </div>
            
            <div class="row">
              <div class="col-sm-5 nopadding">
                <div class="form-group">
                  <label for="day-active-date">Time: </label><span class="field-required">*</span>
                  <div class="input-group date day_active_date">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input type="text"
                      name="activity_dates[time][]"
                      class="form-control pull-right day_active_date"
                      placeholder="YYYY-MM-DD"
                      autocomplete="off"
                      required="required"
                      value="">
                  </div>
                  <span class="text-danger day_active_date" role="alert"></span>
                </div>
                <div class="form-group">
                  <label for="title-active-date">Title: </label><span class="field-required">*</span>
                  <div class="input-group date">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-book"></span>
                    </span>
                    <input type="text"
                      name="activity_dates[title][]"
                      class="form-control pull-right title-active-date"
                      placeholder="Title"
                      required="required"
                      value="">
                  </div>
                  <span class="text-danger title_active_date" role="alert"></span>
                </div>
              </div>
              <div class="col-sm-6 nopadding">
                <div class="form-group">
                  <label for="content-active-date">Detail: </label><span class="field-required">*</span>
                  <div>
                    <textarea type="text" required="required" class="form-control" rows="7" class="content-active-date" name="activity_dates[content][]" placeholder="Content activity date"></textarea>
                  </div>
                  <span class="text-danger content_active_date" role="alert"></span>
                </div>
              </div>
                
              <div class="col-sm-1 nopadding">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button class="btn btn-success" type="button"  onclick="active_date();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clear"></div>
          </div>
        </div>
        <div id="submit-form">
          <p class="btn-danger btn" data-url="{{ route('admin.tour.index') }}"
            data-toggle="modal" data-target="#modal-default">@lang('admin/tour.cancel')</p>
          <input type="submit" class="btn btn-primary" value="@lang('admin/tour.submit')">
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

<script type="text/javascript">
  var step = 1;
    function active_date() {
      step++;
      var objTo = document.getElementById('active_date')
      var divtest = document.createElement("div");
      divtest.setAttribute("class", "form-group row panel-body removeclass" + step);
      var rdiv = 'removeclass' + step;
      divtest.innerHTML =  `<div class="col-sm-5 nopadding">
                              <div class="form-group">
                                <label for="day-active-date">Time: </label><span class="field-required">*</span>
                                <div class="input-group date day_active_date">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                  <input type="text"
                                    name="activity_dates[time][]"
                                    class="form-control pull-right day_active_date"
                                    placeholder="YYYY-MM-DD"
                                    autocomplete="off"
                                    required="required"
                                    value="">
                                </div>
                                <span class="text-danger day_active_date" role="alert"></span>
                              </div>
                              <div class="form-group">
                                <label for="title-active-date">Title: </label><span class="field-required">*</span>
                                <div class="input-group date">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-book"></span>
                                  </span>
                                  <input type="text"
                                    name="activity_dates[title][]"
                                    class="form-control pull-right title-active-date"
                                    required="required"
                                    placeholder="Title"
                                    value="">
                                </div>
                                <span class="text-danger title_active_date" role="alert"></span>
                              </div>
                            </div>
                            <div class="col-sm-6 nopadding">
                              <div class="form-group">
                                <label for="content-active-date">Detail: </label><span class="field-required">*</span>
                                <div>
                                  <textarea type="text" class="form-control" rows="7"  required="required" class="content-active-date" name="activity_dates[content][]" placeholder="Content activity date"></textarea>
                                </div>
                                <span class="text-danger content_active_date" role="alert"></span>
                              </div>
                            </div>
                              
                            <div class="col-sm-1 nopadding">
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-btn">
                                    <button class="btn btn-danger" type="button" onclick="remove_active_date(${step});"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                            
                          <div class="clear"></div>`;
      
      objTo.appendChild(divtest)
  }
  function remove_active_date(rid) {
    $('.removeclass'+rid).remove();
  }

  $('.day_active_date input').datetimepicker({
      format: 'YYYY-MM-DD HH:mm',
      useCurrent: false,
      minDate: moment().format('YYYY-MM-DD'),
      defaultDate: moment(),
      showClear: true
  })
</script>

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
