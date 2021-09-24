<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Traits\StudentTrait;

use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    use StudentTrait;
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
            $marks = Mark::where('student_id', 'LIKE', "%$keyword%")
                ->orWhere('mark', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('term', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $marks = Mark::with('student')->latest()->paginate($perPage);
        }
        // dd($marks);
        return view('admin.marks.index', compact('marks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $terms = $this->getTerms();
        $subjects = $this->getSubjects();
        $students = Student::orderBy('name','asc')->get();
        return view('admin.marks.create',compact('terms','subjects','students'));
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
        
        $requestData = $request->all();
        
        Mark::create($requestData);

        return redirect('admin/marks')->with('flash_message', 'Mark added!');
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
        $mark = Mark::findOrFail($id);

        return view('admin.marks.show', compact('mark'));
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
        $mark = Mark::findOrFail($id);
        $terms = $this->getTerms();
        $subjects = $this->getSubjects();
        $students = Student::orderBy('name','asc')->get();
        return view('admin.marks.edit', compact('mark','terms','subjects','students'));
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
        
        $mark = Mark::findOrFail($id);
        $mark->update($requestData);

        return redirect('admin/marks')->with('flash_message', 'Mark updated!');
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
        Mark::destroy($id);

        return redirect('admin/marks')->with('flash_message', 'Mark deleted!');
    }
}
