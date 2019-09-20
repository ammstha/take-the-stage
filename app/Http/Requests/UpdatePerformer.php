<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerformer extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'DOB'=>'required',
            'sex'=>'required',
            'performance_level'=>'required'

        ];
    }
    public function data()
    {
        return [

            'first_name' => $this->get('first_name'),
            'last_name' => $this->get('last_name'),
            'DOB' => $this->get('DOB'),
            'sex' => $this->get('sex'),
            'performance_levels_id' => $this->get('performance_level'),
        ];
    }}
