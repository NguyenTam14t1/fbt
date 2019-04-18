<!-- Signup Modal -->
<div class="modal fade signupLoging" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modalContentCustom">
            <div class="modal-header">
                {{ Form::button('<span aria-hidden="true">&times;</span>', ['class' => 'close', 'data-dismiss' => 'modal', 'aria-label' => 'Close']) }}
                <h4 class="modal-title" id="myModalLabel">@lang('lang.create_account')</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'register']) }}
                    <div class="form-group">
                        {{ Form::text('name', '', ['id' => 'name', 'class' => 'form-control bg-ash ' . ($errors->has('name') ? ' is-invalid' : ''), 'value' => old('name'), 'required' => 'required', 'placeholder' => trans('lang.name'), 'autofocus' => 'autofocus']) }}

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong class="register-message danger">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::email('email', '', ['id' => 'email-register', 'class' => 'form-control bg-ash ' . ($errors->has('email') ? ' is-invalid' : ''), 'value' => old('email'), 'required' => 'required', 'placeholder' => trans('lang.email')]) }}

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong class="register-message danger">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', ['class' => 'form-control bg-ash' . ($errors->has('password') ? ' is-invalid' : ''), 'required' => 'required', 'placeholder' => trans('lang.password')]) }}

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong class="register-message danger">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::password('password_confirmation', ['id' => 'password-confirm', 'class' => 'form-control bg-ash' . ($errors->has('password') ? ' is-invalid' : ''), 'required' => 'required', 'placeholder' => trans('lang.password_confirm')]) }}
                    </div>

                    {{ Form::submit(trans('lang.signup'), ['class' => 'btn btn-default']) }}
                    {{ Form::hidden('popup-register', old('popup-register'), ['id' => 'popup-register']) }}
                    @if (count($errors))
                        {{ Form::hidden('login-error', '', ['class' => 'popup-error']) }}
                    @endif
                {{ Form::close() }}
                <div class="or">@lang('lang.or')</div>
                {{ Html::link(route('authenticate', 'google'), trans('lang.signup_google'), ['class' => 'btn btn-default btnSocial']) }}
            </div>

            <div class="modal-footer">
                <div class="dontHaveAccount">
                    <p>@lang('lang.have_account')
                        {{ Html::link('#', trans('lang.login'), ['data-toggle' => 'modal', 'data-target' => '#login', 'id' => 'login-btn']) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
