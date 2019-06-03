<div class="box-body">
    <h4>Danh sách khách sạn được chọn</h4>
    <table id="data-list-hotel" class="data-list-hotel table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tên khách sạn</th>
                <th>Địa điểm</th>
                <th>Số điện thoại</th>
                <th class="text-center">Điểm đánh gía</th>
                <th>Website</th>
                <th class="text-center">@lang('lang.action')</th>
            </tr>
        </thead>
        <tbody>
            @if (count($hotels))
              @foreach ($hotels as $hotel)
                <tr>
                    <td>{{ str_limit($hotel->name, 35) }}</td>
                    <td>{{ str_limit($hotel->address, 40) }}</td>
                    <td>{{ $hotel->phone }}</td>
                    <td class="text-center">
                      <p>{!! renderHtmlRating($hotel->rating) !!}</p>
                    </td>
                    <td><a href="{{ $hotel->website }}" target="_blank">{{ str_limit($hotel->website, 40) }}</a></td>
                    <td class="text-center">
                      <a style="margin-right: 15px;"
                          class="btn btn-primary" href="{{ route('admin.hotel.edit', $hotel->id) }}">
                          <i class="fa fa-pencil-square-o fa fa-lg"></i>
                      </a>
                      <button class="btn btn-danger delete-hotel-trigger"
                          type="submit"
                          data-url-delete="{{ route('admin.hotel.destroy', $hotel->id) }}"
                          data-hotel-id="{{ $hotel->id }}"><i class="fa fa-trash-o fa-fw" ></i></button>
                  </td>
                </tr>
              @endforeach
            @else
                <tr>
                    <td colspan="6" class="dis-block text-center">Have no hotel!</td>
                </tr>
            @endif
        </tbody>
    </table>
    <form class="col-md-2 delete-hotel-form"
      name="delete_hotel_form"
      method="POST"
      action="{{ route('admin.hotel.destroy', 1) }}">
      @method('DELETE')
      {{ csrf_field() }}
  </form>
  <div id="message-data"
      data-mess-confirm="{{ json_encode(trans('admin/global.message.confirm')) }}"
      data-lang-datatable="{{ json_encode(trans('admin/global.datatable')) }}"
  ></div>
  @component('widgets.admin.modal')
    @slot('class')
        danger
    @endslot
    @slot('headerText')
        Bạn có chắc chắn muốn xóa khách sạn?
    @endslot
@endcomponent
</div>
