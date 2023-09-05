<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Exception;


class PasswordStdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = session()->get('id-student');
        $student = Student::find($id);
        return view('password.indexStudent', [
            'student' => $student,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $student = Student::find($id);
            $student->password = $request->get('password');
            $student ->updated_at= Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
            $student->save();
            session()->flash('success', 'Đổi mật khẩu thành công!');
            return Redirect::route('password.indexStudent');
            }
            catch (Exception $e) {
                return Redirect::route("passwordStd.index")->with('error', [
                    "message" => 'Bạn chưa nhập',
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
