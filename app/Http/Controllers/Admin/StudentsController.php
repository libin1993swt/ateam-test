<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Traits\StudentTrait;

use App\Models\Student;
use App\Models\Country;
use Illuminate\Http\Request;

class StudentsController extends Controller
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
            $students = Student::where('name', 'LIKE', "%$keyword%")
                ->orWhere('age', 'LIKE', "%$keyword%")
                ->orWhere('gender', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $students = Student::latest()->paginate($perPage);
        }

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $genders = $this->getGender();
        $countries = Country::orderBy('name')->get();
        return view('admin.students.create', compact('genders','countries'));
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
            'dob' => 'required',
            'gender' => 'required',
            'phone_number' => 'required|numberic',
            'email' => 'required|email|unqiue:students',
            'state_id' => 'required'
        ]);
        $requestData = $request->all();
        
        Student::create($requestData);

        return redirect('admin/students')->with('flash_message', 'Student added!');
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
        $student = Student::findOrFail($id);

        return view('admin.students.show', compact('student'));
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
        $student = Student::findOrFail($id);
        $genders = $this->getGender();
        $teachers = $this->getTeachers();
        return view('admin.students.edit', compact('student','genders','teachers'));
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
        
        $student = Student::findOrFail($id);
        $student->update($requestData);

        return redirect('admin/students')->with('flash_message', 'Student updated!');
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
        Student::destroy($id);

        return redirect('admin/students')->with('flash_message', 'Student deleted!');
    }
}
