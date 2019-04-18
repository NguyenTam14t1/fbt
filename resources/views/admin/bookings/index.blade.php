@extends ('widgets.admin.master')

@section('title')
    @lang('admin/booking.title_index')
@endsection

@section('content')
    <section class="content-header">
        <h1>
            @lang('admin/booking.title_index')
        </h1>
    </section>
    <section class="content form-switch booking-list">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="box-body table-responsive pd-t-10">
                                <div class="col-md-12" >
                                    <table id="datatable-list" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="2%">
                                                    {{ Form::checkbox('checkbox', '', false, ['class' => 'check user-check', 'id' => 'check-all']) }}
                                                </th>
                                                <th width="2%">@lang('lang.stt')</th>
                                                <th width="8%">Name tour</th>
                                                <th width="12%">@lang('lang.email')</th>
                                                <th width="7%">@lang('lang.adults')</th>
                                                <th width="7%">@lang('lang.children')</th>
                                                <th width="7%">@lang('lang.status')</th>
                                                <th width="7%">@lang('lang.paymented')</th>
                                                <th width="7%">@lang('lang.debt')</th>
                                                <th width="24%" class="text-center">@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($bookings))
                                                @foreach ($bookings as $booking)
                                                    @if (isset($booking->tour) && isset($booking->user))
                                                        <tr>
                                                            <td class="center">
                                                                {{ Form::checkbox('checkbox', '', false, ['class' => 'check checkbox-input user-check', 'booking' => $booking->id]) }}
                                                            </td>
                                                            <td class="center">{{ $loop->iteration }}</td>
                                                            <td>{{ str_limit($booking->tour->name, 35) }}</td>
                                                            <td class="center">{{ str_limit($booking->user->email) }}</td>
                                                            <td class="center">{{ $booking->number_of_people }}</td>
                                                            <td class="center">
                                                                {{ $booking->number_of_children }}
                                                            </td>
                                                            <td class="center status-{{ $booking->status }}">{{ $booking->status_text }}</td>
                                                            <td class="center">${{ $booking->paymented }}</td>
                                                            <td class="center">${{ $booking->debt }}</td>
                                                            <td class="text-center">
                                                                <div class="group-action">
                                                                    <a data-toggle="tooltip" data-placement="left" title="view" href="#" class="btn btn-primary group-action-link">
                                                                        <i class="fa fa-eye fa fa-lg"></i></a>
                                                                    <div class="onoffswitch group-action-switch">
                                                                        <button class="show-modal-confirm" data-toggle="modal" data-target="#modal-default" style="display:none;"></button>
                                                                        @php $isDelete = !($booking->deleted_at) @endphp
                                                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch-{{ $booking->id }}"
                                                                            {{ $isDelete ? 'checked' : ''}} data-id="{{ $booking->id }}" data-show-modal="true">
                                                                        <label class="onoffswitch-label" for="myonoffswitch-{{ $booking->id }}">
                                                                            <span class="onoffswitch-inner"></span>
                                                                            <span class="onoffswitch-switch"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10">@lang('global.notice.result_empty')</td>
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
        {{ Form::open(['route' => ['admin.booking.destroy', 'ID_REPLY_IN_URL'], 'id' => 'delete-booking-form', 'class' => 'form-horizontal']) }}
            {{ method_field('DELETE') }}
        {{ Form::close() }}
        <div id="message-data"
            data-mess-confirm="{{ json_encode(trans('admin/global.message.confirm')) }}"
            data-lang-datatable="{{ json_encode(trans('admin/global.datatable')) }}"
            data-url-delete = "{{route('admin.booking.destroy', 'ID_REPLY_IN_URL')}}"
            data-url-dataTable = "{{ route('admin.booking.index') }}">
        ></div>
        @component('widgets.admin.modal')
            @slot('class')
                danger
            @endslot
            @slot('headerText')
                @lang('admin/global.message.confirm')
            @endslot
        @endcomponent
    </section>
@endsection
@section('scripts')
    {{ Html::script('templates/admin/js/booking.js') }}
@endsection

@section('styles')
  {{ Html::style('templates/admin/css/booking.css') }}
@endsection
