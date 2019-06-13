<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password_old' => 'required|current_password',
            'password' => 'required|min:6|confirmed',
            // 'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            // 'password_confirmation.required' => 'Trường xác nhận mật khẩu không được để trống!',
            // 'password_confirmation.same' => 'Mật khẩu không trùng khớp',
            'password.required' => 'Độ dài tối thiểu mật khẩu là 6!',
            'password.min' => 'Độ dài tối thiểu mật khẩu là 6!',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_old.current_password' => 'Sai mật khẩu!',
        ];
    }
}
