<?php

namespace App\Http\Controllers;

use App\CompetitionDetail;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitionDetails = CompetitionDetail::latest()->paginate(5);
        $paidPerformerEntries=auth()->user()->performerEntries()->where('status','1')->get();
        $studios=User::with('studio')->has('studio')->get();
//        $studios=User::with('studio')->has('studio')->get();
        return view('dashboard',compact('competitionDetails','paidPerformerEntries','studios'));
    }

    public function approval()
    {
        return view('studio.approval');
    }
}
