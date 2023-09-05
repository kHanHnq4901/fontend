<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Models\PaymentOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = DB::table('paymentoption')->get();
        return view('payment.index', [
            "payments" => $payments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.create');
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
        $paymentOption = new PaymentOption();
        $paymentOption->namePaymentOption = $request->get('name');
        $paymentOption->discount = $request->get('discount');
        $paymentOption->depositInstallment = $request->get('depositInstallment');
        $paymentOption->created_by_id	= session()->get('id');
        $paymentOption ->created_at= Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        session()->flash('success', 'Thêm hình thức đóng hp thành công!');
        $paymentOption->save();
        return Redirect::route('payment.index');
     
        }catch (Exception $e) {
            return Redirect::route("payment.create")->with('error', [
                "message" => 'Bạn chưa nhập hoặc bản ghi này đã có rồi',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentOption = PaymentOption::find($id);
        return view('payment.edit', [
            "paymentOption" => $paymentOption,
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
        //  $paymentOption = PaymentOption::find($id);
        //  $paymentOption->namePaymentOption = $request->get('name');
        // $paymentOption->Fee = $request->get('fee');
        // $paymentOption->save();
        //  $payment = PaymentOption::find($id);
        //  $payment->namePaymentOption = $request->get('name');
        // $payment->discount = $request->get('discount');
        //  $payment->save();
        // try{
        $payment = DB::table('paymentoption')
            ->where('idPaymentOption', $id)
            ->update([
                'namePaymentOption' => $name = $request->get('name'),
                'discount' => $discount = $request->get('discount'),
                'depositInstallment' => $depositInstallment = $request->get('depositInstallment'),
                'updated_at'=> $updated_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString(),
                'updated_by_id'=>$updated_by_id = session()->get('id')
            ]);
            // $payment = PaymentOption::find($id);
            // $payment ->namePaymentOption = $request->get('name');
            // $payment ->discount = $request->get('discount');
            // $payment ->depositInstallment = $request->get('depositInstallment');
            // $payment ->updated_at= Carbon::now()->toDateTimeString();
            // $payment ->save();
            session()->flash('success', 'Cập nhật hình thức đóng hp thành công!');
        return Redirect::route('payment.index');
    // } catch(Exception $e){
    //     return Redirect::route('payment.edit',$id)->with('error',[
    //         "message" => 'Bạn chưa nhập'
    //     ]);
    // }
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
