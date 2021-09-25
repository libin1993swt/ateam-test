<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Traits\StudentTrait;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use StudentTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function list(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $events = Event::where('student_id', 'LIKE', "%$keyword%")
                ->orWhere('mark', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('term', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $events = Event::latest()->paginate($perPage);
        }
        return view('admin.events.list', compact('events'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $events = Event::where('student_id', 'LIKE', "%$keyword%")
                ->orWhere('mark', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('term', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $events = Event::latest()->paginate($perPage);
        }
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|date_format:d-m-Y|date',
            'end_date' => 'required|date_format:d-m-Y|date'
        ]);

        $requestData = $request->all();
        $requestData['start_date'] = date('Y-m-d',strtotime($requestData['start_date']));
        $requestData['end_date'] = date('Y-m-d',strtotime($requestData['end_date']));
        
        Event::create($requestData);

        return redirect('events')->with('flash_message', 'Event added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|date_format:d-m-Y|date',
            'end_date' => 'required|date_format:d-m-Y|date'
        ]);

        $event = Event::findOrFail($id);
        $requestData['start_date'] = date('Y-m-d',strtotime($requestData['start_date']));
        $requestData['end_date'] = date('Y-m-d',strtotime($requestData['end_date']));
        $event->update($requestData);

        return redirect('events')->with('flash_message', 'Event updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Event::destroy($id);

        return redirect('admin/events')->with('flash_message', 'Event deleted!');
    }
}
