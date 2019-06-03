@extends('widgets.admin.master')

@section('title')
    @lang('admin/dashboard.title')
@endsection

@section('content')
    <section class="content-header">
        <h1>
            @lang('admin/dashboard.title')
        </h1>
    </section>
    <section class="content form-switch category-list">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-cogs" aria-hidden="true"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">@lang('admin/dashboard.general_info.category')</span>
                  <span class="info-box-number">{{$numCategory}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-file-video-o" aria-hidden="true"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">@lang('admin/dashboard.general_info.tour')</span>
                  <span class="info-box-number">{{$numTour}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-maroon"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">@lang('admin/dashboard.general_info.hotel')</span>
                  <span class="info-box-number">{{$numHotel}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">@lang('admin/dashboard.general_info.guide')</span>
                  <span class="info-box-number">{{$numGuide}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">@lang('admin/dashboard.general_info.user')</span>
                  <span class="info-box-number">{{$numUser}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">@lang('admin/dashboard.chart_view_count_lesson.title')</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-primary btn-chart-select default-chart" data-type="day">@lang('admin/dashboard.chart.daily')</button>
              <button class="btn btn-primary btn-chart-select" data-type="week">@lang('admin/dashboard.chart.weekly')</button>
              <button class="btn btn-primary btn-chart-select" data-type="month">@lang('admin/dashboard.chart.monthly')</button>
            </div>
          </div>
          <div class="box-body no-padding" style="height: 500px;">
              <canvas id="chart-count-view-lesson" width="auto" height="400"></canvas>
              <!-- /.row -->
          </div>  <!-- .box-body -->
        </div>
    </section>
@endsection

@section('styles')
    <style type="text/css">
      #chart-count-view-lesson{
        width: 100%;
      }
    </style>
@endsection


@section('scripts')
    <script type="text/javascript">
        var NUM_VIEW_LESSON = "@lang('admin/dashboard.chart_view_count_lesson.label.num_view_lesson')"
        var NUM_STUDENT = "@lang('admin/dashboard.chart_view_count_lesson.label.num_student')"
    </script>
    {{ Html::script('js/Chart.min.js') }}
    {{ Html::script(mix('admin/js/dashboard.js')) }}
@endsection
