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
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">@lang('lang.data_table')</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-2">
                                    <div class="dataTables_length" id="bootstrap-data-table_length">
                                        {!! html_entity_decode(Html::link('#', '<i class="fa fa-plus"></i> ' . trans('lang.new'), ['class' => 'btn btn-secondary add-btn'])) !!}
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <div class="dataTables_length" id="bootstrap-data-table_length">
                                        {!! html_entity_decode(Html::link('#', '<i class="fa fa-plus"></i> ' . trans('lang.del'), ['class' => 'btn btn-secondary add-btn'])) !!}
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <div class="dataTables_length" id="bootstrap-data-table_length">
                                        {!! html_entity_decode(Html::link('#', '<i class="fa fa-download"></i> ' . trans('lang.export'), ['class' => 'btn btn-secondary add-btn dropdown-toggle', 'data-toggle' => 'dropdown'])) !!}
                                        <ul class="dropdown-menu export-menu">
                                            <li>
                                                {{ Html::link('#', 'xls', ['class' => 'export-btn']) }}
                                                {{ Form::open(['route' => 'export', 'id' => 'export-form']) }}
                                                    {{ Form::hidden('type', 'xls') }}
                                                {{ Form::close() }}
                                            </li>
                                            <li>
                                                {{ Html::link('', 'xlsx', ['class' => 'export-btn']) }}
                                                {{ Form::open(['route' => 'export', 'id' => 'export-form']) }}
                                                    {{ Form::hidden('type', 'xlsx') }}
                                                {{ Form::close() }}
                                            </li>
                                            <li>
                                                {{ Html::link('', 'csv', ['class' => 'export-btn']) }}
                                                {{ Form::open(['route' => 'export', 'id' => 'export-form']) }}
                                                    {{ Form::hidden('type', 'csv') }}
                                                {{ Form::close() }}
                                            </li>
                                        </ul>
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
                                            <th width="2%">
                                                {{ Form::checkbox('checkbox', '', false, ['class' => 'check user-check', 'id' => 'check-all']) }}
                                            </th>
                                            <th width="2%">@lang('lang.stt')</th>
                                            <th width="8%">@lang('lang.tour_name')</th>
                                            <th width="12%">@lang('lang.email')</th>
                                            <th width="7%">@lang('lang.adults')</th>
                                            <th width="7%">@lang('lang.children')</th>
                                            <th width="7%">@lang('lang.status')</th>
                                            <th width="7%">@lang('lang.paymented')</th>
                                            <th width="7%">@lang('lang.debt')</th>
                                            <th width="24%">@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            <tr>
                                                <td class="center">
                                                    {{ Form::checkbox('checkbox', '', false, ['class' => 'check checkbox-input user-check', 'booking' => $booking->id]) }}
                                                </td>
                                                <td class="center">{{ $loop->iteration }}</td>
                                                <td>{{ str_limit($booking->tour->name, 15) }}</td>
                                                <td class="center">{{ str_limit($booking->user->email, 10) }}</td>
                                                <td class="center">{{ $booking->number_of_people }}</td>
                                                <td class="center">
                                                    {{ $booking->number_of_children }}
                                                </td>
                                                <td class="center status-{{ $booking->status }}">{{ $booking->status_text }}</td>
                                                <td class="center">${{ $booking->paymented }}</td>
                                                <td class="center">${{ $booking->debt }}</td>
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
                                {{ $bookings->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
