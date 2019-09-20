<?php

namespace App\Http\Controllers\Admin;

use App\CompetitionDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompetitionDetails;
use App\Http\Requests\UpdateCompetitionDetails;
use App\PerformerEntry;
use Illuminate\Http\Request;
use Session;

class CompetitionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitionDetails = CompetitionDetail::latest()->paginate(7);
        return view('admin.competitionDetails.index', compact('competitionDetails'));
    }

    public function create()
    {
        return view('admin.competitionDetails.create');
    }

    public function store(StoreCompetitionDetails $request)
    {

//        dd($request->all());
        try {
            $data = $request->data();
            $events = $request->eventData();
//            dd($data);
            $competitionDetails = CompetitionDetail::create($data);

            foreach ($events as $event) {
                $competitionDetails->eventDateTimes()->create($event);
            }
            Session::flash('success', 'New Competition was successfully added');
        } catch (\Exception $e) {
            return $e;
            Session::flash('fail', 'New Competition was not created or already created');
        }

        return redirect()->route('competitionDetail.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompetitionDetail $competitionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CompetitionDetail $competitionDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompetitionDetail $competitionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CompetitionDetail $competitionDetail)
    {
      $eventDateTimes=$competitionDetail->eventDateTimes()->get();
      return view('admin.competitionDetails.edit',compact('competitionDetail','eventDateTimes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\CompetitionDetail $competitionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompetitionDetails $request,CompetitionDetail $competitionDetail)
    {

        try {
            $data = $request->data();
            $events = $request->eventData();
            $competitionDetail->update($data);
            foreach ($events as $event) {
                if (isset($event['id'])) {
                    $e = $competitionDetail->eventDateTimes()->where('id', $event['id'])->first();
                }else{
                    $e=$competitionDetail->eventDateTimes()->create($event);
                }
                $e->update($event);
            }
            Session::flash('success', 'New Competition was successfully edited');
        } catch (\Exception $e) {
            return $e;
            Session::flash('fail', 'New Competition was not created or already created');
        }

        return redirect()->route('competitionDetail.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompetitionDetail $competitionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($competitionDetail)
    {

        $countPerformerEntry = PerformerEntry::where('competitionDetail_id', $competitionDetail)->count();
        if ($countPerformerEntry == 0) {
            $competitionDetail=CompetitionDetail::find($competitionDetail);
            foreach($competitionDetail->eventDateTimes as $eventDateTime){
                $eventDateTime->delete();
            }
            $competitionDetail->delete();
            Session::flash('success', 'Competition Details was deleted successfully');
        }
        else{
            Session::flash('fail', 'Performer Entries already exist');
        }
        return redirect()->route('competitionDetail.index');
    }
}
