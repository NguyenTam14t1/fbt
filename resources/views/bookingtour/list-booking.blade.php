@extends('widgets.bookingtour.dashboard')

@section('main-content')
    @section('active-2', 'active')
    <section class="bookingTypeSection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bookingType bg-ash">
                        <ul class="bookingList" status="{{ $data['status'] }}">
                            <li><a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_all')]) }}" status="{{ config('setting.booking_cancel') }}" status="5">@lang('lang.all')</a></li>
                            <li><a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_cancel')]) }}" status="{{ config('setting.booking_cancel') }}">@lang('lang.tour_cancel')</a></li>
                            <li><a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_wait_confirm')]) }}" status="{{ config('setting.booking_wait_confirm') }}">@lang('lang.tour_wait_confirm')</a></li>
                            <li><a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_confirmed')]) }}" status="{{ config('setting.booking_confirmed') }}">@lang('lang.tour_confirmed')</a></li>
                            <li><a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_paymented')]) }}" status="{{ config('setting.booking_paymented') }}">@lang('lang.tour_paymented')</a></li>
                            <li><a href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_finished')]) }}" status="{{ config('setting.booking_finished') }}">@lang('lang.tour_finished')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="recentActivitySection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="recentActivityContent bg-ash">
                        <div class="dashboardPageTitle">
                            <h2>{{ $data['title'] }}</h2>
                        </div>
                        <div class="table-responsive" data-pattern="priority-columns"  id="booking-show" value="{{ $data['user']->id }}">
                            <table class="table listingsTable">
                                <tbody>
                                    @foreach ($data['bookings'] as $booking)
                                        <tr class="rowItem">
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="paginationCenter paginationBooking">
                                {{ $data['bookings']->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
