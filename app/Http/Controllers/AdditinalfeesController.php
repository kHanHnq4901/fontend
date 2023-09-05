<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Additinalfees;
use Illuminate\Support\Facades\DB;
use App\Models\Major;
use App\Models\Course;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Exception;
use App\Models\Junction;

class AdditinalfeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $Additinalfees = DB::table('additinalfees') 
        ->join('major', 'additinalfees.idMajor', '=', 'major.idMajor')
        ->join('course', 'additinalfees.idCourse', '=', 'course.idCourse')->get();
        return view('additinalfees.index', [
            'Additinalfees' => $Additinalfees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = DB::table('major')->get();
        $courses = DB::table('course')->get();
        return view('additinalfees.create',[
            'majors' => $majors,
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Additinalfee = new Additinalfees();
        $Additinalfee->nameAdditionalFees = $request->get('nameAdditionalFees');
        $Additinalfee->idMajor = $request->get('idMajor');
        $Additinalfee->idCourse = $request->get('idCourse');
        $Additinalfee->amount = $request->get('amount');
        $Additinalfee ->dueDate = $request->get('dueDate');
        $Additinalfee->role = $request->get('role');
        $Additinalfee->created_by_id	= session()->get('id');
        $Additinalfee->created_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $Additinalfee->save();
        session()->flash('success', 'Thêm phụ phí thành công!');
        return Redirect::route('additinalfees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $majors = DB::table('major')->get();
        $courses = DB::table('course')->get();
        $students= Junction::where ('junctiontable.idAdditionalFees','=',$id)
        ->join('student','student.idStudent','=','junctiontable.idStudent')
        ->join('grade','grade.idGrade','=','student.idGrade')
        ->join('additinalfees','additinalfees.idAdditionalFees','=','junctiontable.idAdditionalFees')
        ->get()
        ;
        return view('additinalfees.show', [
            'students' => $students,
            'courses'  =>$courses,
            'majors' => $majors
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $majors = DB::table('major')->get();
        $courses = DB::table('course')->get();
        $Additinalfee= Additinalfees::find($id);
        return view('additinalfees.edit', [
            'Additinalfee' => $Additinalfee,
            'courses'  =>$courses,
            'majors' => $majors
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            try{
            $Additinalfee = Additinalfees::find($id);
            $Additinalfee->	nameAdditionalFees= $request->get('nameAdditionalFees');
            $Additinalfee->amount = $request->get('amount');
            $Additinalfee->dueDate = $request->get('dueDate');
            // $Additinalfee->role = $request->get('role');
            $Additinalfee->updated_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
            $Additinalfee->save();
            session()->flash('success', 'Cập nhật phụ phí thành công!');
            return Redirect::route('additinalfees.index');
        } catch(Exception $e){
            return Redirect::route('alumnus.edit',$id)->with('error',[
                "message" => 'Bạn chưa nhập'
            ]);
        }
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
