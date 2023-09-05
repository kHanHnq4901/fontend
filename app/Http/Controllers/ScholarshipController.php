<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Scholarship;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $scholarships = scholarship::orderBy('fee', 'asc')->get();
        return view('scholarship.index', [
            "scholarships" => $scholarships,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scholarship.create');
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
        $scholarship = new Scholarship();
        $scholarship->fee = $name;
        $scholarship->created_at= Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $scholarship->created_by_id	= session()->get('id');
        $scholarship->save();
        session()->flash('success', 'Thêm học bổng thành công!');
        return Redirect::route('scholarship.index');
        }catch (Exception $e) {
            return Redirect::route("scholarship.create")->with('error', [
                "message" => 'Bạn chưa nhập hoặc đã có bản ghi này rồi!',
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
        $scholarship = Scholarship::find($id);
        return view('scholarship.edit', [
            "scholarship" => $scholarship,
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
        $scholarship = Scholarship::find($id);
        $scholarship->fee = $request->get('fee');
        $scholarship->updated_at= Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $scholarship->updated_by_id = session()->get('id');
        $scholarship->save();
        session()->flash('success', 'Cập nhật học bổng thành công!');
        return Redirect::route('scholarship.index');
    } catch(Exception $e){
        return Redirect::route('scholarship.edit',$id)->with('error',[
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
}
