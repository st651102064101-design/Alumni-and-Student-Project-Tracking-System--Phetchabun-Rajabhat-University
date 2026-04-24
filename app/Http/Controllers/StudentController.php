<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function list(Request $request)
    {
        $students = Student::select('std_id', 'first_name', 'last_name')
            ->orderBy('std_id')
            ->get();
        $results = $students->map(function($s) {
            return [
                'id' => $s->std_id,
                'text' => $s->std_id . ' - ' . trim($s->first_name . ' ' . $s->last_name),
                'student_name' => trim($s->first_name . ' ' . $s->last_name)
            ];
        });
        return response()->json(['results' => $results]);
    }
}
