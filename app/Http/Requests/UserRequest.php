<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $validate = [
            'name' => 'required',
        ];

        switch ($this->method()) {
            case 'POST':
                $validate['email'] = 'required|email|unique:users|max:255|regex:' . config('setting.regex_email');
                $validate['phone'] = 'min:8|unique:users';
                return $validate;
            case 'PUT':
                $validate['email'] = 'required|email|max:255|unique:users,email,' . $this->user . ',id|regex:' . config('setting.regex_email');

                return $validate;
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'name.required' => "Trường tên không được để trống!",
            'email.required' => 'Trường email không được để trống!',
            'email.email' => 'Trường email sai định dạng!',
            'email.regex' => 'Trường email sai định dạng!',
        ];
    }
}
