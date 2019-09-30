<?php

namespace App\Http\Controllers\Studio;

use App\AgeClass;
use App\CompetitionDetail;
use App\Cost;
use App\Discount;
use App\EventDateTime;
use App\File;
use App\NationalCost;
use App\PerformerEntry;
use App\User;
use App\Http\Requests\StorePerformerEntry;
use App\PerformanceCategory;
use App\Performer;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class PerformerEntryController extends Controller
{
    public function index()
    {
        //here are some useless code that is that are in checkout method
        $countExceeds = PerformerEntry::where('exceed', '=', '1')->get();

        if ($countExceeds === null) {
            $totalPerformers = 0;
        } else {
            //count performer in performerEntry
            $countPerformer = [];
            foreach ($countExceeds as $countExceed) {
                $countPerformer[] = $countExceed->performers()->count();
            }
            $totalPerformers = array_sum($countPerformer);
        }
        $allPerformerEntries = auth()->user()->performerEntries()->get();

//        performerEntries that are not paid
        $performerEntries = auth()->user()->performerEntries()->where('status', '=', '0')->get();
        $a_performerEntries = [];
        foreach ($performerEntries as $key => $performerEntry) {
            $a_performerEntries[] = [
                'title' => $performerEntry->title,
//                'rebate_date'=>$performerEntry->eventDateTime->competitionDetails->rebate_date,
                'rebate_date' => $performerEntry->competitionDetail->rebate_date,
                'total_performers' => $performerEntry->performers()->count(),
                'today_date' => date("Y-m-d"),
            ];
            if (true) {
                if ($performerEntry->division === "Solo") {
                    $dCost = Cost::where('slug', 'solo')->first()->price;
                } else if ($performerEntry->division === "Duo/Trio") {
                    $dCost = Cost::where('slug', 'duo-trio')->first()->price;
                } else if ($performerEntry->division === "Small Group") {
                    $dCost = Cost::where('slug', 'small-group')->first()->price * $performerEntry->performers()->count();
                } else if ($performerEntry->division === "Large Group") {
                    $dCost = Cost::where('slug', 'large-group')->first()->price * $performerEntry->performers()->count();
                } else {
                    $dCost = Cost::where('slug', 'line')->first()->price * $performerEntry->performers()->count();
                }
//                else{
//                    $dCost=Cost::where('slug','event-cost')->first()->price;
//                }
                $dDiscount = Cost::where('slug', 'discount')->first()->price;
                $dRegular = Cost::where('slug', 'regular')->first()->price;
                $dExceed = Cost::where('slug', 'exceed')->first()->price;

                $rebate_date = $performerEntry->competitionDetail->rebate_date;
                $today_date = date("Y-m-d");
                $a_performerEntries[$key]['exceed'] = 0;
                $exceed = 0;
                if ($performerEntry->exceed === 1) {
                    $exceed = $performerEntry->performers()->count();
                    $a_performerEntries[$key]['exceed'] = $exceed;
                }
                if ($rebate_date > $today_date) {
                    $cost = $dCost + $dExceed * $exceed;
                    $charge = ($dRegular / 100) * $cost;
                    $totalCost = $cost + $charge;
                    $a_performerEntries[$key]['cost'] = $cost;
                    $a_performerEntries[$key]['discount'] = 0;
                    $a_performerEntries[$key]['charge'] = $charge;
                    $a_performerEntries[$key]['totalCost'] = $totalCost;
                }
                if ($rebate_date < $today_date) {
                    $dis = $dDiscount;
                    $cost = $dCost + $dExceed * $exceed;
                    $discount = ($dis / 100) * $cost;
                    $totalCost = $cost - $discount;
                    $a_performerEntries[$key]['cost'] = $cost;
                    $a_performerEntries[$key]['discount'] = $discount;
                    $a_performerEntries[$key]['charge'] = 0;
//                    Total cost of one performer Entries
                    $a_performerEntries[$key]['totalCost'] = $totalCost;
                }
            }
        }
//       Total Cost of overall performer Entrire
        $total_Cost = [];
        foreach ($a_performerEntries as $pEntry) {
            $total_Cost[] = $pEntry['totalCost'];
        }
        $total_Cost_Sum = array_sum($total_Cost);

        // true if the total performer in the performer entry is >= 10
        if ($performerEntries) {
            //count performer in performerEntry
            $countPerformerEntry = false;
            foreach ($performerEntries as $performerEntry) {
                if ($performerEntry->performers()->count() >= 10) {
                    $countPerformerEntry = true;
                    break;
                }
            }
        }

        $duoTrioPerformer = auth()->user()->performerEntries()->where('division', '=', 'Duo/Trio')->count();
        $soloPerformer = auth()->user()->performerEntries()->where('division', '=', 'solo')->count();
        return view('studio.performerEntry.index', compact('performerEntries',
            'totalPerformers', 'countPerformerEntry', 'duoTrioPerformer',
            'soloPerformer', 'a_performerEntries', 'total_Cost_Sum', 'allPerformerEntries'));
    }

    public function create($id =null)
    {
        $competitionDetail=null;
        if($id){
            $competitionDetail=CompetitionDetail::find($id);
        }
        $competitionDetails = CompetitionDetail::latest()->get();
        $performers = auth()->user()->performers()->get();
        $performanceCategories = PerformanceCategory::all();
        $ageClasses = AgeClass::all();
        return view('studio.performerEntry.create', compact('competitionDetails', 'competitionDetails','competitionDetail', 'performers', 'performanceCategories', 'ageClasses'));

    }

    public function store(StorePerformerEntry $request)
    {
        try {
            //File
            if ($request->file('music')) {
                $file = $request->file('music');
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = str_replace(' ', '-', auth()->user()->name) . '_' . $request->get('title') . '_' . time() . '.' . $extension;

                $filedata = [
                    'file' => $filename,
                    'path' => $file->storeAs('file', $fileNameToStore, 'public'),
                    'meta' => 'Music',
                ];
            }


            $data = [
                'title' => $request->get('title'),
                'division' => $request->get('division'),
                'age_class' => $request->get('age_class'),
                'average_age' => $request->get('average_age'),
                'performance_level' => $request->get('performance_level'),
//               'eventDateTime_id' => $request->get('eventDateTime_id'),
                'competitionDetail_id' => $request->get('competitionDetail_id'),
                'exceed' => $request->has('exceed') ? true : false,
                'donate' => $request->has('donate') ? true : false,
                'prop' => $request->has('prop') ? true : false,
                'status' => $request->has('status') ? true : false,

            ];
//            $events = EventDateTime::where('competition_details_id', $request->get('competitionDetail_id'))->get();
//            foreach ($events as $event) {
//                //while negative
//                while ($event->remainingTime >= 5) {
//                    $remainTimeFirst = $event->remainingTime;
//                    $remainTimeAfter = $remainTimeFirst - 3;
//                    if ($request->has('exceed')) {
//                        $remainTimeAfter = $remainTimeFirst - 5;
//                    }
//
//                    $event->update(['remainingTime' => $remainTimeAfter]);
//                    break;
//                }
//            }

            $m = auth()->user()->performerEntries()->create($data);
            if ($request->file('music')) {
                $m->file()->create($filedata);
            }
            $m->performers()->sync($request->get('performers'));
            $m->performanceCategories()->sync($request->get('performanceCategories'));
            Session::flash('success', ' successfully created!');
            return redirect()->route('studio.performerEntry.index');

        } catch (\Exception $e) {
            dd($e);
            Session::flash('fail', ' Failed to create created!');
            return redirect()->route('studio.performerEntry.index');
        }

    }

    public function show($id)
    {
        //
    }

    public function edit(PerformerEntry $performerEntry)
    {
        $competitionDetails = CompetitionDetail::latest()->get();
        $comDetails = array();
        foreach ($competitionDetails as $competitionDetail) {
            $comDetails[$competitionDetail->id] = $competitionDetail->name;
        }

        $performers = auth()->user()->performers()->get();
        $perfs = array();
        foreach ($performers as $performer) {
//            $perfs[$performer->id] = $performer->id;


            $perfs[$performer->id] = [
                'id' => $performer->id,
                'first_name' => $performer->first_name,
                'last_name' => $performer->last_name,
                'age' => $performer->age,
                'p-level' => $performer->performanceLevel->name,
            ];
        }

        return view('studio.performerEntry.edit', compact('performerEntry', 'comDetails', 'perfs'));
    }

    public function update(Request $request, PerformerEntry $performerEntry)
    {
//        dd($request->all());

        try {
            $filedata = false;

            if ($request->file('music')) {
                $file = $request->file('music');
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $filedata = [
                    'file' => $filename,
                    'path' => $file->storeAs('file', $fileNameToStore, 'public'),
                    'meta' => 'Music',
                ];
            }

            $data = [
                'title' => $request->get('title'),
                'division' => $request->get('division'),
                'age_class' => $request->get('age_class'),
                'average_age' => $request->get('average_age'),
                'performance_level' => $request->get('performance_level'),
                'competitionDetail_id' => $request->get('competitionDetail_id'),
                'exceed' => $request->has('exceed') ? true : false,
                'donate' => $request->has('donate') ? true : false,
                'prop' => $request->has('prop') ? true : false,
                'status' => $request->has('status') ? true : false,
            ];
            $performerEntry->update($data);
            if ($filedata) {
                $performerEntry->image()->update($filedata);
            }
            if (isset($request->performers)) {
                $performerEntry->performers()->sync($request->performers);
            } else {
                $performerEntry->performers()->sync(array());
            }
            Session::flash('success', ' successfully Edited!');
            return redirect()->route('studio.performerEntry.index');
        } catch (\Exception $e) {
            Session::flash('fail', 'Failed to Edit!');
            return redirect()->route('studio.performerEntry.index');
        }
    }

    public function destroy($performerEntry)
    {
        try {
            $performerEntry = PerformerEntry::find($performerEntry);
            $performerEntry->file()->delete();
            $performerEntry->performers()->detach();
            $performerEntry->performanceCategories()->detach();
            $performerEntry->delete();
            Session::flash('success', 'Performer Entry was deleted successfully');

            return redirect()->route('studio.performerEntry.index');
        } catch (\Exception $e) {
            Session::flash('fail', 'Performer Entry failed to delete');
            return redirect()->route('studio.performerEntry.index');
        }

    }

    public function getStudioPerformerEntry(PerformerEntry $paidPerformerEntry)
    {

        return view('studio.dashboard.performerEntry', compact('paidPerformerEntry'));
    }

    public function checkout()
    {


//        performerEntries that are not paid
        $performerEntries = auth()->user()->performerEntries()->where('status', '=', '0')->get();
        $a_performerEntries = [];
        foreach ($performerEntries as $key => $performerEntry) {
            if ($performerEntry->competitionDetail->eGroup == "National") {
                $cost_eGroup = new NationalCost();
            } else {
                $cost_eGroup = new Cost();
            }
            $a_performerEntries[] = [
                'competition_detail_id'=>$performerEntry->competitionDetail_id,
                'division'=>$performerEntry->division,
                'exceed'=>$performerEntry->exceed,
                'prop'=>$performerEntry->prop,
                'performerEntry' => $performerEntry->competitionDetail()->first(),
                'event_name' => $performerEntry->competitionDetail->name,
                'title' => $performerEntry->title,
//                'rebate_date'=>$performerEntry->eventDateTime->competitionDetails->rebate_date,
                'rebate_date' => $performerEntry->competitionDetail->rebate_date,
                'total_performers' => $performerEntry->performers()->count(),
                'today_date' => date("Y-m-d"),
            ];
            if (true) {
                if ($performerEntry->division === "Solo") {
                    $dCost = $cost_eGroup->where('slug', 'solo')->first()->price;
                } else if ($performerEntry->division === "Duo/Trio") {
                    $dCost = $cost_eGroup->where('slug', 'duo-trio')->first()->price;
                } else if ($performerEntry->division === "Small Group") {
                    $dCost = $cost_eGroup->where('slug', 'small-group')->first()->price * $performerEntry->performers()->count();
                } else if ($performerEntry->division === "Large Group") {
                    $dCost = $cost_eGroup->where('slug', 'large-group')->first()->price * $performerEntry->performers()->count();
                } else {
                    $dCost = $cost_eGroup->where('slug', 'line')->first()->price * $performerEntry->performers()->count();
                }
//                else{
//                    $dCost=   $cost_eGroup->where('slug','event-cost')->first()->price;
//                }
                $dDiscount = $cost_eGroup->where('slug', 'discount')->first()->price;
                $dRegular = $cost_eGroup->where('slug', 'regular')->first()->price;
                $dExceed = $cost_eGroup->where('slug', 'exceed')->first()->price;

                $rebate_date = $performerEntry->competitionDetail->rebate_date;
                $today_date = date("Y-m-d");
                $a_performerEntries[$key]['exceed'] = 0;
                $exceed = 0;
                if ($performerEntry->exceed === 1) {
                    $exceed = $performerEntry->performers()->count();
                    $a_performerEntries[$key]['exceed'] = $exceed;
                }
                if ($rebate_date > $today_date) {
                    $cost = $dCost + $dExceed * $exceed;
//                    $charge=($dRegular/100)*$cost;
                    $charge = $dRegular;
                    $totalCost = $cost + $charge;
                    $a_performerEntries[$key]['cost'] = $cost;
                    $a_performerEntries[$key]['discount'] = 0;
                    $a_performerEntries[$key]['charge'] = $charge;
                    $a_performerEntries[$key]['totalCost'] = $totalCost;
                }
                if ($rebate_date < $today_date) {
                    $dis = $dDiscount;
                    $cost = $dCost + $dExceed * $exceed;
                    $discount = ($dis / 100) * $cost;
                    $totalCost = $cost - $discount;
                    $a_performerEntries[$key]['cost'] = $cost;
                    $a_performerEntries[$key]['discount'] = $discount;
                    $a_performerEntries[$key]['charge'] = 0;
//                    Total cost of one performer Entries
                    $a_performerEntries[$key]['totalCost'] = $totalCost;
                }
            }
        }


//       Total Cost of overall performer Entrire
        $total_Cost = [];
        foreach ($a_performerEntries as $pEntry) {
            $total_Cost[] = $pEntry['totalCost'];
        }
        $total_Cost_Sum = array_sum($total_Cost);

        // true if the total performer in the performer entry is >= 10
        if ($performerEntries) {
            //count performer in performerEntry
            $countPerformerEntry = false;
            foreach ($performerEntries as $performerEntry) {
                if ($performerEntry->performers()->count() >= 10) {
                    $countPerformerEntry = true;
                    break;
                }
            }
        }

        $duoTrioPerformer = auth()->user()->performerEntries()->where('division', '=', 'Duo/Trio')->count();
        $soloPerformer = auth()->user()->performerEntries()->where('division', '=', 'solo')->count();


        //count the total no of performer Entries
        $performerEntriesCount = $performerEntries->count();
        // true if the total performer in the performer entry is >= 10
        $perfromerCount = $countPerformerEntry;
        if (!($performerEntriesCount >= 5 || $perfromerCount)) {
            Session::flash('fail', 'A minimum of 5 entries or 10 participating dancers per studio is required to compete.');
            return redirect()->back();
        }


        if ($duoTrioPerformer >= 5 || $soloPerformer >= 5) {
            Session::flash('fail', 'A maximum of 5 Solo and 5 Duo Trio entries per studio is allowed');
            return redirect()->back();
        } else {
            return view('studio.performerEntry.checkout', compact('performerEntries',
                'totalPerformers', 'countPerformerEntry', 'duoTrioPerformer',
                'soloPerformer', 'a_performerEntries', 'total_Cost_Sum'));
        }


    }

    public function notPaidData()
    {

//        performerEntries that are not paid
        $performerEntries = auth()->user()->performerEntries()->where('status', '=', '0')->get();
        $a_performerEntries = [];
        foreach ($performerEntries as $key => $performerEntry) {
            $a_performerEntries[] = [
                'p' => $performerEntry,
                'performerEntry' => $performerEntry->competitionDetail()->first(),
                'event_name' => $performerEntry->competitionDetail->name,
                'title' => $performerEntry->title,
//                'rebate_date'=>$performerEntry->eventDateTime->competitionDetails->rebate_date,
                'rebate_date' => $performerEntry->competitionDetail->rebate_date,
                'total_performers' => $performerEntry->performers()->count(),
                'today_date' => date("Y-m-d"),
            ];
            if (true) {
                if ($performerEntry->division === "Solo") {
                    $dCost = Cost::where('slug', 'solo')->first()->price;
                } else if ($performerEntry->division === "Duo/Trio") {
                    $dCost = Cost::where('slug', 'duo-trio')->first()->price;
                } else if ($performerEntry->division === "Small Group") {
                    $dCost = Cost::where('slug', 'small-group')->first()->price * $performerEntry->performers()->count();
                } else if ($performerEntry->division === "Large Group") {
                    $dCost = Cost::where('slug', 'large-group')->first()->price * $performerEntry->performers()->count();
                } else {
                    $dCost = Cost::where('slug', 'line')->first()->price * $performerEntry->performers()->count();
                }
//                else{
//                    $dCost=Cost::where('slug','event-cost')->first()->price;
//                }
                $dDiscount = Cost::where('slug', 'discount')->first()->price;
                $dRegular = Cost::where('slug', 'regular')->first()->price;
                $dExceed = Cost::where('slug', 'exceed')->first()->price;

                $rebate_date = $performerEntry->competitionDetail->rebate_date;
                $today_date = date("Y-m-d");
                $a_performerEntries[$key]['exceed'] = 0;
                $exceed = 0;
                if ($performerEntry->exceed === 1) {
                    $exceed = $performerEntry->performers()->count();
                    $a_performerEntries[$key]['exceed'] = $exceed;
                }
                if ($rebate_date > $today_date) {
                    $cost = $dCost + $dExceed * $exceed;
//                    $charge=($dRegular/100)*$cost;
                    $charge = $dRegular;
                    $totalCost = $cost + $charge;
                    $a_performerEntries[$key]['cost'] = $cost;
                    $a_performerEntries[$key]['discount'] = 0;
                    $a_performerEntries[$key]['charge'] = $charge;
                    $a_performerEntries[$key]['totalCost'] = $totalCost;
                }
                if ($rebate_date < $today_date) {
                    $dis = $dDiscount;
                    $cost = $dCost + $dExceed * $exceed;
                    $discount = ($dis / 100) * $cost;
                    $totalCost = $cost - $discount;
                    $a_performerEntries[$key]['cost'] = $cost;
                    $a_performerEntries[$key]['discount'] = $discount;
                    $a_performerEntries[$key]['charge'] = 0;
//                    Total cost of one performer Entries
                    $a_performerEntries[$key]['totalCost'] = $totalCost;
                }
            }
        }
//       Total Cost of overall performer Entrire
        $total_Cost = [];
        foreach ($a_performerEntries as $pEntry) {
            $total_Cost[] = $pEntry['totalCost'];
        }
        $total_Cost_Sum = array_sum($total_Cost);

        // true if the total performer in the performer entry is >= 10
        if ($performerEntries) {
            //count performer in performerEntry
            $countPerformerEntry = false;
            foreach ($performerEntries as $performerEntry) {
                if ($performerEntry->performers()->count() >= 10) {
                    $countPerformerEntry = true;
                    break;
                }
            }
        }

        $duoTrioPerformer = auth()->user()->performerEntries()->where('division', '=', 'Duo/Trio')->count();
        $soloPerformer = auth()->user()->performerEntries()->where('division', '=', 'solo')->count();


        //count the total no of performer Entries
        $performerEntriesCount = $performerEntries->count();
        // true if the total performer in the performer entry is >= 10
        $perfromerCount = $countPerformerEntry;
        if (!($performerEntriesCount >= 5 || $perfromerCount)) {
            Session::flash('fail', 'A minimum of 5 entries or 10 participating dancers per studio is required to compete.');
            return redirect()->back();
        }


        if ($duoTrioPerformer >= 5 || $soloPerformer >= 5) {
            Session::flash('fail', 'A maximum of 5 Solo and 5 Duo Trio entries per studio is allowed');
            return redirect()->back();
        } else {
            $data = [
                'perfromerEntries' => $performerEntries,
                'countPerformerEntry' => $countPerformerEntry,
                'duoTrioPerformer' => $duoTrioPerformer,
                'soloPerformer' => $soloPerformer,
                'a_performerEntries' => $a_performerEntries,
                'total_Cost_Sum' => $total_Cost_Sum,

            ];
            return $data;
        }

    }

    public function generatePdf()
    {
        $data = $this->notPaidData();
        $pdf = PDF::loadView('studio.pdf.report', $data);
        return $pdf->download('report.pdf');
    }

    public function duplicate(PerformerEntry $performerEntry)
    {
        $competitionDetails = CompetitionDetail::latest()->get();

        $music = $performerEntry->file()->first();

        $performers = Performer::all();
        $perfs = array();
        foreach ($performers as $performer) {
            $perfs[$performer->id] = [
                'id' => $performer->id,
                'first_name' => $performer->first_name,
                'last_name' => $performer->last_name,
                'age' => $performer->age,
                'p-level' => $performer->performanceLevel->name,
            ];
        }

        return view('studio.performerEntry.duplicate', compact('performerEntry', 'competitionDetails', 'perfs', 'music'));
    }

    public function duplicateCreate(StorePerformerEntry $request)
    {

        try {
            //File

            $music = File::where('id', $request->music)->first();
            $filedata = [
                'file' => $music->file,
                'path' => $music->path,
                'meta' => 'Music',
            ];

            $data = [
                'title' => $request->get('title'),
                'division' => $request->get('division'),
                'age_class' => $request->get('age_class'),
                'average_age' => $request->get('average_age'),
                'performance_level' => $request->get('performance_level'),
//               'eventDateTime_id' => $request->get('eventDateTime_id'),
                'competitionDetail_id' => $request->get('competitionDetail_id'),
                'exceed' => $request->has('exceed') ? true : false,
                'donate' => $request->has('donate') ? true : false,
                'prop' => $request->has('prop') ? true : false,
                'status' => $request->has('status') ? true : false,

            ];

            $events = EventDateTime::where('competition_details_id', $request->get('competitionDetail_id'))->get();
            foreach ($events as $event) {
                //while negative
                while ($event->remainingTime >= 5) {
                    $remainTimeFirst = $event->remainingTime;
                    $remainTimeAfter = $remainTimeFirst - 3;
                    if ($request->has('exceed')) {
                        $remainTimeAfter = $remainTimeFirst - 5;
                    }

                    $event->update(['remainingTime' => $remainTimeAfter]);
                    break;
                }
            }

            $m = auth()->user()->performerEntries()->create($data);
            $m->file()->create($filedata);
            $m->performers()->sync($request->get('performers'));
            $m->performanceCategories()->sync($request->get('performanceCategories'));
            Session::flash('success', ' successfully created!');
            return redirect()->route('studio.performerEntry.index');

        } catch (\Exception $e) {
            Session::flash('fail', ' failed to  created!');
            return redirect()->route('studio.performerEntry.index');
        }
    }
}
