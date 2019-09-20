<?php

namespace App\Http\Controllers\Web;

use App\AgeClass;
use App\CompetitionDetail;
use App\Http\Controllers\Controller;
use App\PerformanceCategory;
use App\Performer;
use App\Result;
use App\Slider;
use Illuminate\Http\Request;
use Vinkla\Instagram\Instagram;

class PageController extends Controller
{

    public function instagramFeed(){
        $instagram=new Instagram('1695346704.1677ed0.9522d3a51dd54577893ff095983f8442');
        $instagram=$instagram->get();
        return $instagram;
    }
    public function getIndexPage()
    {
        $slides = Slider::limit(3)->get();
        $results=Result::latest()->limit(3)->get();
        $competitionDetails = CompetitionDetail::latest()->limit(3)->get();
        $instagram=$this->instagramFeed();
        return view('web.home', compact('competitionDetails', 'slides','results','instagram'));
    }

    public function getEntryForm()
    {
        $performers = Performer::all();
        $performanceCategories = PerformanceCategory::all();
        $ageClasses = AgeClass::all();
        return view('studio.entryForm.form', compact('competitionDetails', 'performers', 'performanceCategories', 'ageClasses'));
    }

    public function getTourPage(){
        $competitionDetails=CompetitionDetail::latest()->get();
        return view('web.tour',compact('competitionDetails'));
    }
}
