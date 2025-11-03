<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\QueueEntry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    // mark entry as started (teacher presses Start)
    public function startEntry($code, $id) {
        $room = Room::where('code',$code)->firstOrFail();
        $entry = QueueEntry::where('room_id',$room->id)->findOrFail($id);

        // set any other in_progress to done/keep single in_progress (optionally)
        QueueEntry::where('room_id',$room->id)
            ->where('status','in_progress')
            ->update(['status'=>'done','finished_at'=>Carbon::now()]);

        $entry->update(['status'=>'in_progress','started_at'=>Carbon::now()]);
        return response()->json(['ok'=>true]);
    }

    // finish (teacher presses Done)
    public function finishEntry($code, $id) {
        $room = Room::where('code',$code)->firstOrFail();
        $entry = QueueEntry::where('room_id',$room->id)->findOrFail($id);
        $entry->update(['status'=>'done','finished_at'=>Carbon::now()]);

        // recalc avg_duration_seconds for the room (simple running average)
        if ($entry->started_at && $entry->finished_at) {
            $duration = Carbon::parse($entry->finished_at)->diffInSeconds(Carbon::parse($entry->started_at));

            // recompute avg: store total seconds of all done entries and divide
            $done = QueueEntry::where('room_id',$room->id)->where('status','done')->get();
            $sum = $done->reduce(function($carry,$e){
                if ($e->started_at && $e->finished_at) {
                    return $carry + Carbon::parse($e->finished_at)->diffInSeconds(Carbon::parse($e->started_at));
                }
                return $carry;
            }, 0);
            $avg = $done->count()
                ? max(0, intval($sum / $done->count()))
                : max(0, intval(($room->expected_duration_minutes ?? 0) * 60));
            $room->update(['avg_duration_seconds'=>$avg]);
        }

        // reassign positions: set position sequentially for waiting entries
        $waiting = QueueEntry::where('room_id',$room->id)->where('status','waiting')->orderBy('joined_at')->get();
        foreach ($waiting as $k => $w) {
            $w->update(['position' => $k+1]);
        }

        return response()->json(['ok'=>true,'avg'=>$room->avg_duration_seconds]);
    }

    public function removeEntry($code,$id){
        $room = Room::where('code',$code)->firstOrFail();
        QueueEntry::where('room_id',$room->id)->where('id',$id)->delete();
        // reindex
        $waiting = QueueEntry::where('room_id',$room->id)->where('status','waiting')->orderBy('joined_at')->get();
        foreach ($waiting as $k => $w) {
            $w->update(['position'=>$k+1]);
        }
        return response()->json(['ok'=>true]);
    }
}
