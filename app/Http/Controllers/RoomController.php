<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index() {
        $rooms = Room::latest()->get();
        return view('rooms.index', compact('rooms'));
    }

    public function create() {
        return view('rooms.create');
    }

    public function store(Request $r) {
        $r->validate([
            'title'=>'required|string',
            'expected_duration_minutes'=>'required|integer|min:1',
        ]);
        $room = Room::create([
            'title'=>$r->title,
            'code'=>Str::random(8),
            'zoom_link'=>$r->zoom_link,
            'start_time'=>$r->start_time ?: null,
            'expected_duration_minutes'=>$r->expected_duration_minutes,
        ]);
        return redirect('/v/'.$room->code);
    }
}
