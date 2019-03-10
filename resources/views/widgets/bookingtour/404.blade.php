<!DOCTYPE html>
<html>
<head>
    <title>@lang('lang.404')</title>
    {{ Html::style('css/app.css') }}
    {{ Html::script('js/app.js') }}
    {{ Html::style('templates/bookingtour/css/style.css') }}
</head>
    <body class="notFoundBg">
        <section class="notFoundContent">
            {{ Html::image(config('setting.404_img', 'error-404')) }}
            <h4>@lang('lang.404_text_1')</h4>
            <p>@lang('lang.404_text_1')</p>
            <div class="input-group">
                {{ Form::text('search', '', ['class' => 'form-control', 'aria-describedby' => 'basic-addon2']) }}
                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
        </section>
    </body>
</html>
