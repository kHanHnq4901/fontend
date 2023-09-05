<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\DebtFee;
use App\Models\Grade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Additinalfees;
use Illuminate\Support\Facades\DB;
use App\Models\Major;
use App\Models\Student;
use App\Models\Course;
use App\Models\Junction;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Exception;

class AdditinalfeesStdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = session()->get('id-student');
        $student = Student::Where('idStudent', '=', $id)
        ->join('grade', 'grade.idGrade', '=', 'student.idGrade')
        ->join('major', 'grade.idMajor', '=', 'major.idMajor')
        ->join('course', 'grade.idCourse', '=', 'course.idCourse')
        ->first();
        $major = Major::find($student->idMajor);
        $course = Course ::find($student->idCourse);
        $Additinalfees = DB::table('additinalfees') 
        // ->join('junctiontable', 'junctiontable.idAdditionalFees', '=', 'additinalfees.idAdditionalFees')
        ->where('additinalfees.idMajor', '=',$student->idMajor)
        ->where('additinalfees.idCourse', '=', $student->idCourse)
        ->where('additinalfees.role', '=', 0)
        ->get();
        $ids = Junction::pluck('idStudent');
        $Additinalfees1= Additinalfees::whereNotIn('idStudent', $ids)
        ->join('junctiontable','additinalfees.idAdditionalFees','=','junctiontable.idAdditionalFees')
        ->get();
        //đóng rồi
        $Additinalfees2 = DB::table('junctiontable')
        ->join('additinalfees','additinalfees.idAdditionalFees','=','junctiontable.idAdditionalFees')
        ->join('student','student.idStudent','=','junctiontable.idStudent')
        ->get();
        $Junction= DB::table('junctiontable') 
        // ->join('junctiontable', 'junctiontable.idAdditionalFees', '=', 'additinalfees.idAdditionalFees')
        ->get();
        return view('additinalfeesStudent.index', [
            'Additinalfees' => $Additinalfees,
            'Additinalfees2' => $Additinalfees2,
            'major' =>  $major,
            'course' => $course,
            'Junction' =>$Junction
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
        // try{
            $Junction = new Junction();
            $Junction->idAdditionalFees = $request->get('idAdditionalFees');
            $Junction->idStudent = session()->get('id-student');
            $Junction->status = 1 ;
            $Junction->save();
            $Additinalfee = Additinalfees::find($request->get('idAdditionalFees'));
            $Additinalfee->status = 1;
            $Additinalfee->save();
            session()->flash('success', 'Đăng kí học lại môn thành công!');
            return Redirect::route('additinalfeesStd.index');
            // }catch (Exception $e) {
            //     return Redirect::route("major.create")->with('error', [
            //         "message" => 'Bạn chưa nhập hoặc đã có bản ghi này rồi',
                    
            //     ]);
            // }
            // return $request->input('idAdditinalfees');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Additinalfee = DB::table('additinalfees')
        ->join('major', 'additinalfees.idMajor', '=', 'major.idMajor')
        ->join('course', 'additinalfees.idCourse', '=', 'course.idCourse')
        ->where ('idAdditionalFees','=',$id) 
        ->first();
        return view('additinalfeesStudent.show',[
            'Additinalfee' => $Additinalfee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Junction::where('idJunction', '=', $id)
        ->join('student','junctiontable.idStudent','=','student.idStudent')
        ->join('grade','grade.idGrade','=','student.idGrade')
        ->join('major', 'grade.idMajor', '=', 'major.idMajor')
        ->join('course', 'grade.idCourse', '=', 'course.idCourse')
        ->join('additinalfees','additinalfees.idAdditionalFees','=','junctiontable.idAdditionalFees')
        ->first();

        return view('additinalfees.update', [
            "student" => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $bill = new Bill();
            $bill->idStudent = $request->get('idStudent');
            $bill->feeBill = $request->get('fee');
            $bill->note = $request->get('note');
            $bill->created_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
            $bill->save();
            $student = Student::where('idStudent', '=',$request->get('idStudent') )->first();
            $student->save();
            $billAmount= DebtFee::where('idStudent', '=',$request->get('idStudent') )->first();;
            $billAmount->amount= $billAmount->amount - $request->get('fee');
            $billAmount->save();
            
            return Redirect::route('additinalfees.index');
            }catch (\Exception $e) {
                return Redirect::route('additinalfees.index')->with('error', [
                    "message" => 'Lỗi ',
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
