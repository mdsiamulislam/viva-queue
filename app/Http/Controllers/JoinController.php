<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\QueueEntry;
use Carbon\Carbon;

class JoinController extends Controller
{
    public function showJoinPage($code,$isAdmin=false) {
        $room = Room::where('code', $code)->firstOrFail();
        return view('join.index', compact('room','isAdmin'));
    }


    public function join(Request $r, $code)
{
    $r->validate(['name' => 'required']);
    $room = Room::where('code', $code)->firstOrFail();

    // ✅ Block joining if scheduled start time not reached
    if (!empty($room->start_date) && !empty($room->start_time)) {
        try {
            // Ensure consistent timezone (Asia/Dhaka)
            $now = Carbon::now('Asia/Dhaka');

            // Normalize start_time (handles both '15:01' and '15:01:00')
            $startTime = substr($room->start_time, 0, 5);

            // Combine date + time into one Carbon instance
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $room->start_date . ' ' . $startTime, 'Asia/Dhaka');

            // ✅ Allow only if current time >= start time
            if ($now->lt($startDateTime)) {
                return redirect()->back()
                    ->withErrors([
                        'name' => '⏰ You cannot join before the scheduled start time (' 
                                   . $startDateTime->format('d M Y, h:i A') . ').'
                    ])
                    ->withInput();
            }
        } catch (\Exception $e) {
            \Log::error('⛔ Start time parse error: ' . $e->getMessage());
        }
    }

    // ✅ Calculate queue position
    $pos = $room->entries()
        ->whereIn('status', ['waiting', 'in_progress'])
        ->count() + 1;

    // ✅ Create new queue entry
    $entry = QueueEntry::create([
        'room_id' => $room->id,
        'name' => $r->name,
        'status' => 'waiting',
        'joined_at' => Carbon::now('Asia/Dhaka'),
        'position' => $pos,
    ]);

    // ✅ Redirect to queue page
    return redirect("/v/{$room->code}?joined=1&entry={$entry->id}");
}


    // JSON for polling the queue
    public function queueJson($code) {
        $room = Room::where('code',$code)->firstOrFail();
        $entries = $room->entries()
                        ->orderBy('status') // in_progress first? we will order explicit
                        ->orderBy('position')
                        ->get()
                        ->map(function($e){
                            return [
                                'id'=>$e->id,
                                'name'=>$e->name,
                                'status'=>$e->status,
                                'position'=>$e->position,
                                'joined_at'=>$e->joined_at?->toDateTimeString(),
                                'started_at'=>$e->started_at?->toDateTimeString(),
                                'finished_at'=>$e->finished_at?->toDateTimeString(),
                            ];
                        });

        // compute average duration
        $avg = $room->avg_duration_seconds ?: ($room->expected_duration_minutes * 60);

        return response()->json([
            'room' => [
                'id'=>$room->id,
                'title'=>$room->title,
                'zoom_link'=>$room->zoom_link,
                'expected_duration_minutes'=>$room->expected_duration_minutes,
                'avg_seconds'=>$avg,
            ],
            'entries'=>$entries,
        ]);
    }
}
