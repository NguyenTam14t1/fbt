<!DOCTYPE html>
<html>
    <head>
        <!-- SITE TITTLE -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@lang('lang.travel_tour')</title>
        
        <!-- PLUGINS CSS STYLE -->
        {{ Html::style('css/app.css') }}
        
        <!-- CUSTOM CSS -->
        {{ Html::style('templates/bookingtour/css/style.css') }}

        <!-- FAVICON -->
        {{ Html::favicon('templates/bookingtour/img/favicon.png') }}
    </head>
    <body class="body-wrapper  changeHeader ">
        <div class="main-wrapper">
            <!-- HEADER -->
            <header>
                <section class="headerTop">
                    <div class="container">
                        <div class="headerTopNav">
                            <ul class="headerTopNavbar">
                                <li class="active"><a href=""><i class="fa fa-phone" aria-hidden="true"></i>@lang('lang.phone_contact')</a></li>
                                <li class="active"><a href="mailTo:support@startravel.com"><i class="fa fa-envelope" aria-hidden="true"></i>@lang('lang.email_contact')</a></li>
                            </ul>
                            <ul class="headerTopNavbar navbar-right">
                                <li class="active language-select">
                                    <select name="language">
                                        <option value="en">@lang('lang.english')</option>
                                        <option value="vi">@lang('lang.vietnamese')</option>
                                    </select>
                                </li>
                                <li class="active login-register">
                                    <a href="" data-toggle="modal" data-target="#login" class="user-login"><i class="fa fa-sign-in" aria-hidden="true"></i>@lang('lang.login')</a><a href="" data-toggle="modal" data-target="#signup" class="user-register"><i class="fa fa-user-plus" aria-hidden="true"></i>@lang('lang.register')</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.container -->
                </section>
                <nav class="navbar navbar-default navbar-main lightHeader" role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index.html"></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown singleDrop active">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">@lang('lang.home')</a>
                                </li>
                                <li class="dropdown megaDropMenu ">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="true" aria-expanded="false">@lang('lang.tour')</a>
                                    <ul class="row dropdown-menu">
                                        <li class="col-sm-3 col-xs-12">
                                            <ul class="list-unstyled">
                                                <li>@lang('lang.tour')</li>
                                                <li class=""><a href="">@lang('lang.tour')</a></li>
                                                <li class=""><a href="">@lang('lang.tour')</a></li>
                                                <li class=""><a href="">@lang('lang.tour')</a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-3 col-xs-12">
                                            <ul class="list-unstyled">
                                                <li>@lang('lang.tour')</li>
                                                <li class=""><a href="">@lang('lang.tour')</a></li>
                                                <li class=""><a href="">@lang('lang.tour')</a></li>
                                                <li class=""><a href="">@lang('lang.tour')</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown singleDrop ">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('lang.tour')</a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>@lang('lang.tour')</li>
                                        <li class=""><a href="">@lang('lang.tour')</a></li>
                                        <li class=""><a href="">@lang('lang.tour')</a></li>
                                        <li class=""><a href="">@lang('lang.tour')</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown searchBox">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="searchIcon"><i class="fa fa-search" aria-hidden="true"></i></span></a>
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
