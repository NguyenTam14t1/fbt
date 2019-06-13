@extends('widgets.bookingtour.dashboard')

@section('change-header', 'changeHeader1')
@section('header-type', 'lightHeader lightHeader1')

@section('main-content')
    @section('active-1', 'active')
    <!-- WELCOME SECTION -->
    <section class="welcomeSection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2>@lang('lang.hi') {{ $data['user']->name }}, @lang('lang.welcome')  <span> @lang('lang.travel_tour')!</span></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- BLOCK SECTION -->
    <section class="blockSection">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-15 col-sm-15 col-xs-15" style="width: 25%;">
                    <div class="content-block">
                        <div class="media bg-red-c block-panel">
                            <div class="media-body ">
                                <h4 class="media-heading block-header">{{ count($data['tour_cancel']) }}</h4>
                            </div>
                            <div class="media-right ">
                                <div class="icon bg-red-b">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </div>
                            </div>
                            <p class="block-content">@lang('lang.tour_cancel')</p>
                        </div>
                        <a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_cancel')]) }}" class="btn btn-content bg-red-b">@lang('lang.view_detail')<i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-15 col-sm-15 col-xs-15" style="width: 25%;">
                    <div class="content-block">
                        <div class="media bg-blue-c block-panel">
                            <div class="media-body">
                                <h4 class="media-heading block-header">{{ count($data['tour_wait_confirm']) }}</h4>
                            </div>
                            <div class="media-right">
                                <div class="icon bg-blue-b">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                            </div>
                            <p class="block-content">@lang('lang.tour_wait_confirm')</p>
                        </div>
                        <a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_wait_confirm')]) }}" class="btn btn-content bg-blue-b">@lang('lang.view_detail') <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-15 col-sm-15 col-xs-15" style="width: 25%;">
                    <div class="content-block">
                        <div class="media bg-green-c block-panel">
                            <div class="media-body">
                                <h4 class="media-heading block-header">{{ count($data['tour_confirmed']) }}</h4>
                            </div>
                            <div class="media-right">
                                <div class="icon bg-green-b">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </div>
                            </div>
                            <p class="block-content">@lang('lang.tour_confirmed')</p>
                        </div>
                        <a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_confirmed')]) }}" class="btn btn-content bg-green-b">@lang('lang.view_detail') <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-15 col-sm1-15 col-xs-15" style="width: 25%;">
                    <div class="content-block">
                        <div class="media bg-purple-c block-panel">
                            <div class="media-body">
                                <h4 class="media-heading block-header">{{ count($data['tour_finished']) }}</h4>
                            </div>
                            <div class="media-right">
                                <div class="icon bg-purple-b">
                                    <i class="fa fa-plane" aria-hidden="true"></i>
                                </div>
                            </div>
                            <p class="block-content">@lang('lang.tour_finished')</p>
                        </div>
                        <a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_finished')]) }}" class="btn btn-content bg-purple-b">@lang('lang.view_detail') <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- RECENT ACTIVITY SECTION -->
    <section class="recentActivitySection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="recentActivityContent bg-ash">
                        <div class="dashboardPageTitle">
                            <h2>@lang('lang.recent_activity')</h2>
                        </div>
                        <div class="table-responsive"  data-pattern="priority-columns">
                            <table class="table listingsTable">
                                <tbody>
                                    @foreach ($data['booking_recent'] as $booking)
                                        <tr class="rowItem">
                                            @if (isset($booking->tour))
                                                <td class="tour-image-recent">
                                                    <div>
                                                        <img src="{{ $booking->tour->picture_path }}">
                                                    </div>
                                                </td>
                                                <td class="iconTd">
                                                    <div class="icon br-{{ $booking->status }}">
                                                        <i class="icon-status-{{ $booking->status }}" aria-hidden="true"></i>
                                                    </div>
                                                </td>
                                                <td class="packageTd">
                                                    <ul class="list-inline listingsInfo">
                                                        <li>
                                                            <h4><a href="#">{{ $booking->tour->name }}</a></h4>
                                                            <p>{{ $booking->number_of_people }} @lang('lang.adults'), {{ $booking->number_of_children }} @lang('lang.children')</p>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="priceTd">
                                                    <ul class="list-inline listingsInfo text-right">
                                                        <li>
                                                            <h4>${{ $booking->tour->price }}</h4>
                                                            <p>@lang('lang.avg_person')</p>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="bookingTd">
                                                    <ul class="list-inline listingsInfo text-left">
                                                        <li>
                                                            <h4>@lang('lang.booked_on')</h4>
                                                            <p>{{ $booking->updated_time }}</p>
                                                            <a href="{{ route('client.user.manager.edit', [$booking->user->id, $booking->id]) }}" class="btn buttonTransparent view-btn">@lang('lang.view')</a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
