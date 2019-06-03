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
                <span class="info-box-icon bg-maroon"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i></span>

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
    </section>
@endsection

@section('styles')
    <style type="text/css">
      #chart-count-view-lesson{
        width: 100%;
      }
    </style>
@endsection

