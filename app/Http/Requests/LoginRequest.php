<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validationRules = [];

        switch ($this->method()) {
            case 'POST':
                $validationRules = [
                    'email' => 'email',
                    'password' => 'required|min:3',
                ];
                break;
            default:
                # code...
                break;
        }

        return $validationRules;
    }
}
