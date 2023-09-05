<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use App\Models\Major;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentOption;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $majors = DB::table('major')->get();
        $courses = DB::table('course')->get();
        if( is_numeric($request->idMajor) && is_numeric($request->idCourse)){
            $grades = DB::table('grade')
            ->join('major', 'grade.idMajor', '=', 'major.idMajor')
            ->join('course', 'grade.idCourse', '=', 'course.idCourse')
            ->where('grade.idMajor', '=', $request->idMajor)
            ->where('grade.idCourse', '=', $request->idCourse)
            ->get();
        }
        else if($request->idMajor === null && is_numeric($request->idCourse) ){
            $grades = DB::table('grade')
            ->join('major', 'grade.idMajor', '=', 'major.idMajor')
            ->join('course', 'grade.idCourse', '=', 'course.idCourse')
            ->where('grade.idCourse', '=', $request->idCourse )
            ->get();
        }
        else if(is_numeric($request->idMajor) && $request->idCourse === null){
            $grades = DB::table('grade')
            ->join('major', 'grade.idMajor', '=', 'major.idMajor')
            ->join('course', 'grade.idCourse', '=', 'course.idCourse')
            ->where('grade.idMajor', '=', $request->idMajor)
            ->get();
        }
        else {
        $grades = DB::table('grade')
            ->join('major', 'grade.idMajor', '=', 'major.idMajor')
            ->join('course', 'grade.idCourse', '=', 'course.idCourse')
            ->get();
        }
        return view('grade.index', [
            "grades" => $grades,
            "majors" => $majors,
            "courses" => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = DB::table('major')->get();
        $courses = DB::table('course')->get();
        return view('grade.create', [
            'majors' => $majors,
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        $name = $request->get('name');
        $idMajor = $request->get('idMajor');
        $idCourse = $request->get('idCourse');
        $grade = new Grade();
        $grade->nameGrade = $name;
        $grade->idMajor = $idMajor;
        $grade->idCourse = $idCourse;
        $grade->created_by_id	= session()->get('id');
        $grade->created_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $grade->save();
        session()->flash('success', 'Thêm lớp học thành công!');
        return Redirect::route('grade.index');
    }catch (Exception $e) {
        return Redirect::route("grade.create")->with('error', [
            "message" => 'Bạn chưa nhập hoặc đã có lớp này rồi',
        ]);
    }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $majors = DB::table('major')->get();
        $courses = DB::table('course')->get();
        $grade = Grade::find($id);
        return view('grade.edit', [
            "grade" => $grade,
            "majors" => $majors,
            "courses" => $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
        $grade = Grade::find($id);
        $grade->nameGrade = $request->get('name');
        $grade->idMajor = $request->get('idMajor');
        $grade->idCourse = $request->get('idCourse');
        $grade->updated_by_id	= session()->get('id');
        $grade->updated_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $grade->save();
        session()->flash('success', 'Cập nhật lớp học thành công!');
        return Redirect::route('grade.index');
    } catch(Exception $e){
        return Redirect::route('grade.edit',$id)->with('error',[
            "message" => 'Bạn chưa nhập'
        ]);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
        Grade::find($id)->delete();
    }
}
