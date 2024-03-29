<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudio extends FormRequest
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
            //
        ];
    }

    public function data()
    {
        return [
            'title' => $this->get('title'),
            'director_name' => $this->get('director_name'),
            'address' => $this->get('address'),
            'city' => $this->get('city'),
            'state' => $this->get('state'),
            'zip' => $this->get('zip'),
            'studio_phone' => $this->get('studio_phone'),
            'cell_phone' => $this->get('cell_phone'),
            'faculty' => $this->get('faculty'),
        ];
    }
}
