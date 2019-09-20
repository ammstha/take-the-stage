<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerformer;
use App\Http\Requests\UpdatePerformer;
use App\PerformanceLevel;
use App\Performer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Excel;
use Response;
class PerformerController extends Controller
{

    public function index()
    {
        $studio_id = auth()->user()->id;
        $performers = Performer::where('studio_id', $studio_id)->get();
        return view('admin.performer.index', compact('performers'));
    }

    public function create()
    {
        $performance_levels = PerformanceLevel::all();
        return view('admin.performer.create', compact('performance_levels'));
    }

    public function store(StorePerformer $request)
    {
//        dd($request->data());
        try {
            $data = $request->data();
            foreach ($data as $performer) {
                auth()->user()->performers()->create($performer);
            }

            Session::flash('success', 'New Contestent was successfully created!');
        } catch (\Exception $e) {
            Session::flash('fail', 'Error');
        }

        return redirect()->route('studio.performer.index');
    }

    public function show(Performer $performer)
    {
        //
    }

    public function edit(Performer $performer)
    {
        $performance_levels = PerformanceLevel::all();

        $select = [];
        foreach ($performance_levels as $performance_level) {
            $select[$performance_level->id] = $performance_level->name;
        }
        return view('admin.performer.edit', compact('performer', 'select'));
    }

    public function update(UpdatePerformer $request, Performer $performer)
    {

        try {
            $data = $request->data();
            $performer->update($data);

            Session::flash('success', 'Contestent Successfully edited!');
        } catch (\Exception $e) {
//            return $e;
            Session::flash('fail', 'Contestent was not updated');
        }

        return redirect()->route('studio.performer.index');

    }

    public function destroy($performer)
    {

        try {
            $performer = Performer::find($performer);
            $performer->delete();
            Session::flash('success', 'Contestent was deleted successfully');
        } catch (\Exception $e) {

            Session::flash('fail', 'Contestent exist in Performer');
        }
        return redirect()->route('studio.performer.index');
    }

    public function importExcel(Request $request)
    {
        try {
            $request->validate([
                'import_file' => 'required'
            ]);

            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path)->get();

            dd($data->count());
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $arr[] = [
                        'first_name' => $value->first_name,
                        'last_name' => $value->last_name,
                        'DOB' => $value->dob,
                        'sex' => $value->sex,
                        'performance_levels_id' => $value->performance_level_id,
                        'studio_id' => auth()->user()->id,
                    ];
                }


                if (!empty($arr)) {
                    Performer::insert($arr);
                }
            }

        } catch (\Exception $e) {
            return back()->with('fail', 'Failed to Insert Record.');
        }


        return back()->with('success', 'Insert Record successfully.');
    }

    public function downloadExcel()
    {
        $file= public_path(). "/storage/excel/ImportExcel.xlsx";
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download($file, 'ImportExcel.xlsx', $headers);

    }
}
