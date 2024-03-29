<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerformer extends FormRequest
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
        $rules=[];
     return $rules;

    }
    public function data()
    {

        $performers=[];
        foreach ($this->performers as $a){
            $performers[]=[
            'first_name' => $a['first_name'],
            'last_name' => $a['last_name'],
            'DOB' => $a['DOB'],
            'sex' => $a['sex'],
            'performance_levels_id' => $a['performance_level'],
        ];
        }
        return $performers;
    }
}
