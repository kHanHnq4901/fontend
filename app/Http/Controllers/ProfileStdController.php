<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class ProfileStdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = session()->get('id-student');
        $student = DB::table('student')
        ->join('grade', 'grade.idCourse', '=', 'student.idGrade')
        ->join('major', 'grade.idMajor', '=', 'major.idMajor')
        ->join('course', 'grade.idCourse', '=', 'course.idCourse')
        ->where('idStudent','=',$id)
        ->first();
        return view('profile.indexStudent', [
            'student' => $student,
            'id'=>$id
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
            $student->nameStudent = $request->get('nameStudent');
            $student ->updated_at= Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
            $student->save();
            session()->flash('success', 'Cập nhật thông tin thành công!');
            return Redirect::route('profileStd.index');
        } catch(Exception $e){
            return Redirect::route('profileStd.index',$id)->with('error',[
                "message" => 'Bạn chưa nhập'
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
