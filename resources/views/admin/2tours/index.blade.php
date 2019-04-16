@extends('admin.layouts.master')
@section('title', trans('admin/lesson.title.list'))
@section('content')
    <section class="content-header">
        <h1>
        @lang('admin/lesson.header.list')
        </h1>
    </section>
    <section class="content lesson-list">
        <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="input-group search_lesson">
                            <input type="search" class="form-control" placeholder="@lang('admin/lesson.search.placeholder')">
                            <span class="input-group-addon">@lang('admin/lesson.search.label')</span>
                        </div>
                    </div>
                    <div class="col-md-2 toggle-advanced-search">
                        <a href="#">@lang('admin/lesson.advanced-search')</a>
                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </div>
                    <form class="col-md-1 pull-right" method="GET" action="{{ route('admin.lesson.create') }}">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> @lang('admin/global.btn.new') </button>
                    </form>
                </div>
                <div class="wrap-advanced-search">
                    <div class="row search-advanced">
                        <div class="col-md-5 category-search col-md-offset-1">
                            <div class="input-group">
                                <label>@lang('admin/lesson.form.category')</label>
                                <select
                                    class="form-control advanced-select-search"
                                    multiple="multiple">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 tag-search">
                            <div class="input-group">
                                <label>@lang('admin/lesson.form.tag')</label>
                                <select
                                    class="form-control advanced-select-search"
                                    multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row search-advanced">
                        <div class="col-md-5 teacher-search col-md-offset-1">
                            <div class="input-group">
                                <label>@lang('admin/lesson.form.teacher')</label>
                                <select
                                    class="form-control advanced-select-search"
                                    multiple="multiple">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-list">
                    <thead>
                        <tr>
                            <th>@lang('admin/lesson.form.name.label')</th>
                            <th>@lang('admin/lesson.table.teacher')</th>
                            <th>@lang('admin/lesson.table.category')</th>
                            <th>@lang('admin/lesson.table.public_date')</th>
                            <th>@lang('admin/lesson.table.unpublic_date')</th>
                            <th>@lang('admin/lesson.table.level')</th>
                            <th>@lang('admin/global.label.action')</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            {{ Form::open(['route' => ['admin.lesson.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-lesson-form', 'class' => 'form-horizontal', 'files' => true]) }}
                {{ method_field('DELETE') }}
            {{ Form::close() }}
            <!-- /.box -->
            <div id="message-data"
                data-mess-confirm="{{ json_encode(trans('admin/global.message')) }}"
                data-mess-action="{{ json_encode(trans('admin/global.label')) }}"
                data-lang-datatable="{{ json_encode(trans('admin/global.datatable')) }}"
                data-url-edit = "{{route('admin.lesson.edit', 'ID_REPLY_IN_URL')}}"
                data-url-delete = "{{route('admin.lesson.destroy', 'ID_REPLY_IN_URL')}}"
                data-url-dataTable = "{{ route('admin.lesson.lessonList') }}">
            </div>
        </div>
        @component('admin.layouts.modal')
            @slot('class')
                danger
            @endslot
            @slot('headerText')
                @lang('admin/global.message.confirm')
            @endslot
        @endcomponent
    </section>
@endsection

@section('styles')
    {{ Html::style('css/lesson.css') }}
    {{ Html::style('css/select2.min.css') }}
@endsection

@section('scripts')
    {{ Html::script('js/moment.js') }}
    {{ Html::script('js/bootstrap-datetimepicker.min.js') }}
    {{ Html::script('js/dropzone.js') }}
    {{ Html::script('js/bootstrap-select.min.js') }}
    {{ Html::script('js/select2.min.js') }}
    @if (env('APP_LANG') == 'ja')
        {{ Html::script('js/ja.js') }}
    @endif
    {{ Html::script('admin/js/lesson.js') }}
@endsection
