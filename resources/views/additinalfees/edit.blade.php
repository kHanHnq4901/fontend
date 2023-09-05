@extends('layouts.app')
@section('content')
    <div class="card">
        {{-- Thêm thì các bạn sử dụng cho chị post --}}
        <form method="post" action="{{ route('additinalfees.update',$Additinalfee->idAdditionalFees) }}">
            @method("PUT")
            @csrf
            <div class=" card-header">
                <h4 class="card-title">
                    Sửa phụ phí :{{$Additinalfee->nameAdditionalFees }}
                </h4>
            </div>
            <div class="card-content">
                <div class="form-group">
                    <label>Tên phụ phí</label>
                    <input type="text" name="nameAdditionalFees" class="form-control" value='{{$Additinalfee->nameAdditionalFees }}'>
                    <label>Số tiền</label>
                    <input type="number" name="amount" class="form-control" value='{{$Additinalfee->amount}}'>
                    <label>Chọn ngành</label>
                     <select name="idMajor" id=""class="form-control" disabled >
                        @foreach($majors as $major)
                            <option value="{{ $major->idMajor  }}" @if($Additinalfee->idMajor == $major->idMajor) {{'selected'}} @endif> {{$major->nameMajor}}</option>
                        @endforeach
                    </select>
                    <label>Chọn khóa</label>
                     <select name="idCourse" id=""class="form-control" disabled >
                        @foreach($courses as $course)
                            <option value="{{$course->idCourse}} "@if($Additinalfee->idCourse == $course->idCourse) {{'selected'}} @endif>{{$course->nameCourse}} </option>
                        @endforeach
                    </select>
                    <label>Loại phụ phí</label><br>
                    <div class="radio">
                        <input type="radio" name="role"  id="radio1" value="0" checked="" disabled>
                        <label for="radio1">
                            Môn học lại
                        </label>
                    </div>

                    <div class="radio">
                        <input type="radio" name="role" id="radio2" value="1" disabled>
                        <label for="radio2">
                            Phụ phí phải đóng
                        </label>
                    </div>
                    <label>Chọn ngành hết hạn </label>
                    <input type="date" name="dueDate" class="form-control" value='{{$Additinalfee->dueDate}}'>
                @if (Session::exists('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error.message') }}
                </div>
            @endif
                </div>
               <center><button type="submit" class="btn btn-fill btn-info">Sửa</button></center> 
            </div>
            <a href="{{ route ('additinalfees.index') }}"><i class="ti-arrow-left">Quay lại</i></a>
        </form>
    </div>
@endsection