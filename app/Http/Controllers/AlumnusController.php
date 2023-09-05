<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Fee;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Scholarship;
use App\Models\PaymentOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DebtFee;
use Illuminate\Support\Facades\Redirect;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use App\Models\DebtFeesModel;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class AlumnusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    // $grades = Grade::join('course', 'grade.idCourse', '=', 'course.idCourse')
    // ->join('major', 'grade.idMajor', '=', 'major.idMajor')
    // ->get();
    // $grade = Grade::where('idGrade','=', $id)
    // ->join('course','grade.idCourse','=','course.idCourse')
    // ->join('major', 'grade.idMajor', '=', 'major.idMajor')
    // ->first();
    // $students = Student::where('idGrade', '=', $grade)
    //     ->join('scholarship', 'student.idScholarship', '=', 'scholarship.idScholarship')
    //     ->join('paymentoption', 'student.idPaymentOption', '=', 'paymentoption.idPaymentOption')
    //     ->orderBy('idStudent', 'desc')
    //     ->paginate(5);
    // // return view("student.index", [
    // //     'grades' => $grades,
    // //     'students' => $students,
    // //     'grade' =>$grade,
    // // ]);
    //     return $grade;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = DB::table('grade')
            ->join('major', 'grade.idMajor', '=', 'major.idMajor')
            ->join('course', 'grade.idCourse', '=', 'course.idCourse')
            ->get();
        $paymentoptions = DB::table('paymentoption')->get();
        $scholarships = DB::table('scholarship')->get();
        return view('student.create', [
            'grades' => $grades,
            'paymentoptions' => $paymentoptions,
            'scholarships' => $scholarships,
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
        $student = new Student();
        $student->nameStudent = $request->get('nameStudent');
        $student->gender = $request->get('gender');
        $student->dateBirth = $request->get('dateBirth');
        $student->address = $request->get('address');
        $student->email = $request->get('email');
        $student->password = $request->get('password');
        $student->idGrade = $request->get('idGrade');
        $student->idPaymentOption = $request->get('idPaymentOption');
        $student->idScholarship = $request->get('idScholarship');
        $idGrade = $request->get('idGrade');
        $grade = DB::table('grade')->where('idGrade', '=', $idGrade)->first();
        $idMajor = $grade->idMajor;
        $idCourse = $grade->idCourse;
        
        $fee = DB::table('fee')->where('idMajor', '=', $idMajor)
            ->where('idCourse', '=', $idCourse) 
            ->first();
        $payment = paymentoption::find($student->idPaymentOption);
        $scholarship = scholarship::find($student->idScholarship );
        $student->created_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $discount = $fee->fee*$payment->discount/100;
        $student->save();
        $debtfee = new Debtfee;
        $debtfee->idStudent = $student->idStudent;
        $debtfee->idfee = $fee->idFee;
        $debtfee->amount = ($fee->fee-$scholarship->fee-$discount)/ $payment->depositInstallment;
        $debtfee->dueDate = Carbon::now();
        $debtfee->description = 'Đang chờ';
        $debtfee->status = 'Đang chờ thanh toán'; 
        $debtfee->save();
        session()->flash('success', 'Thêm sinh viên thành công!');    
        return Redirect::route('grade.index',[
            'fee' => $fee
         ]);
         
        }catch (Exception $e) {
            return Redirect::route('alumnus.create')->with('error', [
                "message" => 'Lỗi!',
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
        $grades = Grade::join('course', 'grade.idCourse', '=', 'course.idCourse')
        ->join('major', 'grade.idMajor', '=', 'major.idMajor')
        ->get();
        $grade = Grade::where('idGrade','=', $id)
        ->join('course','grade.idCourse','=','course.idCourse')
        ->join('major', 'grade.idMajor', '=', 'major.idMajor')
        ->first();
        $students = Student::where('idGrade', '=',$id)
            ->join('scholarship', 'student.idScholarship', '=', 'scholarship.idScholarship')
            ->join('paymentoption', 'student.idPaymentOption', '=', 'paymentoption.idPaymentOption')
            ->join('debtfee', 'student.idStudent', '=', 'debtfee.idStudent')
            // ->join('junctiontable', 'junctiontable.idStudent', '=', 'student.idStudent')
            // ->join('additinalfees', 'additinalfees.idAdditionalFees', '=', 'junctiontable.idAdditionalFees')
            ->get();
        return view("student.index", [
            'grades' => $grades,
            'students' => $students,
            'grade' =>$grade,
        ]);
            // return $grade;
        // $grades = Grade::join('course', 'grade.idCourse', '=', 'course.idCourse')
        //     ->join('major', 'grade.idMajor', '=', 'major.idMajor')
        //     ->select('*')->get();
        // if (isset($id)) {
        //     $grade = $id;
        // } else {
        //     $grade = $request->get('grade');
        // }
        // $nameGrade = Grade::where('idGrade', $grade)->first();
        // $students = Student::where('idGrade', '=', $grade)
        //     ->join('scholarship', 'student.idScholarship', '=', 'scholarship.idScholarship')
        //     ->join('paymentoption', 'student.idPaymentOption', '=', 'paymentoption.idPaymentOption')
        //     ->join('debtfee', 'debtfee.idStudent', '=', 'student.idStudent')
        //     ->get();
        // return view("student.index", [
        //     'grades' => $grades,
        //     'students' => $students,
        //     'idGrade' => $grade,
        //     'nameGrade' =>$nameGrade,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $student = Student::where('idStudent','=',$id)
        ->join ('grade', 'grade.idGrade', '=', 'student.idGrade')
        ->join('major', 'grade.idMajor', '=', 'major.idMajor')
        ->join('course', 'grade.idCourse', '=', 'course.idCourse')
        ->join('scholarship', 'scholarship.idScholarship', '=', 'student.idScholarship')
        ->first();
        return view('student.edit', [
            'student' => $student,
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
        $student = Student::find($id);
        $student->nameStudent = $request->get('nameStudent');
        $student->gender = $request->get('gender');
        $student->dateBirth = $request->get('dateBirth');
        $student->address = $request->get('address');
        // $student->email = $request->get('email');
        // $student->idGrade = $request->get('idGrade');
        // $student->idScholarship = $request->get('idScholarship');
        $student->updated_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $student->save();
        session()->flash('success', 'Cập nhật sinh viên thành công!');
        return Redirect::route('alumnus.edit',$id)->with('
        success',[
            "message" => 'Sửa thành công'
        ]);
    } catch(Exception $e){
        return Redirect::route('alumnus.edit',$id)->with('error',[
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
    }
    // public function addByExcel()
    // {
    //     return view('student.add-by-excel');
    // }

    // public function import(Request $request)
    // {
    //     $file = $request->file('excel-file');
    //     Excel::import(new StudentImport, $file);
    //     return Redirect::route('grade.index');
    // }

    // public function export()
    // {
    //     return Excel::download(new StudentExport, 'DanhSachSinhVien.xlsx');
    // }
}
