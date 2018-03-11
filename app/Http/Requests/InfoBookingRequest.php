<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoBookingRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required|min:8',
            'identity_card' => 'required|min:6',
            'accept' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => trans('lang.first_name_required'),
            'last_name.required' => trans('lang.last_name_required'),
            'address.required' => trans('lang.address_required'),
            'phone.required' => trans('lang.phone_required'),
            'phone.min' => trans('lang.phone_min'),
            'identity_card.required' => trans('lang.identity_card_required'),
            'identity_card.min' => trans('lang.identity_card_min'),
            'accept.required' => trans('lang.accept_required'),
        ];
    }
}
