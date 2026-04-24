<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    /**
     * Display a listing of alumni.
     */
    public function index()
    {
        return view('alumni.index');
    }

    /**
     * Get alumni data for DataTables (AJAX)
     */
    public function data(Request $request)
    {
        try {
            $alumni = Alumni::query();

            // Search
            if ($request->filled('search')) {
                $search = $request->search;
                $alumni->where(function ($q) use ($search) {
                    $q->where('student_code', 'like', "%{$search}%")
                      ->orWhere('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('current_workplace', 'like', "%{$search}%")
                      ->orWhere('current_position', 'like', "%{$search}%");
                });
            }

            // Filter by status
            if ($request->filled('status')) {
                $alumni->where('status', $request->status);
            }

            // Filter by graduation year
            if ($request->filled('year')) {
                $alumni->where('graduation_year', $request->year);
            }

            // Filter by job type
            if ($request->filled('job_type')) {
                $alumni->where('job_type', $request->job_type);
            }

            return response()->json([
                'data' => $alumni->orderBy('created_at', 'desc')->get()
            ]);
        } catch (\Exception $e) {
            // ถ้าตารางไม่มี ให้ return mock data
            $mockData = $this->getMockAlumni();
            
            // Filter mock data
            $filtered = collect($mockData);
            
            if ($request->filled('search')) {
                $search = strtolower($request->search);
                $filtered = $filtered->filter(function ($a) use ($search) {
                    return str_contains(strtolower($a['student_code']), $search) ||
                           str_contains(strtolower($a['first_name']), $search) ||
                           str_contains(strtolower($a['last_name']), $search) ||
                           str_contains(strtolower($a['current_workplace'] ?? ''), $search);
                });
            }
            
            if ($request->filled('status')) {
                $filtered = $filtered->where('status', $request->status);
            }
            
            if ($request->filled('year')) {
                $filtered = $filtered->where('graduation_year', (int)$request->year);
            }

            if ($request->filled('job_type')) {
                $filtered = $filtered->where('job_type', $request->job_type);
            }
            
            return response()->json([
                'data' => $filtered->values()->all()
            ]);
        }
    }

    /**
     * Get mock alumni data for demo
     */
    private function getMockAlumni()
    {
        return [
            [
                'id' => 1,
                'student_code' => '641102064001',
                'prefix' => 'นาย',
                'first_name' => 'สมชาย',
                'last_name' => 'ใจดี',
                'email' => 'somchai@email.com',
                'phone' => '0891234567',
                'graduation_year' => 2567,
                'degree' => 'ปริญญาตรี',
                'major' => 'วิทยาการคอมพิวเตอร์',
                'gpa' => 3.25,
                'current_workplace' => 'บริษัท ABC จำกัด',
                'current_position' => 'โปรแกรมเมอร์',
                'job_type' => 'related',
                'salary' => 25000,
                'province' => 'เพชรบูรณ์',
                'status' => 'employed',
                'created_at' => '2025-06-15 10:30:00',
                'updated_at' => '2025-06-15 10:30:00',
            ],
            [
                'id' => 2,
                'student_code' => '641102064002',
                'prefix' => 'นางสาว',
                'first_name' => 'สมหญิง',
                'last_name' => 'รักเรียน',
                'email' => 'somying@email.com',
                'phone' => '0891234568',
                'graduation_year' => 2567,
                'degree' => 'ปริญญาตรี',
                'major' => 'วิทยาการคอมพิวเตอร์',
                'gpa' => 3.65,
                'current_workplace' => 'มหาวิทยาลัยราชภัฏเพชรบูรณ์',
                'current_position' => 'นักศึกษาปริญญาโท',
                'job_type' => 'further_study',
                'salary' => null,
                'province' => 'เพชรบูรณ์',
                'status' => 'further_study',
                'created_at' => '2025-06-20 14:00:00',
                'updated_at' => '2025-06-20 14:00:00',
            ],
            [
                'id' => 3,
                'student_code' => '631102064015',
                'prefix' => 'นาย',
                'first_name' => 'วิชัย',
                'last_name' => 'เก่งกาจ',
                'email' => 'wichai@email.com',
                'phone' => '0891234569',
                'graduation_year' => 2566,
                'degree' => 'ปริญญาตรี',
                'major' => 'วิทยาการคอมพิวเตอร์',
                'gpa' => 2.85,
                'current_workplace' => 'ร้านคอมพิวเตอร์วิชัย',
                'current_position' => 'เจ้าของกิจการ',
                'job_type' => 'related',
                'salary' => 35000,
                'province' => 'เพชรบูรณ์',
                'status' => 'self_employed',
                'created_at' => '2024-05-10 09:00:00',
                'updated_at' => '2024-05-10 09:00:00',
            ],
            [
                'id' => 4,
                'student_code' => '631102064020',
                'prefix' => 'นางสาว',
                'first_name' => 'นภา',
                'last_name' => 'สดใส',
                'email' => 'napa@email.com',
                'phone' => '0891234570',
                'graduation_year' => 2566,
                'degree' => 'ปริญญาตรี',
                'major' => 'วิทยาการคอมพิวเตอร์',
                'gpa' => 3.45,
                'current_workplace' => 'บริษัท XYZ Tech จำกัด',
                'current_position' => 'Web Developer',
                'job_type' => 'related',
                'salary' => 30000,
                'province' => 'กรุงเทพมหานคร',
                'status' => 'employed',
                'created_at' => '2024-06-01 11:30:00',
                'updated_at' => '2024-06-01 11:30:00',
            ],
            [
                'id' => 5,
                'student_code' => '621102064008',
                'prefix' => 'นาย',
                'first_name' => 'ประสิทธิ์',
                'last_name' => 'มานะ',
                'email' => 'prasit@email.com',
                'phone' => '0891234571',
                'graduation_year' => 2565,
                'degree' => 'ปริญญาตรี',
                'major' => 'วิทยาการคอมพิวเตอร์',
                'gpa' => 2.50,
                'current_workplace' => null,
                'current_position' => null,
                'job_type' => 'other',
                'salary' => null,
                'province' => 'เพชรบูรณ์',
                'status' => 'unemployed',
                'created_at' => '2023-04-15 08:00:00',
                'updated_at' => '2023-04-15 08:00:00',
            ],
            [
                'id' => 6,
                'student_code' => '621102064012',
                'prefix' => 'นางสาว',
                'first_name' => 'พิมพ์ใจ',
                'last_name' => 'สุขสันต์',
                'email' => 'pimjai@email.com',
                'phone' => '0891234572',
                'graduation_year' => 2565,
                'degree' => 'ปริญญาตรี',
                'major' => 'วิทยาการคอมพิวเตอร์',
                'gpa' => 3.80,
                'current_workplace' => 'ธนาคารกรุงไทย',
                'current_position' => 'IT Support',
                'job_type' => 'related',
                'salary' => 28000,
                'province' => 'พิษณุโลก',
                'status' => 'employed',
                'created_at' => '2023-05-20 10:00:00',
                'updated_at' => '2023-05-20 10:00:00',
            ],
            [
                'id' => 7,
                'student_code' => '611102064025',
                'prefix' => 'นาย',
                'first_name' => 'อนุชา',
                'last_name' => 'พัฒนา',
                'email' => 'anucha@email.com',
                'phone' => '0891234573',
                'graduation_year' => 2564,
                'degree' => 'ปริญญาตรี',
                'major' => 'วิทยาการคอมพิวเตอร์',
                'gpa' => 3.15,
                'current_workplace' => 'โรงเรียนบ้านนา',
                'current_position' => 'ครูคอมพิวเตอร์',
                'job_type' => 'unrelated',
                'salary' => 18000,
                'province' => 'เพชรบูรณ์',
                'status' => 'employed',
                'created_at' => '2022-04-10 09:30:00',
                'updated_at' => '2022-04-10 09:30:00',
            ],
            [
                'id' => 8,
                'student_code' => '651102064050',
                'prefix' => 'นางสาว',
                'first_name' => 'กมลวรรณ',
                'last_name' => 'ศรีสุข',
                'email' => 'kamonwan@email.com',
                'phone' => '0891234574',
                'graduation_year' => 2568,
                'degree' => 'ปริญญาตรี',
                'major' => 'วิทยาการคอมพิวเตอร์',
                'gpa' => 3.55,
                'current_workplace' => 'บริษัท True Corporation',
                'current_position' => 'Software Engineer',
                'job_type' => 'related',
                'salary' => 35000,
                'province' => 'กรุงเทพมหานคร',
                'status' => 'employed',
                'created_at' => '2025-12-01 14:00:00',
                'updated_at' => '2025-12-01 14:00:00',
            ],
        ];
    }

    /**
     * Store a newly created alumni.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_code' => 'required|string|max:20|unique:alumni,student_code',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:2500|max:2600',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'gpa' => 'nullable|numeric|min:0|max:4',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:employed,unemployed,self_employed,further_study,other',
        ], [
            'student_code.required' => 'กรุณาระบุรหัสนักศึกษา',
            'student_code.unique' => 'รหัสนักศึกษานี้มีอยู่ในระบบแล้ว',
            'first_name.required' => 'กรุณาระบุชื่อ',
            'last_name.required' => 'กรุณาระบุนามสกุล',
            'graduation_year.required' => 'กรุณาระบุปีที่จบการศึกษา',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $alumni = Alumni::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'เพิ่มข้อมูลศิษย์เก่าสำเร็จ',
                'data' => $alumni
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'ไม่สามารถเพิ่มข้อมูลได้: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified alumni.
     */
    public function show($id)
    {
        try {
            $alumni = Alumni::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $alumni
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'ไม่พบข้อมูล'
            ], 404);
        }
    }

    /**
     * Update the specified alumni.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'student_code' => 'required|string|max:20|unique:alumni,student_code,' . $id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:2500|max:2600',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'gpa' => 'nullable|numeric|min:0|max:4',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:employed,unemployed,self_employed,further_study,other',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $alumni = Alumni::findOrFail($id);
            $alumni->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'แก้ไขข้อมูลศิษย์เก่าสำเร็จ',
                'data' => $alumni
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'ไม่สามารถแก้ไขข้อมูลได้'
            ], 500);
        }
    }

    /**
     * Remove the specified alumni.
     */
    public function destroy($id)
    {
        try {
            $alumni = Alumni::findOrFail($id);
            $alumni->delete();
            return response()->json([
                'success' => true,
                'message' => 'ลบข้อมูลศิษย์เก่าสำเร็จ'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'ไม่สามารถลบข้อมูลได้'
            ], 500);
        }
    }

    /**
     * Bulk delete alumni.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            Alumni::whereIn('id', $ids)->delete();
            return response()->json([
                'success' => true,
                'message' => 'ลบข้อมูลศิษย์เก่าสำเร็จ'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'ไม่สามารถลบข้อมูลได้'
            ], 500);
        }
    }

    /**
     * Get statistics for alumni.
     */
    public function statistics()
    {
        return view('alumni.statistics');
    }
}
