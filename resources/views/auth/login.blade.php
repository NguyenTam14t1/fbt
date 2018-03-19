<!-- Login Modal -->
<div class="modal fade signupLoging" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modalContentCustom">
            <div class="modal-header">
                {{ Form::button('<span aria-hidden="true">&times;</span>', ['class' => 'close', 'data-dismiss' => 'modal', 'aria-label' => 'Close']) }}
                <h4 class="modal-title" id="myModalLabel">@lang('lang.login_account')</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'login']) }}
                    <div class="form-group">
                        {{ Form::email('email', '', ['id' => 'email', 'class' => 'form-control bg-ash ' . ($errors->has('email') ? ' is-invalid' : ''), 'value' => old('email'), 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('lang.email')]) }}

                        @if ($errors->has('email'))
                            {{ Session::flash('login-error') }}
                            <span class="invalid-feedback">
                                <strong class="login-message danger">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', ['id' => 'password', 'class' => 'form-control bg-ash' . ($errors->has('password') ? ' is-invalid' : ''), 'required' => 'required', 'placeholder' => trans('lang.password')]) }}

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong class="login-message danger">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="checkbox">
                        <label>                
                            {{ Form::checkbox('remember', 'true', old('remember', false)) }} <i></i>@lang('lang.remember_me')
                        </label>
                        {{ Html::link(route('password.request'), trans('lang.forgot_password'), ['class' => 'forgotPass cleafix']) }}
                    </div>
                    {{ Form::submit(trans('lang.login'), ['class' => 'btn btn-default']) }}
                    {{ Form::hidden('popup-login', old('popup-login'), ['id' => 'popup-login']) }}
                    @if (count($errors))
                        {{ Form::hidden('login-error', '', ['class' => 'popup-error']) }}
                    @endif
                {{ Form::close() }}
                <div class="or">@lang('lang.or')</div>
                {{ Html::link(route('authenticate', 'google'), trans('lang.login_google'), ['class' => 'btn btn-default btnSocial']) }}
            </div>

            <div class="modal-footer">
                <div class="dontHaveAccount">
                    <p>@lang('lang.dont_have_account')
                        {{ Html::link('#', trans('lang.signup'), ['data-toggle' => 'modal', 'data-target' => '#signup', 'id' => 'register-btn']) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
