@extends ('widgets.admin.master')

@section ('content')
    <div class="col-sm-12">
        @if (count($errors))
            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-danger">@lang('lang.failed')</span>
                @foreach ($errors->all() as $error) 
                    {{ $error }}
                @endforeach
                {{ Form::button('<span aria-hidden="true">×</span>', ['class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']) }}
            </div>
        @endif
    </div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>@lang('lang.tour_input')</strong>
                        </div>
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label class=" form-control-label">@lang('lang.tour_name')</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-book"></i></div>
                                    {{ Form::text('name', '', ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">@lang('lang.description')</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-indent"></i></div>
                                    {{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => 5]) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">@lang('lang.place')</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa  fa-map-marker"></i></div>
                                    {{ Form::text('place', '', ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">@lang('lang.hotel')</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa  fa-h-square"></i></div>
                                    {{ Form::text('hotel', '', ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-control-label">@lang('lang.from')</label>
                                    <div class="input-group date ed-datepicker" data-provide="datepicker">
                                        <div class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                        {{ Form::text('check-out', '', ['class' => 'form-control', 'placeholder' => trans('lang.check_in')]) }}
                                    </div>
                                </div>    
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-control-label">@lang('lang.to')</label>
                                    <div class="input-group date ed-datepicker" data-provide="datepicker">
                                        <div class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                        {{ Form::text('check-out', '', ['class' => 'form-control', 'placeholder' => trans('lang.check_out')]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 col-sm-12">
                                    <label class=" form-control-label">@lang('lang.participant_min')</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                        {{ Form::text('participants_min', '', ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class=" form-control-label">@lang('lang.participant_max')</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-child"></i></div>
                                        {{ Form::text('participants_max', '', ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">@lang('lang.picture')</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                    {{ Form::file('file', ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-btn">
                                {{ Form::button(trans('lang.add'), ['class' => 'btn btn-info', 'type' => 'submit']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>@lang('lang.tour_import')</strong>
                        </div>
                        {{ Form::open(['route' => 'import', 'files' => 'true']) }}
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label class=" form-control-label">@lang('lang.file')</label><small> @lang('lang.extension_file')</small>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-upload"></i></div>
                                        {{ Form::file('file_import', ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                                <div class="form-btn">
                                    {{ Form::button(trans('lang.import'), ['class' => 'btn btn-info', 'type' => 'submit']) }}
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
