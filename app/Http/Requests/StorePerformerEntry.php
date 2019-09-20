<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerformerEntry extends FormRequest
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
            'title'=>'required|max:100',
            'division'=>'required',
            'age_class'=>'required',
            'average_age'=>'required',
//             'music'=>'required|mimes:mpga,wav',
//             'music'=>'required|mimes:mp4,mpeg,3gp,mpga,wav',
        ];
    }
}
