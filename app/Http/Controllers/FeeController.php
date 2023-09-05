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

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = DB::table('student')
            ->join('grade', 'grade.idGrade', '=', 'student.idGrade')
            ->join('fee', function ($join) {
                $join->on('grade.idMajor', '=', 'fee.idMajor')
                    ->on('grade.idCourse', '=', 'fee.idCourse');
            })
            ->join('major', 'grade.idMajor', '=', 'major.idMajor')
            ->join('course', 'grade.idCourse', '=', 'course.idCourse')
            ->join('debtfee', 'debtfee.idStudent', '=', 'student.idStudent')
            ->join('paymentoption', 'paymentoption.idPaymentOption', '=', 'student.idPaymentOption')
            // ->join('junctiontable', 'junctiontable.idStudent', '=', 'student.idStudent')
            // ->join('additinalfees', 'additinalfees.idAdditionalFees', '=', 'junctiontable.idAdditionalFees')
            ->get();
            // $TotalAdditinalfees = DB::table('additinalfees') 
            // ->where('additinalfees.idMajor', '=',$student->idMajor)
            // ->where('additinalfees.idCourse', '=', $student->idCourse)
            // ->where('additinalfees.role', '=', 1)
            // ->sum('additinalfees.amount');
            // $TotalAdditinalfees2 = DB::table('additinalfees') 
            // ->join('junctiontable', 'junctiontable.idAdditionalFees', '=', 'additinalfees.idAdditionalFees')
            // ->where('junctiontable.status', '=',1)
            // ->sum('additinalfees.amount');
            // $total = $TotalAdditinalfees2 + $TotalAdditinalfees;
        return view('fee.index', [
            'students' => $students 
        ]);
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $date = Carbon::now();
            $idPaymentOption = $request->get('idPaymentOption');
            $fee = $request->get('fee');
            $idStudent = $request->get('idStudent');
            $bill = new Bill();
            $bill->idStudent = $idStudent;
            $bill->feeBill = $fee;
            // $bill->date = $date;
            $bill->note = $request->get('note');
            $bill->created_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
            $bill->save();
            $student = Student::where('idStudent', '=',$idStudent )->first();
            // $student->debtfees = $student->debtfees - $fee;
            $student->save();
            $billAmount= DebtFee::where('idStudent', '=',$idStudent )->first();;
            $billAmount->amount= $billAmount->amount - $request->get('fee');
            $billAmount->save();
            
            return Redirect::route('fee.index');
            }catch (\Exception $e) {
                return Redirect::route('fee.show', $request->get('idStudent'))->with('error', [
                    "message" => 'Lỗi ',
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
        $student = Student::join('grade', 'grade.idGrade', '=', 'student.idGrade')
        ->join('fee', function ($join) {
            $join->on('grade.idMajor', '=', 'fee.idMajor')
                ->on('grade.idCourse', '=', 'fee.idCourse');
        })
        ->join('major', 'grade.idMajor', '=', 'major.idMajor')
        ->join('course', 'grade.idCourse', '=', 'course.idCourse')
        ->join('debtfee', 'debtfee.idStudent', '=', 'student.idStudent')
        ->find($id);
        $grades = Grade::all();
        $paymentoptions = Grade::all();
      
        $paymentoptions = DB::table('paymentoption')->get();
        return view('fee.show', [
            "student" => $student,
            "grades" => $grades,
            "paymentoptions"=>$paymentoptions 
        ]);
        // return $student;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $bills = DB::table('bill')
        ->where('idStudent','=',$id)
        ->get();
        $student = Student::find($id);
        return view('fee.edit',[
            'bills' => $bills,
            'id'=>$id,
            'student'=>$student
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
        //
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
