<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = Event::where('user_id', auth()->user()->id)->get();

        return view('home', compact('events'));
    }

    public function calendar()
    {
        $events = Event::where('user_id', auth()->user()->id)->get();

        return view('calendar', compact('events'));
    }

    public function ajaxUpdate(Request $request)
    {
        $event = Event::updateOrCreate(['date' => $request->date, 'user_id' => auth()->user()->id], $request->only('description'));

        return $request->all();
    }

    public function fetchEvent(Request $request)
    {
        $event = Event::where('date', $request->date)->where('user_id', auth()->user()->id)->first();

        return $event->description ?? false;
    }

    public function deleteEvent($date)
    {
        $event = Event::where('date', $date)->where('user_id', auth()->user()->id)->count();

        if($event == 0) return false;

        Event::where('date', $date)->where('user_id', auth()->user()->id)->first()->delete();

        return true;
    }
}
