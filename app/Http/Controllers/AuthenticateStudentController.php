<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthenticateStudentController extends Controller
{
    public function login()
    {
        return view('loginstudent');
    }

    public function loginProcess(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        try {
            $student = Student::where('email', $email)->where('password', $password)->firstOrFail();
            $request->session()->put('id-student', $student->idStudent);
            $request->session()->put('name-student', $student->nameStudent);
            $request->session()->put('email-student', $student->email);
            return Redirect::route("feestd.index");
       } catch (Exception $e) {
           return Redirect::route("login-student")->with('error', [
               "message" => 'Đăng nhập lỗi',
               "email" => $email,
          ]);
       }
    }

    public function logout(Request $request)
    {
        // Xóa session
        $request->session()->flush();
        // Điều hướng nó về trang login
        return Redirect::route("login-student");
    }
}
