@extends ('widgets.admin.master')

@section('content')
    <div class="col-sm-12">
        @if (Session::has('success_msg'))
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">@lang('lang.success')</span> {{ Session::get('success_msg') }}
                {{ Form::button('<span aria-hidden="true">×</span>', ['class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']) }}
            </div>
        @endif
        @if (Session::has('error_msg'))
            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-danger">@lang('lang.failed')</span> {{ Session::get('error_msg') }}
                {{ Form::button('<span aria-hidden="true">×</span>', ['class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']) }}
            </div>
        @endif
    </div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">@lang('lang.data_table')</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="bootstrap-data-table_length">
                                        {!! html_entity_decode(Html::link(route('admin.tour.create'), '<i class="fa fa-plus"></i> ' . trans('lang.new'), ['class' => 'btn btn-secondary add-btn'])) !!}
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 search-group">
                                    <div class="search-input">
                                        {{ Form::text('search-input', '', ['class' => 'form-control form-control-sm' , 'aria-controls' => 'bootstrap-data-table', 'placeholder' => trans('lang.search')]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="responsive-table">
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
                                            <th width="20%">@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                                    {{ Html::image($tour->picture_path, 'tour-img', ['class' => 'img-tour-show']) }}
                                                </td>
                                                <td class="center">{{ $tour->participants_max }}</td>
                                                <td class="center">
                                                    {{ Form::open(['method' => 'GET', 'class' => 'button-form']) }}
                                                        {{ Form::button('<i class="fa fa-pencil"></i> ' . 'Edit', ['type' => 'submit', 'class' => 'btn btn-info']) }}
                                                    {{ Form::close() }}
                                                    {{ Form::open(['class' => 'button-form']) }}
                                                        {{ method_field('DELETE') }}
                                                        {{ Form::button('<i class="fa fa-trash"></i> ' . 'Del', ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'btn btn-danger']) }}
                                                    {{ Form::close() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination-group">
                                {{ $tours->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
