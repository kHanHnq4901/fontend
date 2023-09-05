<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Major;
use App\Models\Course;
use App\Models\PaymentOption;
use App\Models\Scholarship;
use App\Models\Bill;
use App\Models\DebtFee;
use Carbon\Carbon;
use App\Http\Controllers\Exception;

class FeeStdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = session()->get('id-student');
        //học phí
        $student = DB::table('student')
            ->join('grade', 'grade.idGrade', '=', 'student.idGrade')
            ->join('fee', function ($join) {
                $join->on('grade.idMajor', '=', 'fee.idMajor')
                    ->on('grade.idCourse', '=', 'fee.idCourse');
            })
            ->join('major', 'grade.idMajor', '=', 'major.idMajor')
            ->join('course', 'grade.idCourse', '=', 'course.idCourse')
            ->join('debtfee', 'debtfee.idStudent', '=', 'student.idStudent')
            ->join('paymentoption', 'paymentoption.idPaymentOption', '=', 'student.idPaymentOption')
            ->where('student.idStudent','=',$id )
            ->first();
        //phụ phí
            $major = Major::find($student->idMajor);
            $course = Course ::find($student->idCourse);
            $Additinalfees = DB::table('additinalfees') 
            ->join('major', 'additinalfees.idMajor', '=', 'major.idMajor')
            ->join('course', 'additinalfees.idCourse', '=', 'course.idCourse')
            ->where('additinalfees.idMajor', '=',$student->idMajor)
            ->where('additinalfees.idCourse', '=', $student->idCourse)
            ->where('additinalfees.role', '=', 1)
            ->get();
          
            $Additinalfees2 = DB::table('additinalfees') 
            ->join('major', 'additinalfees.idMajor', '=', 'major.idMajor')
            ->join('course', 'additinalfees.idCourse', '=', 'course.idCourse')
            ->join('junctiontable', 'junctiontable.idAdditionalFees', '=', 'additinalfees.idAdditionalFees')
            ->where('junctiontable.status', '=',1)
            ->get();
            $TotalAdditinalfees = DB::table('additinalfees') 
            ->where('additinalfees.idMajor', '=',$student->idMajor)
            ->where('additinalfees.idCourse', '=', $student->idCourse)
            ->where('additinalfees.role', '=', 1)
            ->sum('additinalfees.amount');
            $TotalAdditinalfees2 = DB::table('additinalfees') 
            ->join('junctiontable', 'junctiontable.idAdditionalFees', '=', 'additinalfees.idAdditionalFees')
            ->where('junctiontable.status', '=',1)
            ->sum('additinalfees.amount');
            $total = $TotalAdditinalfees2 + $TotalAdditinalfees + $student->amount;
        return view('feestudent.index',[
            'student'=>$student,
            'Additinalfees'=>$Additinalfees,
            'Additinalfees2' => $Additinalfees2,
            'total' =>$total
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
