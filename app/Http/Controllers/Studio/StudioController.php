<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudio;
use App\Studio;
use App\User;
use Illuminate\Http\Request;
use Session;
use CountryState;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Studio $studio
     * @return \Illuminate\Http\Response
     */
    public function show(Studio $studio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studio $studio
     * @return \Illuminate\Http\Response
     */
    public function edit(Studio $studio)
    {
        // $states = CountryState::getStates('US');
        
        $states=[
            "AL" => "Alabama",
            "AK" => "Alaska",
            "AZ" => "Arizona",
            "AR" => "Arkansas",
            "CA" => "California",
            "CO" => "Colorado",
            "CT" => "Connecticut",
             "DE" => "Delaware",
             "FL" => "Florida",
             "GA" => "Georgia",
             "HI" => "Hawaii",
             "ID" => "Idaho",
             "IL" => "Illinois",
             "IN" => "Indiana",
             "IA" => "Iowa",
             "KS" => "Kansas",
             "KY" => "Kentucky",
             "LA" => "Louisiana",
             "MA" => "Massachusetts",
             "MD" => "Maryland",
             "ME" => "Maine",
             "MI" => "Michigan",
             "MN" => "Minnesota",
             "MO" => "Missouri",
             "MS" => "Mississippi",
             "MT" => "Montana",
             "NC" => "North Carolina",
             "ND" => "North Dakota",
             "NE" => "Nebraska",
             "NH" => "New Hampshire",
             "NJ" => "New Jersey",
             "NM" => "New Mexico",
             "NV" => "Nevada",
             "NY" => "New York",
             "OH" => "Ohio",
             "OK" => "Oklahoma",
             "OR" => "Oregon",
             "PA" => "Pennsylvania",
             "RI" => "Rhode Island",
             "SC" => "South Carolina",
             "SD" => "South Dakota",
             "TN" => "Tennessee",
             "TX" => "Texas",
             "UT" => "Utah",
             "VA" => "Virginia",
             "VT" => "Vermont",
             "WA" => "Washington",
             "WI" => "Wisconsin",
             "WV" => "West Virginia",
             "WY" => "Wyoming",
        ];
        $sname= auth()->user()->name;
//        $sts = array();
//        foreach ($states as $state) {
//            $sts[$state->id] = $state->name;
//        }
        return view('studio.studio.edit', compact('studio','states','sname'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Studio $studio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudio $request, Studio $studio)
    {
        try {
            $data = $request->data();
            $studio->update($data);

            $name=[
                'name'=>$request->name
            ];
            if ($request->name) {
                $studio->user->update($name);
            }
            Session::flash('success', ' Studio was successfully updated');


        } catch (\Exception $e) {
            dd($e);
            Session::flash('success', 'Failed to Update');
        }
        return redirect()->route('studio.studio.edit',auth()->user()->studio->id);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studio $studio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studio $studio)
    {
        //
    }
}
