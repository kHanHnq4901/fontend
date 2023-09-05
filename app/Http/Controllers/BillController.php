<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\DebtFee;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Exception;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //thông kê ngày hôm nay
        $today = Carbon::today();
        $total_bill = Bill::whereDate('created_at', $today)->count();
        $total_amount = Bill::whereDate('created_at', $today)->sum('feeBill');
        //thông kê ngày hôm qua
        $yesterday = Carbon::yesterday();
        $total_bill2 = Bill::whereDate('created_at', $yesterday)->count();
        $total_amount2 = Bill::whereDate('created_at', $yesterday)->sum('feeBill');
        //thông kê tháng này
        $total_bill3 = Bill::whereMonth('created_at', Carbon::now()->month)->count();
        $total_amount3 = Bill::whereMonth('created_at', Carbon::now()->month)->sum('feeBill');
        //thông kê tháng trước
        $total_bill4 = Bill::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $total_amount4 = Bill::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('feeBill');
        if($request->has('startDate')&& $request->has('endDate')){
            $startDate = $request->get('startDate');
            $endDate = $request->get('endDate');
            $bills = Bill::whereBetween('bill.created_at', [$request->get('startDate'), $request->get('endDate')])
            ->join('student', 'bill.idStudent', '=', 'student.idStudent')
            ->join('paymentoption', 'paymentoption.idPaymentOption', '=', 'student.idPaymentOption')
            ->select('bill.idBill', 'student.idStudent', 'bill.feeBill','bill.created_at','student.nameStudent','paymentoption.namePaymentOption','bill.note')
            ->get();
            $total_bill5 = Bill::whereBetween('bill.created_at', [$request->get('startDate'), $request->get('endDate')])->count();
            $total_amount5 = Bill::whereBetween('bill.created_at', [$request->get('startDate'), $request->get('endDate')])->sum('feeBill');
            session()->flash('success1', ' Từ ngày '.date('d/m/Y', strtotime($startDate)).' đến ngày '.date('d/m/Y', strtotime($endDate)).' có '. $total_bill5 . ' hóa đơn và tổng tiền thu là '.number_format($total_amount5).' VNĐ ' );
            return view ('bill.index', [
                'bills' => $bills,
                'total_bill' => $total_bill,
                'total_amount'=>$total_amount,
                'total_bill2' => $total_bill2,
                'total_amount2'=>$total_amount2,
                'total_bill3' => $total_bill3,
                'total_amount3'=>$total_amount3,
                'total_bill4' => $total_bill4,
                'total_amount4'=>$total_amount4,
                'total_bill5' => $total_bill5,
                'total_amount5'=>$total_amount5,
                'startDate'=>$startDate,
                'endDate'=>$endDate,
            ]);
        }
        else{
                 $bills = DB::table('bill')
                ->join('student', 'bill.idStudent', '=', 'student.idStudent')
                ->join('paymentoption', 'paymentoption.idPaymentOption', '=', 'student.idPaymentOption')
                ->select('bill.idBill', 'student.idStudent', 'bill.feeBill','bill.created_at','student.nameStudent','paymentoption.namePaymentOption','bill.note')
                 ->get();
        }
        return view('bill.index', [
            'bills' => $bills,
            'total_bill' => $total_bill,
            'total_amount'=>$total_amount,
            'total_bill2' => $total_bill2,
            'total_amount2'=>$total_amount2,
            'total_bill3' => $total_bill3,
            'total_amount3'=>$total_amount3,
            'total_bill4' => $total_bill4,
            'total_amount4'=>$total_amount4
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
    //     try{
    //     $date = Carbon::now();
    //     $idPaymentOption = $request->get('idPaymentOption');
    //     $fee = $request->get('fee');
    //     $idStudent = $request->get('idStudent');
    //     $bill = new Bill();
    //     $bill->idStudent = $idStudent;
    //     $bill->feeBill = $fee;
    //     // $bill->date = $date;
    //     $bill->note = $request->get('note');
    //     $bill->created_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
    //     $bill->save();
    //     $student = Student::where('idStudent', '=',$idStudent )->first();
    //     // $student->debtfees = $student->debtfees - $fee;
    //     $student->save();
    //     $billAmount= DebtFee::where('idStudent', '=',$idStudent )->first();;
    //     $billAmount->amount= $billAmount->amount - $request->get('fee');
    //     $billAmount->save();
        
    //     return Redirect::route('fee.index');
    //     }catch (Exception $e) {
    //         return Redirect::route('fee.show', $request->get('idStudent'))->with('error', [
    //             "message" => 'Bạn chưa nhập',
    //         ]);
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(request $request, $id)
    // {
    //     $search = $request->get('search');
    //     $bills = DB::table('bill')
    //         ->join('student', 'bill.idStudent', '=', 'student.idStudent')
    //         ->join('paymentoption', 'paymentoption.idPaymentOption', '=', 'student.idPaymentOption')
    //         ->whereMonth('date', '=', $id)
    //         ->where('nameStudent', 'like', "%$search%")
    //         ->orderBy('idBill', 'desc')->paginate(5);
    //         $billss = DB::table('bill')
    //         ->join('student', 'bill.idStudent', '=', 'student.idStudent')
    //         ->join('paymentoption', 'paymentoption.idPaymentOption', '=', 'student.idPaymentOption')
    //         ->get();
    //     return view('bill.show', [
    //         'search' => $search,
    //         'bills' => $bills,
    //         'id' => $id,
    //         'billss' =>$billss
    //     ]);
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
