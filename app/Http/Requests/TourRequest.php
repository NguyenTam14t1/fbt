<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class TourRequest extends FormRequest
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
        // dd($this->all(), $this->all()['description']);
        $validationRules = [
            'name' => 'required|unique:tours|max:'
                . config('setting.tour.maxlength_name')
                . '|min:' .config('setting.tour.minlength_name'),
            'hotel_id' => 'nullable|exists:hotels,id',
            'guide_id' => 'required|exists:guides,id',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'mimes:jpeg,jpg,png|max:' . config('setting.tour.maxsize_thumbnail'),
            'description' => 'required|max:' .config('setting.tour.maxlength_description'),
            'place' => 'required|max:' .config('setting.tour.maxlength_name'),
            'participants_min' => 'required|digits_between:' . config('setting.tour.min_guess') . ',' . config('setting.tour.max_guess'),
            'participants_max' => 'required|gte:participants_min|digits_between:' . config('setting.tour.min_guess') . ',' . config('setting.tour.max_guess'),
        ];
        $validationRules['time_start'] = 'date|date_format:Y-m-d';
        switch ($this->method()) {
            case 'POST':
                if ($this->time_start && $this->time_finish) {
                    $validationRules['time_finish'] = 'date|date_format:Y-m-d|after_or_equal:time_start';
                } elseif ($this->time_finish) {
                    $validationRules['time_finish'] = 'date|date_format:Y-m-d|after_or_equal:'
                        . Carbon::now();
                }

                break;
            case 'PATCH':
                $validationRules['name'] = 'required|unique:tours,name,'
                    . $this->tour . ',id|max:'
                    . config('setting.tour.maxlength_name')
                    . '|min:' .config('setting.tour.minlength_name');

                if ($this->time_start && $this->time_finish) {
                    $validationRules['time_finish'] = 'date|date_format:Y-m-d|after_or_equal:time_start';
                } elseif ($this->time_finish) {
                    $validationRules['time_finish'] = 'date|date_format:Y-m-d';
                }

                break;
            default:
                break;
        }

        return $validationRules;
    }

    public function messages()
    {
        return [
            'participants_max.gte' => trans('validation.gte.numeric', ['value' => $this->participants_min]),
            'time_start.after_or_equal' => trans('validation.after_or_equal', ['date' => $this->time_start]),
            'time_start.before' => trans('validation.before', ['date' => $this->time_start]),
            'time_finish.after_or_equal' => trans('validation.after_or_equal', ['date' => $this->time_start]),
            'time_finish.before' => trans('validation.before', ['date' => $this->time_finish]),
        ];
    }
}
