<?php

namespace App\Http\Controllers\Admin;

use App\CompetitionDetail;
use App\PerformerEntry;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ZipArchive;

class DashboardController extends Controller
{
    public function getPerformerEntry(PerformerEntry $performerEntry, User $studio)
    {
        return view('admin.dashboard.performerEntry', compact('performerEntry', 'studio'));
    }

    public function orderPerformerEntry(Request $request)
    {

        $entries = PerformerEntry::all();

        foreach ($entries as $performerEntry) {
            $performerEntry->timestamps = false; // To disable update_at field updation
            $id = $performerEntry->id;

            foreach ($request->orders as $order) {
                if ($order['id'] == $id) {
                    $performerEntry->update(['orderBy' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);

//       return response()->json(array('msg'=> $request->order), 200);
//       dd($request->all());
    }

    public function getEventPerformerEntry($id)
    {
        $event = CompetitionDetail::find($id);
//       $performerEntries=PerformerEntry::where('competitionDetail_id','=',$id)->where('status','=',1)->get();
        $performanceLevels = ['Amateur', 'Competitive', 'Elite', 'Pro Am'];

//        $performerEntries = PerformerEntry::getPerformerEntriesByDivisionNLevel();
        $performerEntries = PerformerEntry::getPerformerEntriesByDivisionNLevel($id);

        return view('admin.dashboard.eventPerformerEntries', compact('performerEntries', 'event', 'performanceLevels'));
    }


    public function downloadEventMusic($event)
    {

        $performerEntries=PerformerEntry::where('competitionDetail_id',$event)
                                        ->where('status',1)->get();

//        dd($performerEntries);
        $zipname = 'file.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);

        foreach ($performerEntries as $performerEntry){
//            dd($performerEntry->file->first()->url);
            $zip_a[]=$zip->addFile($performerEntry->file->first()->url);
        }
//        dd($zip_a);
        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }
}
