<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Student;
use App\Models\Additinalfees;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Junction;
use Illuminate\Support\Facades\Redirect;


class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $bill = new Bill();
            $bill->idStudent = $request->get('idStudent');
            $bill->feeBill = $request->get('fee');
            $bill->note = $request->get('note');
            $bill->created_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
            $bill->save();
            $Additinalfees = Additinalfees::find($id);
            $Additinalfees->status = 2;
            $Additinalfees->save();

            // $junctiontable = Junction::find($id);
            
            return Redirect::route('additinalfees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
