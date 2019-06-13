@extends('widgets.admin.master')
@section('title', 'Đổi mật khẩu')
@section('content')
  <section class="content-header">
    <h1>
      Đổi mật khẩu
    </h1>
  </section>
  <section class="content add-user check-add-user">
    <div class="box box-primary">
      <form role="form"
        id="edit-user"
        action="{{route('post.changepass')}}"
        method="POST">
        @csrf
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="password_old">Mật khẩu cũ </label><span class="field-required">*</span>
                <input class="form-control" name="password_old"
                  id="password_old"
                  required="required"
                  minlength="6"
                  placeholder="Mật khẩu cũ..."
                  type="password">
                  @if ($errors->has('password_old'))
                    <span class="input-error">{{ $errors->first('password_old') }}</span>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="password">Mật khẩu mới </label><span class="field-required">*</span>
                <input class="form-control" name="password"
                  id="password"
                  required="required"
                  minlength="6"
                  placeholder="Mật khẩu mới..."
                  type="password">
                  @if ($errors->has('password'))
                    <span class="input-error">{{ $errors->first('password') }}</span>
                @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="password">Xác nhận mật khẩu mới </label><span class="field-required">*</span>
                <input class="form-control" name="password_confirmation"
                  id="password_confirmation"
                  required="required"
                  minlength="6"
                  placeholder="Xác nhận mật khẩu mới..."
                  type="password">
                  @if ($errors->has('password_confirmation'))
                    <span class="input-error">{{ $errors->first('password_confirmation') }}</span>
                @endif
              </div>
            </div>
          </div>

        <div id="submit-form">
          <p class="btn-danger btn" data-url="{{ route('admin.dashboard') }}"
            data-toggle="modal" data-target="#modal-default">@lang('admin/global.btn.cancel')</p>
          <input type="submit" class="btn btn-primary" value="@lang('admin/global.btn.submit')">
        </div>
      </form>
    </div>
    @component('widgets.admin.modal')
      @slot('class')
        danger
      @endslot
      @slot('headerText')
        @lang('admin/global.message.cancel')
      @endslot
    @endcomponent
  </section>

@endsection

