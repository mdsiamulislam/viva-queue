<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index(Request $request) {
        $rooms = Room::latest()->get();
        $isAdmin = $request->route() && $request->route()->getName() === 'rooms.index';

        // if admin take a password
        if ($isAdmin) {
            $password = $request->query('password');

            // If no password provided, prompt the user via a JS prompt and reload with the provided password as a query param
            if (!$password) {
                $script = "<!doctype html>
                    <html>
                    <head><meta charset=\"utf-8\"></head>
                    <body>
                    <script>
                    var p = prompt('Enter admin password:');
                    if (p === null) {
                        window.location.replace('/');
                    } else {
                        var url = new URL(window.location.href);
                        url.searchParams.set('password', p);
                        window.location.replace(url.toString());
                    }
                    </script>
                    </body>
                    </html>";
                return response($script, 200)->header('Content-Type', 'text/html');
            }

            // If password provided, validate it
            if ($password !== env('ADMIN_PASSWORD')) {
                $message = addslashes('Unauthorized access to admin panel.');
                return response("<script>alert('{$message}');window.location.replace('/');</script>", 403)
                    ->header('Content-Type', 'text/html');
            }
        }
        return view('rooms.index', ['rooms'=>$rooms, 'isAdmin'=>$isAdmin]);
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
        return redirect('/');
    }

    public function delete($id) {
        Room::destroy($id);
        return response('', 204);
    }
}
