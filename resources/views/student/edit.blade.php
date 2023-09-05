@extends('layouts.app')
@section('content')
    <div class="card">
        @if(session()->has('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}
					</div>
				@endif
        <form method="post" action="{{ route('alumnus.update',$student->idStudent) }}">
            @method("PUT")
            @csrf
            <div class="card-content">
                <div class="form-group">
                    <label>Mã sinh viên</label>
                    <input type="text"  disabled class="form-control" value="BKC1000{{ $student->idStudent}}">
                    <label>Họ và tên</label>
                    <input type="text" name="nameStudent" class="form-control" value="{{ $student->nameStudent}}">
                    <label>Giới tính</label><br>
                    <input type="radio" name="gender" value="1" @if ($student->gender ===1) {{"checked"}} @endif> Nam
                    <input type="radio" name="gender" value="0" @if ($student->gender ===0) {{"checked"}} @endif> Nữ<br>
                    <label>Ngày sinh</label>
                    <input type="date" name="dateBirth" class="form-control" value="{{ $student->dateBirth}}">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control"  value="{{ $student->address}}">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control"  value="{{ $student->email}}" disabled>
                    <label>Lớp</label>
                    <input type="text" name="email" class="form-control"  value="{{ $student->nameGrade}}" disabled>
                    <label>Ngành</label>
                    <input type="text" name="email" class="form-control"  value="{{ $student->nameMajor}}" disabled>
                   <label>Khóa</label>
                   <input type="text" name="email" class="form-control"  value="{{ $student->nameCourse}}" disabled>
               </select>
                    <label>Học bổng</label>
                    <input type="text" name="email" class="form-control"  value="{{ number_format($student->fee)}} VNĐ" disabled>
                    @if (Session::exists('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error.message') }}
                    </div>
                @endif
                </div>
                <center><button type="submit" class="btn btn-fill btn-info">Sửa</button></center>
            </div>
            <a href="{{ route('alumnus.show', $student->idGrade) }}"><i class="ti-arrow-left">Quay lại</i></a>
        </form>
    </div>
@endsection