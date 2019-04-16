@extends('admin.layouts.master')
@section('title', trans('admin/lesson.title.create'))
@section('content')
  <section class="content-header">
    <h1>
      @lang('admin/lesson.header.add')
    </h1>
  </section>
  <section class="content add-lesson check-add-lesson">
    <div class="box box-primary">
      <form role="form" id="add-lesson"
        action="{{route('admin.lesson.store')}}"
        method="POST"
        enctype="multipart/form-data"
        data-url-index="{{route_g('lesson.index')}}">
        @csrf
        <input type="number" name="time_zone_browser" value="" style="display: none;">
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="name">@lang('admin/lesson.form.name.label')</label><span class="field-required">*</span>
                <input class="form-control" name="name" id="name"
                  placeholder="@lang('admin/lesson.form.name.placeholder')"
                  maxlength="{{config('setting.lesson.maxlength_name')}}"
                  value="">
                  <span class="text-danger name-error" role="alert"></span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group group-selectbox">
                <label>@lang('admin/lesson.form.group')</label>
                <select
                  name="group_id[]"
                  class="form-control selectpicker"
                  data-live-search="true" multiple
                  title="@lang('admin/lesson.form.none')">
                  @foreach ($groups as $group)
                      <option value="{{$group->id}}">{{ $group->name }}</option>
                  @endforeach
                </select>
                <span class="text-danger group_id" role="alert"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4" id="thumbnail">
              <p for="thumbnail">@lang('admin/lesson.form.thumbnail')</p>
              <div class="input-group">
                <label class="input-group-btn">
                  <span class="btn btn-primary">
                    @lang('admin/lesson.form.browse')
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
                  <div class="form-group group-selectbox select-box-main select-box-teacher">
                    <label for="level">@lang('admin/lesson.label.teacher_main')</label><span class="field-required">*</span>
                    <select
                      name="teacher_main"
                      class="form-control selectpicker select-teacher select-teacher-main"
                      data-teacher="main"
                      data-max-options-text="@lang('admin/global.message.max_select_item', ['num' => 1])"
                      data-element-wrap="select-box-main"
                      data-live-search="true"
                      multiple
                      data-max-options="1"
                      title="@lang('admin/lesson.form.none')">
                      @foreach ($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger teacher_main" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="level">@lang('admin/lesson.form.level')</label><span class="field-required">*</span>
                    <select
                      name="level"
                      multiple
                      data-max-options="1"
                      class="form-control selectpicker"
                      title="@lang('admin/lesson.form.none')">
                        <option value="1">★</option>
                        <option value="2">★★</option>
                        <option value="3">★★★</option>
                        <option value="4">★★★★</option>
                        <option value="5">★★★★★</option>
                    </select>
                    <span class="text-danger level" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group group-selectbox select-box-one select-box-teacher">
                    <label for="level">@lang('admin/lesson.label.teacher_one')</label>
                    <select
                      name="teacher_one"
                      class="form-control selectpicker select-teacher select-teacher-one"
                      data-teacher="one"
                      data-max-options-text="@lang('admin/global.message.max_select_item', ['num' => 1])"
                      data-element-wrap="select-box-one"
                      data-live-search="true"
                      multiple
                      data-max-options="1"
                      title="@lang('admin/lesson.form.none')">
                      @foreach ($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger teacher_one" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group group-selectbox">
                    <label >@lang('admin/lesson.form.category')</label>
                    <select
                      name="category_id"
                      class="form-control selectpicker"
                      data-live-search="true"
                      multiple
                      data-max-options="1"
                      title="@lang('admin/lesson.form.none')">
                        @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger category_id" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group group-selectbox select-box-two select-box-teacher">
                    <label for="level">@lang('admin/lesson.label.teacher_two')</label>
                    <select
                      name="teacher_two"
                      class="form-control selectpicker select-teacher select-teacher-two"
                      data-teacher="two"
                      data-max-options-text="@lang('admin/global.message.max_select_item', ['num' => 1])"
                      data-element-wrap="select-box-two"
                      data-live-search="true"
                      data-max-options="1"
                      multiple
                      title="@lang('admin/lesson.form.none')">
                      @foreach ($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger teacher_two" role="alert"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group select2-tag-group">
                    <label for="level">@lang('admin/lesson.form.tag')</label>
                    <select
                      name="tag_id[]"
                      class="form-control tag-select"
                      multiple="multiple">
                        @foreach ($tags as $tag)
                          <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger tag_id" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="wrap-attach-file">
                    <label for="level">@lang('admin/lesson.form.files')</label>
                    <div class="attach-file">
                      @foreach ([1, 2, 3] as $num)
                        <div class="input-group upload-one-file">
                          <label class="input-group-btn">
                            <span class="btn btn-primary">
                              <i class="fa fa-upload" aria-hidden="true"></i>
                              @lang('admin/lesson.form.video_tap.video')
                              <input type="file" style="display: none;"
                                name="attachFiles[{{$num}}]"
                                class="input-video">
                            </span>
                          </label>
                          <input type="text" class="form-control lh-8" readonly="">
                          <i class="fa fa-times-circle" aria-hidden="true"></i>
                        </div>
                        <span class="text-danger attach-file-{{$num}}" role="alert"></span>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>@lang('admin/lesson.form.publish.start')</label>
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
                  <div class="form-group">
                    <label>@lang('admin/lesson.form.publish.end')</label>
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
            </div>
          </div>
          <div class="row wrap-upload-video">
            <div class="col-md-12">
              <div class="form-group">
                <label>@lang('admin/lesson.form.video')</label>
                <div id="tab-video" data-number-add="{{ config('setting.number_image_lesson') }}">
                  @foreach ([1, 2, 3] as $num)
                    <div class="upload-one-file" id="{{$num}}" data-order="{{$num}}" data-video="">
                      <div class="row">
                        <div class="col-md-1 order-video ws-nowrap">
                          <label>@lang('admin/lesson.form.video_tap.order') {{$num}}</label>
                        </div>
                        <div class="col-md-10 video">
                          <div class="input-group">
                            <label class="input-group-btn">
                              <span class="btn btn-primary">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                @lang('admin/lesson.form.video_tap.video')
                                <input type="file" style="display: none;" name="videos[{{$num}}][v]"
                                  accept="video/*" class="input-video">
                                <input
                                  type="text"
                                  class="form-control duration-video"
                                  style="display: none;"
                                  name="durations[{{$num}}]">
                              </span>
                            </label>
                            <input type="text" class="form-control lh-8" readonly="">
                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                          </div>
                          <span class="text-danger video-{{$num}}" role="alert"></span>
                        </div>
                      </div>
                      <div class="video-option">
                        <div class="row">
                          <div class="col-md-1"></div>
                          <div class="col-sm-5 sub-video">
                            <div class="input-group">
                              <label class="input-group-btn">
                                <span class="btn btn-primary">
                                  <i class="fa fa-upload" aria-hidden="true"></i>
                                  @lang('admin/lesson.form.video_tap.sub_video_ja')
                                  <input
                                    type="file" style="display: none;"
                                    name="videos[{{$num}}][ja]"
                                    accept=".srt">
                                </span>
                              </label>
                              <input type="text" class="form-control lh-8" readonly="">
                              <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </div>
                            <span class="text-danger sub-{{$num}}-ja" role="alert"></span>
                          </div>
                          <div class="col-sm-5 thumbnail-video">
                            <div class="input-group thumbnail-of-video">
                              <span class="input-group-addon time-thumbnail">
                                @lang('admin/lesson.form.video_tap.thumbnail')
                              </span>
                              <input type="text"
                                class="form-control lh-8"
                                name="timeThumbnails[{{$num}}]"
                                value="00:00:00" placeholder="00:00:00"
                                autocomplete="off">
                            </div>
                          </div>
                        </div>
                        <div class="row sub-video-two">
                          <div class="col-md-1"></div>
                          <div class="col-sm-5 sub-video">
                            <div class="input-group">
                              <label class="input-group-btn">
                                <span class="btn btn-primary">
                                  <i class="fa fa-upload" aria-hidden="true"></i>
                                  @lang('admin/lesson.form.video_tap.sub_video_en') &nbsp; &nbsp;
                                  <input
                                    type="file" style="display: none;"
                                    name="videos[{{$num}}][en]"
                                    accept=".srt">
                                </span>
                              </label>
                              <input type="text" class="form-control lh-8" readonly="">
                              <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </div>
                            <span class="text-danger sub-{{$num}}-en" role="alert"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group name">
                <label for="name">@lang('admin/lesson.form.content')</label><span class="field-required">*</span>
                <div id="tab-quill">
                  <div id="content-quill">
                  </div>
                </div>
                <span class="text-danger content-mes-error" role="alert"></span><br>
              </div>
            </div>
          </div>
        </div>
        <textarea id="content-lesson" name="content" style="display: none;"></textarea>
        <div id="submit-form">
          <p class="btn-danger btn" data-url="{{ route('admin.lesson.index') }}"
            data-toggle="modal" data-target="#modal-default">@lang('admin/lesson.cancel')</p>
          <input type="submit" class="btn btn-primary" value="@lang('admin/lesson.submit')">
        </div>
      </form>
      <div
        id="dataFromServer"
        data-trans="{{json_encode(trans('admin/lesson.quill'))}}"
        data-url-search-tag="{{ route('admin.tag.search') }}"
        style="display: none">
        </div>
    </div>
    <div class="progress-upload-form" style="display: none;"><span>0%</span></div>
    @component('admin.layouts.modal')
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
  {{ Html::style('css/lesson.css') }}
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
  @if (env('APP_LANG') == 'ja')
    {{ Html::script('js/ja.js') }}
  @endif
  {{ Html::script('js/defaults-ja_JP.min.js') }}
  {{ Html::script('admin/js/lesson.js') }}
@endsection
