@extends ('widgets.admin.master')

@section('title')
    Danh sách hưóng dẫn viên
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Danh sách hưóng dẫn viên
        </h1>
    </section>
    <section class="content form-switch guide-list">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{ route('admin.guide.create') }}" class="btn btn-primary pull-right mr-5" >
                            <i class="fa fa-plus"></i> @lang('admin/global.btn.new')
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="box-body table-responsive pd-t-10">
                                <div class="col-md-12" >
                                    <table id="data-list-guide" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tên </th>
                                                <th class="text-center">Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa điểm</th>
                                                <th class="text-center">@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($guides))
                                                @foreach ($guides as $guide)
                                                    <tr>
                                                        <td>{{ str_limit($guide->name, 35) }}</td>
                                                        <td class="text-center">{{ $guide->mail }}</td>
                                                        <td class="text-center">{{ $guide->phone }}</td>
                                                        <td>{{ str_limit($guide->address, 40) }}</td>
                                                        <td class="text-center">
                                                            <a style="margin-right: 15px;"
                                                            class="btn btn-primary" href="{{ route('admin.guide.edit', $guide->id) }}">
                                                                <i class="fa fa-pencil-square-o fa fa-lg"></i>
                                                            </a>
                                                            <button class="btn btn-danger delete-guide-trigger"
                                                                type="submit"
                                                                data-url-delete="{{ route('admin.guide.destroy', $guide->id) }}"
                                                                data-guide-id="{{ $guide->id }}"><i class="fa fa-trash-o fa-fw" ></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="dis-block text-center">Không có hướng dẫn viên!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form class="col-md-2 delete-guide-form"
            name="delete_guide_form"
            method="POST"
            action="{{ route('admin.guide.destroy', 1) }}">
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
                Bạn có chắc chắn xóa hướng dẫn viên này?
            @endslot
        @endcomponent
    </section>
@endsection
@section('scripts')
    {{ Html::script('templates/admin/js/guide.js') }}
@endsection
