<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourImportRequest extends FormRequest
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
            'file_import' => 'required',
        ];
    }

     public function messages()
    {
        return [
            'file_import.required' => trans('lang.file_import_required'),
        ];
    }
}
