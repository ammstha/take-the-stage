<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSlider;
use App\Http\Requests\UpdateSlider;
use App\Slider;
use Session;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders=Slider::latest()->paginate(7);
        return view('admin.slider.index',compact('sliders'));
    }

    public function store(StoreSlider $request)
    {
        try {

            //Slider Image
            $sliderFile = $request->file('slider_image');
            $sliderFilenameWithExt = $sliderFile->getClientOriginalName();
            $sliderFilename = pathinfo($sliderFilenameWithExt, PATHINFO_FILENAME);
            $extension = $sliderFile->getClientOriginalExtension();
            $sliderFileNameToStore = $sliderFilename . '_' . time() . '.' . $extension;

            $sliderdata = [
                'image' => $sliderFilename,
                'path' => $sliderFile->storeAs('slider', $sliderFileNameToStore, 'public'),
                'meta' => 'Slider_Image',
            ];
            $data = [
                'title' => $request->get('title'),
                'description' => $request->get('description'),
            ];

//            dd($data);
            $d = Slider::create($data);
            $d->image()->create($sliderdata);
            Session::flash('success', 'Slider was successfully created');
            return redirect()->route('slider.index');

        } catch (\Exception $e) {

            Session::flash('fail', 'Slider is not created');
            return redirect()->route('slider.index');
        }
    }

    public function update(UpdateSlider $request,Slider $slider){
        try {
            $sliderdata=false;

            if ($request->file('slider_image')) {
                //Slider Image
                $sliderFile = $request->file('slider_image');
                $sliderFilenameWithExt = $sliderFile->getClientOriginalName();
                $sliderFilename = pathinfo($sliderFilenameWithExt, PATHINFO_FILENAME);
                $extension = $sliderFile->getClientOriginalExtension();
                $sliderFileNameToStore = $sliderFilename . '_' . time() . '.' . $extension;

                $sliderdata = [
                    'image' => $sliderFilename,
                    'path' => $sliderFile->storeAs('slider', $sliderFileNameToStore, 'public'),
                    'meta' => 'Slider_Image',
                ];
            }

            $data = [
                'title' => $request->get('title'),
                'description' => $request->get('description'),
            ];

            $slider->update($data);

            if ($sliderdata) {
                $slider->image()->update($sliderdata);
            }
            Session::flash('success', 'Slider was successfully edited');
            return redirect()->route('slider.index');

        } catch (\Exception $e) {
            Session::flash('fail', 'Slider failed to edit');
            return redirect()->route('slider.index');
        }
    }


    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        Session::flash('success', 'slider was deleted successfully');

        return redirect()->route('slider.index');
    }
}
