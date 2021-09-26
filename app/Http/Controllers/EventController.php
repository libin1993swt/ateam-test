<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Event;
use App\Models\Invitees;
use App\Models\InviteesEvents;
use Illuminate\Http\Request;


class EventController extends Controller {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function list(Request $request) {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $events = Event::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $events = Event::latest()->paginate($perPage);
        }
        return view('admin.events.list', compact('events'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $event = Event::findOrFail($id);

        return view('admin.events.show', compact('event'));
    }
}