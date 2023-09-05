<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Major;
use App\Models\Course;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  # all => lấy tất cả bản ghi
        # paginate => phân trang
        $courses = DB::table('course')->orderBy('idCourse', 'desc')->get();
        return view('course.index', [
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
        return view('course.create', [
            "majors" => $majors,
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
        $course = new Course();
        $course->nameCourse = $name;
        $course->created_at= Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $course->created_by_id = session()->get('id');
        $course->save();
        session()->flash('success', 'Thêm khóa học thành công!');
        return Redirect::route('course.index');
    } catch(Exception $e){
        return Redirect::route('course.create')->with('error',[
            "message" => 'Bạn chưa nhập hoặc đã có bản ghi này rồi'
        ]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
        
        $course = Course::find($id);
        return view('course.edit', [
            "course" => $course
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
        $course = Course::find($id);
        $course->nameCourse = $request->get('name');
        $course->updated_at= Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $course->updated_by_id = session()->get('id');
        $course->save();
        session()->flash('success', 'Cập nhật khóa học thành công!');
        return Redirect::route('course.index');
    } catch(Exception $e){
        return Redirect::route('course.edit',$id)->with('error',[
            "message" => 'Bạn chưa nhập hoặc đã có khóa học này rồi!'
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
    }
}
