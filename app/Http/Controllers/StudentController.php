<?php

namespace App\Http\Controllers;

use PDF;
use App\Student;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the student.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $studentQuery = Student::query();
        $studentQuery->where('name', 'like', '%'.request('q').'%');
        $students = $studentQuery->paginate(25);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Student);

        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Student);

        $newStudent = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newStudent['creator_id'] = auth()->id();

        $student = Student::create($newStudent);

        return redirect()->route('students.show', $student);
    }

    /**
     * Display the specified student.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\View\View
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\View\View
     */
    public function edit(Student $student)
    {
        $this->authorize('update', $student);

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Student $student)
    {
        $this->authorize('update', $student);

        $studentData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $student->update($studentData);

        return redirect()->route('students.show', $student);
    }

    /**
     * Remove the specified student from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Student $student)
    {
        $this->authorize('delete', $student);

        $request->validate(['student_id' => 'required']);

        if ($request->get('student_id') == $student->id && $student->delete()) {
            return redirect()->route('students.index');
        }

        return back();
    }

    public function exportExcel()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    public function exportPdf()
    {
        $students = Student::all();

        $pdf = PDF::loadView('students.exports.index_pdf', compact('students'));
        return $pdf->stream('student.pdf');
    }
}
