@extends ('widgets.admin.master')

@section('title')
    @lang('admin/tour.title_index')
@endsection

@section('content')
    <section class="content-header">
        <h1>
            @lang('admin/tour.title_index')
        </h1>
    </section>
    <section class="content form-switch tour-list">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{ route('admin.tour.create') }}" class="btn btn-primary pull-right mr-5" >
                            <i class="fa fa-plus"></i> @lang('admin/global.btn.new')
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="box-body table-responsive pd-t-10">
                                <div class="col-md-12" >
                                    <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="4%">
                                                    {{ Form::checkbox('checkbox', '', false, ['class' => 'check checkbox-input user-check']) }}
                                                </th>
                                                <th width="4%">@lang('lang.stt')</th>
                                                <th width="20%">@lang('lang.name')</th>
                                                <th width="24%">@lang('lang.time')</th>
                                                <th width="7%">@lang('lang.price')</th>
                                                <th width="12%">@lang('lang.picture')</th>
                                                <th width="7%">@lang('lang.participants')</th>
                                                <th width="20%" class="text-center">@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($tours))
                                                @foreach ($tours as $tour)
                                                    <tr>
                                                        <td class="center">
                                                            {{ Form::checkbox('checkbox', '', false, ['class' => 'check checkbox-input user-check']) }}
                                                        </td>
                                                        <td class="center">{{ $loop->iteration }}</td>
                                                        <td>{{ $tour->name }}</td>
                                                        <td class="center">{{ $tour->time_start_format . ' - ' . $tour->time_finish_format }}</td>
                                                        <td class="center">${{ $tour->price }}</td>
                                                        <td class="center">
                                                            <img src="{{ $tour->picture_path }}" width="90px" height="50px" class="mr-5 img-tour-show" alt="{{ $tour->name }}"></a>
                                                        </td>
                                                        <td class="center">{{ $tour->participants_max }}</td>
                                                        <td class="text-center">
                                                            <a style="margin-right: 15px;"
                                                                class="btn btn-primary" href="{{ route('admin.tour.edit', $tour->id) }}">
                                                                <i class="fa fa-pencil-square-o fa fa-lg"></i>
                                                            </a>
                                                            <button class="btn btn-danger delete-tour-trigger"
                                                                type="submit"
                                                                data-url-delete="{{ route('admin.tour.destroy', $tour->id) }}"
                                                                data-tour-id="{{ $tour->id }}"><i class="fa fa-trash-o fa-fw" ></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8">@lang('global.notice.result_empty')</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form class="col-md-2 delete-tour-form"
            name="delete_tour_form"
            method="POST"
            action="{{ route('admin.tour.destroy', 1) }}">
            @method('DELETE')
            {{ csrf_field() }}
        </form>
        <div id="message-data"
            data-mess-confirm="{{ json_encode(trans('admin/global.message.confirm')) }}"
            data-lang-datatable="{{ json_encode(trans('admin/global.datatable')) }}"
        ></div>
        @component('widgets.admin.modal')
            @slot('class')
                danger
            @endslot
            @slot('headerText')
                @lang('admin/news.message.confirm_delete')
            @endslot
        @endcomponent
    </section>
@endsection
@section('scripts')
    {{ Html::script('templates/admin/js/tour.js') }}
@endsection
