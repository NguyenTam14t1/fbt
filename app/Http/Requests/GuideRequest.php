<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuideRequest extends FormRequest
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

    public function rules()
    {
        $validate = [
            'name' => 'required',
            'address' => 'required|max:255',
            'category_id' => 'required',
        ];

        switch ($this->method()) {
            case 'POST':
                $validate['mail'] = 'required|email|unique:guides|max:255|regex:' . config('setting.regex_email');
                $validate['phone'] = 'min:8|unique:guides';

                return $validate;
            case 'PUT':
                $validate['mail'] = 'required|email|max:255|unique:guides,email,' . $this->guide . ',id|regex:' . config('setting.regex_email');
                $validate['phone'] = 'min:8|unique:guides,phone,' . $this->guide . ',id';

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
