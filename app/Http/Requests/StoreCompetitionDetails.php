<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetitionDetails extends FormRequest
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

            'name' => 'required',
            'location' => 'required',
            'rebate_date' => 'required|date',
            'last_date_to_register' => 'required|date',
            'events.*'=> 'required',
            'events.*.time'=> 'required',
        ];
    }

    public function data()
    {

        return [
            'name' => $this->get('name'),
            'eGroup'=>$this->get('eGroup'),
            'location' => $this->get('location'),
            'rebate_date' => $this->get('rebate_date'),
            'last_date_to_register' => $this->get('last_date_to_register'),
        ];

    }

    public function eventData()
    {
        $events = $this->get('events');

        if($events){
            $event_details=[];
            foreach($events as $event){
                $event_details[]=[
                    'date'=>$event['date'],
                    'time'=>$event['time'],
                    'remainingTime'=>$event['time'],
                ];
            }
            return $event_details;
        }
        else{
            $event_details=[];
            return $event_details;
        }

    }
}
