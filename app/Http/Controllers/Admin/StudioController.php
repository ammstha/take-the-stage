<?php

namespace App\Http\Controllers\Admin;

use App\CompetitionDetail;
use App\EventDateTime;
use App\Http\Requests\UpdateStudio;
use App\Mail\ApprovedStudio;
use App\PerformerEntry;
use App\Studio;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Session;
use ZipArchive;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studios = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'studio');
        })->latest()->paginate(10);
        return view('admin.studio.index', compact('studios'));
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $studio)
    {

        $studioPerformers = $studio->performerEntries;
        return view('admin.studio.show', compact('studioPerformers', 'studio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Studio $studio)
    {


        $states = [
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
        $sname = auth()->user()->name;
//        $sts = array();
//        foreach ($states as $state) {
//            $sts[$state->id] = $state->name;
//        }
        return view('admin.studio.edit', compact('studio', 'states', 'sname'));
//        return view('admin.studio.edit');
    }


    public function editevent($id)
    {
        $performerEntry_Id = $id;
        $competitionDetails = CompetitionDetail::latest()->get();
        return view('admin.studio.editEvent', compact('competitionDetails', 'performerEntry_Id'));
    }

    public function updateEvent(Request $request, $performerEntry_Id)
    {
        try {


            $performerEntry = PerformerEntry::where('id', $performerEntry_Id)->first();

//            dd($performerEntry->competitionDetail_id);



            $events = EventDateTime::where('competition_details_id', $request->get('competitionDetail_id'))->get();
//            dd($events);
            foreach ($events as $event) {
                //while negative
                while ($event->remainingTime >= 5) {
                    $remainTimeFirst = $event->remainingTime;
                    if ($performerEntry->division == "Solo") {
                        $minus = 4;
                    }
                    if ($performerEntry->division == "Duo/Trio") {
                        $minus = 4;
                    }
                    if ($performerEntry->division == "Small Group") {
                        $minus = 4;
                    }
                    if ($performerEntry->division == "Large Group") {
                        $minus = 5;
                    }
                    if ($performerEntry->division == "Line") {
                        $minus = 6;
                    }

                    $remainTimeAfter = $remainTimeFirst - $minus;
                    if ($performerEntry->exceed) {
                        $remainTimeAfter = $remainTimeFirst - $minus - 2;
                    }


                    $event->update(['remainingTime' => $remainTimeAfter]);
                    break;
                }
                break;
            }

            $addtimeEvents=EventDateTime::where('competition_details_id', $performerEntry->competitionDetail_id)->get();
            foreach ($addtimeEvents as $event) {
                //while negative
                while ($event->remainingTime >= 5) {
                    $remainTimeFirst = $event->remainingTime;
                    if ($performerEntry->division == "Solo") {
                        $minus = 4;
                    }
                    if ($performerEntry->division == "Duo/Trio") {
                        $minus = 4;
                    }
                    if ($performerEntry->division == "Small Group") {
                        $minus = 4;
                    }
                    if ($performerEntry->division == "Large Group") {
                        $minus = 5;
                    }
                    if ($performerEntry->division == "Line") {
                        $minus = 6;
                    }

                    $remainTimeAfter = $remainTimeFirst + $minus;
                    if ($performerEntry->exceed) {
                        $remainTimeAfter = $remainTimeFirst + $minus + 2;
                    }


                    $event->update(['remainingTime' => $remainTimeAfter]);
                    break;
                }
                break;
            }

            $performerEntry->update(['competitionDetail_id' => $request->competitionDetail_id]);
        } catch (\Exception $e) {

        }
        return redirect()->route('studio.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $studio)
    {
        $data = [
            'studioX' => $request->get('status'),
            'approved_at' => now(),
        ];
//
        if ($request->get('status')) {
            Mail::send(new ApprovedStudio($studio));
        }
        $studio->update($data);
        return redirect()->back();
    }

    public function updateStudio(UpdateStudio $request, Studio $studio)
    {
//        dd($request->all());
        try {
            $data = $request->data();
            $studio->update($data);

            $name = [
                'name' => $request->name
            ];
            if ($request->name) {
                $studio->user->update($name);
            }
            Session::flash('success', ' Studio was successfully updated');
            return redirect()->route('studio.index');

        } catch (\Exception $e) {
            Session::flash('success', 'Failed to Update');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studio = User::find($id);
        $studio->delete();
        Session::flash('success', 'Feature was deleted successfully');

        return redirect()->route('studio.index');
    }

    public function studioPDF(User $studio)
    {

        $pdf = PDF::loadView('admin.pdf.studiodetails', compact('studio'));
        return $pdf->stream('studio.pdf');
    }

    public function studiosPDF()
    {

//        $studioPerformers= $studio->performerEntries;
        $studios = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'studio');
        })->latest()->get();

        $pdf = PDF::loadView('admin.pdf.studiosdetails', compact('studios'));
        return $pdf->stream('studio.pdf');
    }

    public function downloadMusic()
    {
        $paidPerformerEntries = PerformerEntry::where('status', 1)->get();
        $zipname = 'file.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);

        foreach ($paidPerformerEntries as $performerEntry) {//        $file_arrays=[];
            $zip->addFile($performerEntry->file->first()->url);
//            $file_arrays=$performerEntry->file->first()->url;

        }
        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);

    }
}
