@extends('admin.layouts.master')

@section('title', trans('admin/user.form_title_profile'))

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('admin/user.form_title_profile') }}</h3>
                    </div>
                    {{ Form::open([
                        'route' => ['admin.user.profile.update'],
                        'id' => 'update-profile-form',
                        'class' => 'form-horizontal col-md-12 bg-white pd-t-15',
                        'enctype' => 'multipart/form-data',
                        'file' => true]) }}
                        @method('PUT')


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label(
                                    'name',
                                    trans('admin/user.label.name'),
                                    [
                                        'class' => 'col-sm-3 control-label',
                                        'required' => true,
                                    ])
                                }}
                                <div class="col-sm-7">
                                    {{ Form::text(
                                        'name',
                                        $user->name ?? '',
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => trans('admin/user.placeholder.name'),
                                            'maxlength' => 255,
                                        ])
                                    }}
                                    @if ($errors->has('name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label(
                                    'email',
                                    trans('admin/user.label.email'),
                                    [
                                        'class' => 'col-sm-3 control-label',
                                        'required' => true,
                                    ])
                                }}
                                <div class="col-sm-7">
                                    {{ Form::text(
                                        'email',
                                        $user->email ?? '',
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => trans('admin/user.placeholder.email'),
                                            'disabled' => 'true',
                                            'maxlength' => 255,
                                        ])
                                    }}
                                    @if ($errors->has('email'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                    {{ Form::label(
                                        'avatar',
                                        trans('admin/user.label.avatar'),
                                        [
                                            'class' => 'col-sm-3 control-label',
                                            'required' => true,
                                        ])
                                    }}
                                <div class="col-sm-7" id="thumbnail">
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                @lang('admin/user.label.thumbnail')
                                                <input type="file" style="display: none;" name="avatar" accept="image/jpeg,image/jpg,image/png" />
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly="">
                                    </div>
                                    <span class="text-danger" id="err-avatar" role="alert">
                                            <strong></strong>
                                        </span>
                                    @if ($errors->has('avatar'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                    <div class="pd-t-15">
                                        <img width="200px" height="200px" id="preview-thumbnail" src="{{ $user->avatarUrls['thumb256'] }}">
                                    </div>
                                    <div id="image-old" data-url="{{ $user->avatarUrls['thumb256'] }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @component('admin.layouts.button-group')
                        @slot('btnSubmitText')
                            @lang('admin/global.btn.save')
                        @endslot
                    @endcomponent
                    {{ Form::close() }}

                    @component('admin.layouts.modal')
                        @slot('class')
                            danger
                        @endslot
                        @slot('headerText')
                            @lang('admin/global.message.cancel')
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
        <div id="validate_upload"
            data-size="{{ config('images.validate.user_avatar.max_size') }}"
            data-mimes="{{ config('images.validate.user_avatar.mimes') }}"
            data-mess-size="{{ trans('admin/user.message.avatar_max', ['attribute' => trans('admin/user.label.avatar'), 'max' => config('images.validate.user_avatar.max_size') / 1024]) }}"
            data-mess-mimes="{{ trans('validation.mimes', ['attribute' => trans('admin/user.label.avatar'), 'values' => config('images.validate.user_avatar.mimes')]) }}">
        </div>
      </div>
    </section>
@endsection

@section('scripts')
    {{ Html::script(mix('admin/js/user.js')) }}
@endsection
