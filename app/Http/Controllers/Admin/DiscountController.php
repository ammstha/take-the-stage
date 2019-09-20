<?php

namespace App\Http\Controllers\Admin;

use App\Cost;
use App\Discount;
use App\Http\Requests\UpdateDiscount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class DiscountController extends Controller
{
    public function index(){
        $costs=Cost::all();
        return view('admin.discount.index',compact('costs'));
    }
    public function update(UpdateDiscount $request, $id){
        {

            try
            {
                $cost=Cost::find($id);
                $data = $request->data();
                $cost->update($data);
                Session::flash('success', 'Successfully Edited');
            }
            catch(\Exception $e)
            {
                Session::flash('fail', 'Failed to edit');
            }

            return redirect()->route('discount.index');
        }
    }
}
