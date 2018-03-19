<!DOCTYPE html>
<html>
    <head>
        <!-- SITE TITTLE -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@lang('lang.travel_tour')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @routes
        
        <!-- PLUGINS CSS STYLE -->
        {{ Html::style('css/app.css') }}
        {{ Html::script('js/app.js') }}
        {{ Html::style('templates/plugins/selectbox/select_option1.css') }}
        {{ Html::style('templates/plugins/datepicker/datepicker.css') }}
        {{ Html::style(asset('/templates/plugins/animate/animate.min.css')) }}
        
        <!-- CUSTOM CSS -->
        {{ Html::style('templates/bookingtour/css/style.css') }}
        {{ Html::style('templates/bookingtour/css/activity-date.css') }}

        <!-- FAVICON -->
        {{ Html::favicon('templates/bookingtour/img/favicon.png') }}

    </head>
    <body class="body-wrapper @yield('change-header')">
        <!-- Preloader -->
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        @if (Session::has('login_request'))
            {{ Form::hidden('login', 'login', ['id' => 'login-request']) }}
        @endif
        <div class="main-wrapper">
            <!-- HEADER -->
            <section class="headerTop">
                <div class="container">
                    <div class="headerTopNav">
                        <ul class="headerTopNavbar">
                            <li class="active">
                                {!! html_entity_decode(Html::link('', '<i class="fa fa-phone" aria-hidden="true"></i>' . trans('lang.phone_contact'))) !!}
                            </li>
                            <li class="active">
                                {!! html_entity_decode(Html::link('http://mailTo:support@startravel.com', '<i class="fa fa-envelope" aria-hidden="true"></i>' . trans('lang.email_contact'))) !!}
                            </li>
                        </ul>
                        <ul class="headerTopNavbar navbar-right">
                            <li class="active language-select">
                                <select name="language">
                                    <option value="en">@lang('lang.english')</option>
                                    <option value="vi">@lang('lang.vietnamese')</option>
                                </select>
                            </li>
                            @auth
                                <li class="active dropdown account-dropdown">
                                    {!! html_entity_decode(Html::link('#', '<span><img src="' . Auth()->user()->avatar_path . '" class="avatar"></span><strong>' . str_limit(Auth::user()->name, 7) . '</strong><span class="caret"></span>', ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-expanded' => 'false', 'aria-haspopup' => 'true'])) !!}
                                    <ul class="dropdown-menu account-menu">
                                        <li>
                                            {{ Html::link(route('client.user.index'), trans('lang.dashboard')) }}
                                        </li>
                                        <li>
                                            {{ Html::link(route('home'), trans('lang.logout'), ['onclick' => 'event.preventDefault(); document.getElementById("logout-form").submit();']) }}
                                            {{ Form::open(['route' => 'logout', 'id' => 'logout-form']) }}
                                            {{ Form::close() }}
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="active login-register">
                                    {!! html_entity_decode(Html::link('#', '<i class="fa fa-sign-in" aria-hidden="true"></i>' . trans('lang.login'), ['class' => 'user-login', 'data-toggle' => 'modal', 'data-target' => '#login'])) !!}{!! html_entity_decode(Html::link('#', '<i class="fa fa-user-plus" aria-hidden="true"></i>' . trans('lang.signup'), ['class' => 'user-register', 'data-toggle' => 'modal', 'data-target' => '#signup'])) !!}
                                </li>
                             @endauth
                        </ul>
                    </div>
                </div><!-- /.container -->
            </section>
            <header>
                <nav class="navbar navbar-default navbar-main navbar-fixed-top @yield('header-type')" role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            {{ Html::link(route('home'), '', ['class' => 'navbar-brand']) }}
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="singleDrop active">
                                    {{ Html::link(route('home'), trans('lang.home')) }}
                                </li>
                                @foreach ($menuCategories as $parentCategory)
                                    <li class="dropdown singleDrop ">
                                        {{ Html::link(route('client.category.show', $parentCategory->id), $parentCategory->name, ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'data-hover' => 'dropdown', 'data-delay' => '300', 'data-close-others' => 'true', 'aria-expanded' => 'false']) }}
                                        <ul class="row dropdown-menu">
                                            @foreach ($parentCategory->subCategories as $category)
                                                <li>{{ Html::link(route('client.category.show', $category->id), $category->name) }}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                <li class="dropdown searchBox">
                                    {!! html_entity_decode(Html::link('#', '<span class="searchIcon"><i class="fa fa-search" aria-hidden="true"></i></span>', ['class' => 'dropdow-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'])) !!}
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <span class="input-group">
                                                {{ Form::text('search-input', '', ['class' => 'form-control', 'placeholder' => trans('lang.search_placeholder'), 'aria-describedby' => 'basic-addon2']) }}
                                                <span class="input-group-addon" id="basic-addon2">@lang('lang.search')</span>
                                            </span>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
