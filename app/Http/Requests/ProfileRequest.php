<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProfileRequest extends FormRequest
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
        $this->user = $this->user ? $this->user : Auth::user()->id;
        // dd($this->user);
        return [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user . ',id|regex:' . config('setting.regex_email'),
            'phone' => 'min:8|unique:users,phone,' . $this->user . ',id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Trường tên không được để trống!",
            'email.required' => 'Trường email không được để trống!',
            'email.email' => 'Trường email sai định dạng!',
            'email.regex' => 'Trường email sai định dạng!',
            'phone.min' => 'Trường số điện thoại sai định dạng!',
            'phone.unique' => 'Số điện thoại đã tồn tại!',
        ];
    }
}