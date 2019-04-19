{{ Html::script('templates/bookingtour/js/script.js') }}

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
