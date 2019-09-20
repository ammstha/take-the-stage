<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreResult;
use App\Http\Requests\UpdateResult;
use App\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class ResultController extends Controller
{

    public function index()
    {
        $results=Result::latest()->paginate(7);
        return view('admin.result.index',compact('results'));
    }
    public function show($id)
    {
        //
    }

    public function store(StoreResult $request)
    {
        try {

            //Result Image
            $resultFile = $request->file('result_image');
            $resultFilenameWithExt = $resultFile->getClientOriginalName();
            $resultFilename = pathinfo($resultFilenameWithExt, PATHINFO_FILENAME);
            $extension = $resultFile->getClientOriginalExtension();
            $resultFileNameToStore = $resultFilename . '_' . time() . '.' . $extension;

            $resultdata = [
                'image' => $resultFilename,
                'path' => $resultFile->storeAs('result', $resultFileNameToStore, 'public'),
                'meta' => 'Result_Image',
            ];
            $data = [
                'title' => $request->get('title'),
                'description' => $request->get('description'),
            ];

//            dd($data);
            $d =Result::create($data);
            $d->image()->create($resultdata);
            Session::flash('success', 'Result was successfully created');
            return redirect()->route('result.index');

        } catch (\Exception $e) {
            Session::flash('fail', 'Result is not created');
            return redirect()->route('result.index');
        }
    }

    public function update(UpdateResult $request,Result $result){
        try {
            $resultdata=false;

            if ($request->file('result_image')) {
                //Result Image
                $resultFile = $request->file('result_image');
                $resultFilenameWithExt = $resultFile->getClientOriginalName();
                $resultFilename = pathinfo($resultFilenameWithExt, PATHINFO_FILENAME);
                $extension = $resultFile->getClientOriginalExtension();
                $resultFileNameToStore = $resultFilename . '_' . time() . '.' . $extension;

                $resultdata = [
                    'image' => $resultFilename,
                    'path' => $resultFile->storeAs('result', $resultFileNameToStore, 'public'),
                    'meta' => 'Result_Image',
                ];
            }

            $data = [
                'title' => $request->get('title'),
                'description' => $request->get('description'),
            ];

            $result->update($data);

            if ($resultdata) {
                $result->image()->update($resultdata);
            }
            Session::flash('success', 'Result was successfully edited');
            return redirect()->route('result.index');

        } catch (\Exception $e) {
            Session::flash('fail', 'Result failed to edit');
            return redirect()->route('result.index');
        }
    }

    public function destroy($id)
    {
        $result = Result::find($id);
        $result->delete();
        Session::flash('success', 'Result was deleted successfully');

        return redirect()->route('result.index');
    }
}
