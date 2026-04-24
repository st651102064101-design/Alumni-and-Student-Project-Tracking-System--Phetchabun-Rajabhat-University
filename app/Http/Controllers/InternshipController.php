<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InternshipController extends Controller
{
    public function index()
    {
        return view('internships.index');
    }

    public function data(Request $request)
    {
        try {
            $internships = Internship::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $internships->where(function ($q) use ($search) {
                    $q->where('student_id', 'like', "%{$search}%")
                      ->orWhere('student_name', 'like', "%{$search}%")
                      ->orWhere('company_name', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $internships->where('status', $request->status);
            }

            if ($request->filled('year')) {
                $internships->where('academic_year', $request->year);
            }

            return response()->json([
                'data' => $internships->orderBy('created_at', 'desc')->get()
            ]);
        } catch (\Exception $e) {
            return response()->json(['data' => []]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|string|max:20',
            'student_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_address' => 'nullable|string',
            'job_role' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed',
            'academic_year' => 'required|string|max:4',
            'semester' => 'required|string|max:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            $internship = Internship::create($request->all());
            return response()->json(['success' => true, 'message' => 'เพิ่มข้อมูลสำเร็จ', 'data' => $internship]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'เกิดข้อผิดพลาด: '.$e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            return response()->json(['success' => true, 'data' => Internship::findOrFail($id)]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'ไม่พบข้อมูล'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|string|max:20',
            'student_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_address' => 'nullable|string',
            'job_role' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed',
            'academic_year' => 'required|string|max:4',
            'semester' => 'required|string|max:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            $internship = Internship::findOrFail($id);
            $internship->update($request->all());
            return response()->json(['success' => true, 'message' => 'แก้ไขข้อมูลสำเร็จ', 'data' => $internship]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'เกิดข้อผิดพลาด: '.$e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Internship::findOrFail($id)->delete();
            return response()->json(['success' => true, 'message' => 'ลบข้อมูลสำเร็จ']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'ไม่สามารถลบข้อมูลได้'], 500);
        }
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'กรุณาเลือกรายการที่ต้องการลบ'], 400);
        }
        try {
            Internship::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'ลบข้อมูลที่เลือกสำเร็จ']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'ไม่สามารถลบข้อมูลได้'], 500);
        }
    }
}
