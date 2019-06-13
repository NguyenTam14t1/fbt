
@extends('widgets.bookingtour.dashboard')

@section('change-header', 'changeHeader1')
@section('header-type', 'lightHeader lightHeader1')

@section('main-content')
    <section class="recentActivitySection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="recentActivityContent bg-ash">
                        <div class="dashboardPageTitle">
                            <h2>Thay đổi mật khẩu</h2>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible sending-access" role="alert">
                                {{ Form::button('<span aria-hidden="true">x</span>', ['class' => 'close', 'data-dismiss' => 'alert']) }}
                                {!! Session::get('message') !!}
                            </div>
                        @elseif (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible sending-error" role="alert">
                                {{ Form::button('<span aria-hidden="true">x</span>', ['class' => 'close', 'data-dismiss' => 'alert']) }}
                                <i class="fa fa-info"></i>
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div data-pattern="priority-columns">
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

                            <div class="buttonArea btn-group-mail" style="margin-bottom: 0px">
                              <a class="btn btn-danger" href="{{ route('home') }}"  style="width: 100px; height: 45px; margin-right: 20px">Thoát</a>
                              <input type="submit" id="btn-update-profile" name="btn-update-profile" class="btn btn-primary" value="Cập nhật" style="width: 100px; height: 45px">
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
