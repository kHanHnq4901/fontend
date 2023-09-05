@extends('layouts.app')
@section('content')
    <div class="card">
        {{-- Thêm thì các bạn sử dụng cho chị post --}}
    <form method="post" action="{{ route('update.update',$student->idJunction) }} " >
        @method("PUT")
            @csrf
            <div class=" card-header">
                <h4 class="card-title">
                    Nộp phụ phí
                </h4>
            </div>
            <div class="card-content">
                <div class="form-group">
                    <label>Mã sinh viên</label>
                    <input type="text" disabled class="form-control" value="BKC1000{{$student->idStudent}}">
                    <input type="hidden" name="idStudent"  class="form-control" value="{{$student->idStudent}}">
                    <label>Họ tên sinh viên</label>
                    <input type="text" name="nameStudent" class="form-control" value="{{$student->nameStudent}}">
                    <label>Lớp</label>
                    <input type="hidden" name="idGrade" class="form-control" value="{{$student->idGrade}}">
                    <input type="text" name="nameGrade" class="form-control" value="{{$student->nameGrade}}">
                    <label>Khóa</label>
                    <input type="text" name="nameCourse" disabled class="form-control" value="{{$student->nameCourse}}">
                    <label>Ngành</label>
                    <input type="text" name="nameMajor" disabled class="form-control" value="{{$student->nameMajor}}">
                    <label>
                        Ghi chú : Số tiền phụ phí {{ number_format($student->amount) }}
                    </label>
                    <br>
                    <label>Nhập số tiền đóng</label>
                    
                    <input type="number" name="fee" class="form-control"> 
                    <label class="col-sm-2 control-label">Nhập ghi chú</label>
                    <textarea class="form-control" name="note" rows="3"></textarea>
                    @if (Session::exists('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error.message') }}
                    </div>
                @endif
                </div>
               <center><button type="submit" class="btn btn-fill btn-info">Đóng tiền</button></center>
            </div>
            <a href="{{ route ('additinalfees.index') }}"><i class="ti-arrow-left">Quay lại</i></a>
        </form>
    </div>
@endsection