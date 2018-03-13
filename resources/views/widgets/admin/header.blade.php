<!DOCTYPE html>
<html>
    <head>
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@lang('lang.travel_admin')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @routes
        {{ Html::favicon('templates/bookingtour/img/favicon.png') }}

        {{ Html::style('templates/admin/css/normalize.css') }}
        {{ Html::style('css/app.css') }}
        {{ Html::script('js/app.js') }}
        {{ Html::style('templates/admin/css/style.css') }}
    </head>
    <body>
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">
                <div class="navbar-header">
                    {{ Form::button('<i class="fa fa-bars"></i>', ['class' => 'navbar-toggle navbar-btn', 'data-toggle' => 'collapse', 'data-target' => '#main-menu', 'aria-controls' => 'main-menu', 'aria-expanded' => 'false', 'aria-label' => 'Toggle navigation']) }}
                    {!! html_entity_decode(Html::link('#', Html::image(config('setting.footer_logo'), 'Logo'), ['class' => 'navbar-brand'])) !!}
                    {!! html_entity_decode(Html::link('#', Html::image(config('setting.logo_small'), 'Logo'), ['class' => 'navbar-brand hidden'])) !!}
                </div>
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            {!! html_entity_decode(Html::link('', '<i class="menu-icon fa fa-dashboard"></i>' . trans('lang.dashboard'))) !!}
                        </li>
                        <h3 class="menu-title">@lang('lang.manager')</h3>
                        <li class="menu-item-has-children dropdown">
                            {!! html_entity_decode(Html::link('', '<i class="menu-icon fa fa-user"></i>' . trans('lang.users'), ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'])) !!}
                        </li>
                        <li class="menu-item-has-children dropdown">
                            {!! html_entity_decode(Html::link('', '<i class="menu-icon fa fa-tasks"></i>' . trans('lang.categories'), ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'])) !!}
                        </li>
                        <li class="menu-item-has-children dropdown">
                            {!! html_entity_decode(Html::link('', '<i class="menu-icon fa fa-plane"></i>' . trans('lang.tours'), ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'])) !!}
                        </li>
                        <li class="menu-item-has-children dropdown">
                            {!! html_entity_decode(Html::link('', '<i class="menu-icon fa fa-comment-o"></i>' . trans('lang.bookings'), ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'])) !!}
                        </li>
                        <li class="menu-item-has-children dropdown">
                            {!! html_entity_decode(Html::link('', '<i class="menu-icon fa fa-usd"></i>' . trans('lang.revenues'), ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'])) !!}
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </aside><!-- /#left-panel -->
        <!-- Right Panel -->
        <div id="right-panel" class="right-panel">
            <!-- Header-->
            <header id="header" class="header">
                <div class="header-menu">
                    <div class="col-sm-7">
                        {!! html_entity_decode(Html::link('#', '<i class="fa fa fa-tasks"></i>', ['class' => 'menutoggle pull-left', 'id' => 'menuToggle'])) !!}
                        <div class="header-left">
                            <button class="search-trigger"><i class="fa fa-search"></i></button>
                            <div class="form-inline">
                                <form class="search-form">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                    <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                                </form>
                            </div>
                            <div class="dropdown for-notification">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="count bg-danger message-danger">5</span>
                                </button>
                            </div>
                            <div class="dropdown for-message">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                    <span class="count bg-primary">9</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @auth
                        <div class="col-sm-5">
                            <div class="user-area dropdown float-right">
                                {!! html_entity_decode(Html::link('#', Html::image(Auth::user()->avatar_path, 'user-avatar', ['class' => 'user-avatar']), ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'])) !!}
                                <div class="user-menu dropdown-menu">
                                    {{ Html::link('', trans('lang.my_profile'), ['class' => 'nav-link fa fa-user']) }}
                                    {{ Html::link('', trans('lang.notifications'), ['class' => 'nav-link fa fa-comment-o']) }}
                                    {{ Html::link('', trans('lang.setting'), ['class' => 'nav-link fa fa-cog']) }}
                                    {{ Html::link(route('home'), trans('lang.logout'), ['class' => 'nav-link fa fa-power-off', 'onclick' => 'event.preventDefault(); document.getElementById("logout-form").submit();']) }} 
                                    {{ Form::open(['route' => 'logout', 'id' => 'logout-form']) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </header><!-- /header -->
            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>@lang('lang.dashboard')</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li class="active">@lang('lang.dashboard')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
