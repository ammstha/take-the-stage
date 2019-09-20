<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerformanceCategories;
use App\Http\Requests\UpdatePerformanceCategories;
use App\PerformanceCategory;
use Illuminate\Http\Request;
use Session;

class PerformanceCategoryController extends Controller
{
    public function index()
    {
        $performanceCategories = PerformanceCategory::latest()->paginate(10);
        return view('admin.performanceCategories.index', compact('performanceCategories'));
    }

    public function store(StorePerformanceCategories $request)
    {
        try
        {
            $data = $request->data();
            PerformanceCategory::create($data);
            Session::flash('success', 'New Performer was successfully created!');
        }
        catch(\Exception $e)
        {
//            $e;
            Session::flash('fail', 'Performer already exist');
        }

        return redirect()->route('performanceCategory.index');
    }
    public function update(UpdatePerformanceCategories $request,PerformanceCategory $performanceCategory)
    {
        try
        {
            $data = $request->data();
            $performanceCategory->update($data);
            Session::flash('success', 'New Performer was successfully created!');
        }
        catch(\Exception $e)
        {
            Session::flash('fail', 'Performer already exist');
        }

        return redirect()->route('performanceCategory.index');
    }
    public function destroy($id)
    {

        try
        {
            $performanceCategory = PerformanceCategory::find($id);
            $performanceCategory->delete();
            Session::flash('success', 'Performance Category was deleted successfully');
        }
        catch(\Exception $e)
        {
            Session::flash('fail', 'Performance Category exist in performer entries');
        }
        return redirect()->route('performanceCategory.index');
    }
}
