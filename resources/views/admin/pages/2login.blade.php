<!DOCTYPE HTML>
<html lang="zxx">

  <head>
  	<title>Admin - Star travel - Đăng nhập</title>
  	<!-- Meta tag Keywords -->
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<meta name="keywords" content="Effective Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements"
  	/>
  	<script>
  		addEventListener("load", function () {
  			setTimeout(hideURLbar, 0);
  		}, false);

  		function hideURLbar() {
  			window.scrollTo(0, 1);
  		}
  	</script>
    {{ Html::style('templates/admin/css/login.css') }}
    @include('widgets.admin.styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

  <body>
  	<div class="video-w3l" data-vide-bg="images/background">
  		<!--header-->
  		<div class="header-w3l">
  			<h1>
  				Star travel
  			</h1>
  		</div>
  		<!--//header-->
  		<div class="main-content-agile">
  			<div class="sub-main-w3">
  				<h2>Đăng nhập
  					<i class="fa fa-hand-o-down" aria-hidden="true"></i>
  				</h2>
          {{ Form::close() }}
            {{ Form::open([
                    'route' => ['admin.auth.store'],
                    'id' => 'login-form',
                    'class' => 'form-horizontal',
                    'files' => true]) }}
                    @method('POST')
              <div class="pom-agile">
                  <span class="fa fa-envelope" aria-hidden="true"></span>
                  {{ Form::text(
                      'email',
                      '',
                      [
                          'class' => 'user',
                          'placeholder' => 'Mail'
                      ])
                  }}
              </div>
              <div class="pom-agile">
                  <span class="fa fa-key" aria-hidden="true"></span>
                  {{ Form::password(
                      'password',
                      [
                          'class' => 'pass',
                          'placeholder' => 'Mật khẩu'
                      ])
                  }}
              </div>
              <div class="sub-w3l">
                <div class="sub-agile">
                  <input type="checkbox" id="brand1" value="">
                  <label for="brand1">
                    <span></span>Remember me</label>
                </div>
                <a href="#">Quên mật khẩu?</a>
                <div class="clear"></div>
              </div>
              <div class="right-w3l">
                <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('admin/global.btn.signin')</button>
              </div>
            {{ Form::close() }}
  			</div>
  		</div>
  		<!--//main-->
  		<!--footer-->
  		<div class="footer">
  			<p>&copy; 2019 Star travel
  			</p>
  		</div>
  		<!--//footer-->
  	</div>

    @include('widgets.admin.scripts')
    @yield('script')
  </body>
</html>
