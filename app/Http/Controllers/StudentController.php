<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studmasterlist(Request $request)
    {
        $studentlist = $request->session()->get('students', []);

        $search = $request->input('search');

        if (!empty($search)) {
            $filtered = [];

            foreach ($studentlist as $student) {
                if (strpos(strtolower($student['name']), strtolower($search)) !== false) {
                    $filtered[] = $student;
                }
            }

            $studentlist = $filtered;
        }
        return view('student', compact('studentlist'));
    }


    public function addstudent(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'courseyear' => 'required',
        ]);

        $studentlist = $request->session()->get('students', []);

        $studentlist[] = [
            'id' => $request->id,
            'name' => $request->name,
            'courseyear' => $request->courseyear,
        ];

        $request->session()->put('students', $studentlist);

        return redirect()->route('student.list');
    }

    public function editstudent(Request $request, $index)
    {
        $studentlist = $request->session()->get('students', []);

        if (!isset($studentlist[$index])) {
            return redirect()->route('student.list')->with('error', 'Student not found.');
        }

        $student = $studentlist[$index];
        return view('student_edit', compact('student', 'index'));
    }

    public function updatestudent(Request $request, $index)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'courseyear' => 'required',
        ]);

        $studentlist = $request->session()->get('students', []);

        if (isset($studentlist[$index])) {
            $studentlist[$index] = [
                'id' => $request->id,
                'name' => $request->name,
                'courseyear' => $request->courseyear,
            ];
            $request->session()->put('students', $studentlist);
        }

        return redirect()->route('student.list')->with('success', 'Student updated successfully.');
    }

    public function deletestudent(Request $request, $index)
    {
        $studentlist = $request->session()->get('students', []);

        if (isset($studentlist[$index])) {
            unset($studentlist[$index]);
            $request->session()->put('students', array_values($studentlist)); // reindex array
        }

        return redirect()->route('student.list')->with('success', 'Student deleted successfully.');
    }


}
