@extends ('widgets.admin.master')

@section('title')
    Danh sách người dùng
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Danh sách người dùng
        </h1>
    </section>
    <section class="content form-switch user-list">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary pull-right mr-5" >
                            <i class="fa fa-plus"></i> @lang('admin/global.btn.new')
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="box-body table-responsive pd-t-10">
                                <div class="col-md-12" >
                                    <table id="data-list-user" class="table table-striped table-bordered" width="100%" cellspacing="0">
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
                                            @if (count($users))
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ str_limit($user->name, 35) }}</td>
                                                        <td class="text-center">{{ $user->email }}</td>
                                                        <td class="text-center">{{ $user->phone }}</td>
                                                        <td>{{ str_limit($user->address, 40) }}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger delete-user-trigger"
                                                                type="submit"
                                                                data-url-delete="{{ route('admin.user.destroy', $user->id) }}"
                                                                data-user-id="{{ $user->id }}"><i class="fa fa-trash-o fa-fw" ></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="dis-block text-center">Không có người dùng!</td>
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
        <form class="col-md-2 delete-user-form"
            name="delete_user_form"
            method="POST"
            action="{{ route('admin.user.destroy', 1) }}">
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
                Bạn có chắc chắn xóa người dùng này?
            @endslot
        @endcomponent
    </section>
@endsection
@section('scripts')
    {{ Html::script('templates/admin/js/user.js') }}
@endsection
