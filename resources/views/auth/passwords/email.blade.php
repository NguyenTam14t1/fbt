@extends('widgets.bookingtour.master')

@section('content')
    <div class="signupLoging">
        <div class="modal-dialog modal-reset" role="document">
            <div class="modal-content modalContentCustom">
                <div class="modal-header reset-header">
                    <h4>@lang('lang.reset_password')</h4>
                </div>
                @if (session('status'))
                    <div class="alert alert-success alert-reset-mail">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="modal-body reset-body">
                    {{ Form::open(['route' => 'password.email']) }}
                        <div class="form-group ">
                            {{ Form::email('email', '', ['id' => 'email-reset', 'class' => 'form-control bg-ash ' . ($errors->has('email') ? ' is-invalid' : ''), 'value' => old('email'), 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('lang.email_reset')]) }}

                            @if ($errors->has('email'))
                                {{ Session::flash('login-error') }}
                                <span class="invalid-feedback ">
                                    <strong class="reset-message danger">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{ Form::submit(trans('lang.send_mail_reset'), ['class' => 'btn btn-default', 'id' => 'mail-reset-btn']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
