<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\AuthApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AuthenController extends Controller
{
    private AuthApiService $authApi;

    public function __construct(AuthApiService $authApi)
    {
        $this->authApi = $authApi;
    }

    private function shouldBypassLogin(): bool
    {
        return env('LOGIN_BYPASS', false);
    }

    private function mockLogin()
    {
        $student = Student::firstOrCreate([
            'std_id' => '000000'
        ],[
            'std_id' => '000000',
            'first_name' => 'Mock',
            'last_name' => 'User',
        ]);

        auth()->login($student);

        return redirect()->route('dashboard');
    }

    public function index()
    {
        return view('authen.login');
    }

    public function mockup()
    {
        return $this->mockLogin();
    }

    public function verify(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $result = $this->authApi->authenticate(
            $request->username,
            $request->password
        );

        if(!$result['success']){
            return redirect()->route('login')->with('error', $result['error']);
        }else{
            $data = $result['data']['data'];

            $student = Student::updateOrCreate([
                'std_id' => $data['STD_CODE']
            ],[
                'std_id' => $data['STD_CODE'],
                'first_name' => $data['FIRST_NAME'],
                'last_name' => $data['LAST_NAME'],
            ]);

            auth()->login($student);

            return redirect()->route('dashboard');
        }
    }

    function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    /**
     * Store or update a student record from the modal form.
     * Accepts: std_id, first_name, last_name, email, phone, photo_id (file), attachments[] (files)
     */
    public function store(Request $request)
    {
        Log::info('AuthenController@store called', ['user' => auth()->id() ?? null, 'input' => $request->only(['std_id','first_name','last_name','email','phone'])]);
        try {
            $validated = $request->validate([
                'std_id' => 'required|string|max:255',
                'first_name' => 'nullable|string|max:191',
                'last_name' => 'nullable|string|max:191',
                'email' => 'nullable|email|max:191',
                'phone' => 'nullable|string|max:50',
                'photo_id' => 'nullable|file|image|max:5120',
                'attachments.*' => 'nullable|file|max:10240',
            ]);

            $data = $request->only(['std_id','first_name','last_name','email','phone']);

            if ($request->hasFile('photo_id')) {
                $path = $request->file('photo_id')->store('students/photos', 'public');
                $data['photo_id'] = $path;
            }

            if ($request->hasFile('attachments')) {
                $paths = [];
                foreach ($request->file('attachments') as $f) {
                    $paths[] = $f->store('students/attachments', 'public');
                }
                $data['attachments'] = json_encode($paths);
            }

            $student = Student::updateOrCreate([
                'std_id' => $data['std_id']
            ], $data);

            return response()->json(['success' => true, 'student' => $student]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update an existing student by id.
     */
    public function update(Request $request, $id)
    {
        Log::info('AuthenController@update called', ['user' => auth()->id() ?? null, 'id' => $id, 'input' => $request->only(['std_id','first_name','last_name','email','phone'])]);
        try {
            $student = Student::findOrFail($id);

            $validated = $request->validate([
                'std_id' => 'required|string|max:255',
                'first_name' => 'nullable|string|max:191',
                'last_name' => 'nullable|string|max:191',
                'email' => 'nullable|email|max:191',
                'phone' => 'nullable|string|max:50',
                'photo_id' => 'nullable|file|image|max:5120',
                'attachments.*' => 'nullable|file|max:10240',
            ]);

            $data = $request->only(['std_id','first_name','last_name','email','phone']);

            if ($request->hasFile('photo_id')) {
                // delete old photo if exists
                if($student->photo_id){
                    Storage::disk('public')->delete($student->photo_id);
                }
                $path = $request->file('photo_id')->store('students/photos', 'public');
                $data['photo_id'] = $path;
            }

            if ($request->hasFile('attachments')) {
                // delete old attachments if exist
                if($student->attachments){
                    $old = is_string($student->attachments) ? json_decode($student->attachments, true) : $student->attachments;
                    if(is_array($old)){
                        foreach($old as $o){
                            Storage::disk('public')->delete($o);
                        }
                    }
                }
                $paths = [];
                foreach ($request->file('attachments') as $f) {
                    $paths[] = $f->store('students/attachments', 'public');
                }
                $data['attachments'] = json_encode($paths);
            }

            $student->update($data);

            return response()->json(['success' => true, 'student' => $student]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a student and related files.
     */
    public function destroy(Request $request, $id)
    {
        Log::info('AuthenController@destroy called', ['user' => auth()->id() ?? null, 'id' => $id]);
        try {
            $student = Student::findOrFail($id);

            if($student->photo_id){
                Storage::disk('public')->delete($student->photo_id);
            }
            if($student->attachments){
                $old = is_string($student->attachments) ? json_decode($student->attachments, true) : $student->attachments;
                if(is_array($old)){
                    foreach($old as $o){
                        Storage::disk('public')->delete($o);
                    }
                }
            }

            $student->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
