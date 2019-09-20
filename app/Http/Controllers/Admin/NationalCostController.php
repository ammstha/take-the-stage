<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateNationalCost;
use App\NationalCost;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NationalCostController extends Controller
{
    public function index(){
        $national_costs=NationalCost::all();
        return view('admin.national.index',compact('national_costs'));
    }
    public function update(UpdateNationalCost $request, $id){
        {

            try
            {
                $national_cost=NationalCost::find($id);
                $data = $request->data();
                $national_cost->update($data);
                Session::flash('success', 'Successfully Edited');
            }
            catch(\Exception $e)
            {
                Session::flash('fail', 'Failed to edit');
            }

            return redirect()->route('nationalCosts.index');
        }
    }
}
