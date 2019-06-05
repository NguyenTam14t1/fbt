<div class="container">
    <div class="infoTitle">
        <h2>Thông tin khách sạn và hướng dẫn viên</h2>
    </div>
    <div class="main-contain">
        <p style="text-transform: uppercase; color: #333; font-weight: bold; font-size: 15px; margin-bottom: 15px; margin-top: 10px"><i class="fa fa-building" aria-hidden="true"></i>&nbsp;&nbsp;Hotel</p>
        <section class="design-process-section" id="list-hotel">
            <table class="table table-bordered" id="table-hotel">
                @if (isset($data['tour']->hotels))
                    <thead>
                        <tr style="font-weight: bold; font-size: 16px;">
                            <td style="width:300px; padding-left: 20px" >Tên</td>
                            <td colspan="2" style="width:200px; padding-left: 20px">Địa chỉ</td>
                            <td style="width:150px; padding-left: 20px">Số điện thoại</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['tour']->hotels as $hotel)
                            <tr>
                              <td class="name-hotel" data-name-hotel="{{ $hotel->name }}" scope="row" style="padding-left: 20px">{{ $hotel->name }}</td>
                              <td class="address-hotel" data-address-hotel="{{ $hotel->address }}" colspan="2" style="padding-left: 20px">{{ $hotel->address }}</td>
                              <td class="phone-hotel" data-phone-hotel="{{ $hotel->phone }}" style="padding-left: 20px">{{ $hotel->phone }}</td>
                              <td class="latitude-hotel" data-latitude-hotel="{{ $hotel->latitude }}" class="hide"></td>
                              <td class="longitude-hotel" data-longitude-hotel="{{ $hotel->longitude }}" class="hide"></td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding-left: 20px"> Đang cập nhật </td>
                        </tr>
                        @endforelse
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="4" style="padding-left: 20px"> Đang cập nhật </td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </section>
    </div>

    <div class="main-contain">
        <p style="text-transform: uppercase; color: #333; font-weight: bold; font-size: 15px; margin-bottom: 15px; margin-top: 10px"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Guide</p>
        <section class="design-process-section" id="list-hotel">
            <table class="table table-bordered table-hotel">
                @if (isset($data['tour']->guides))
                    <thead>
                        <tr style="font-weight: bold; font-size: 16px;">
                            <td style="width:300px; padding-left: 20px" >Tên</td>
                            <td colspan="2" style="width:200px; padding-left: 20px">Địa chỉ</td>
                            <td style="width:150px; padding-left: 20px">Số điện thoại</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['tour']->guides as $guide)
                            <tr>
                              <td class="name-guide" data-name-guide="{{ $guide->name }}" scope="row" style="padding-left: 20px">{{ $guide->name }}</td>
                              <td class="address-guide" data-address-guide="{{ $guide->address }}" colspan="2" style="padding-left: 20px">{{ $guide->address }}</td>
                              <td class="phone-guide" data-phone-guide="{{ $guide->phone }}" style="padding-left: 20px">{{ $guide->phone }}</td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding-left: 20px"> Đang cập nhật </td>
                        </tr>
                        @endforelse
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="4" style="padding-left: 20px"> Đang cập nhật </td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </section>
    </div>
</div>
