@extends ('layouts.appstudent')
@section('content')
    <div class="content">
                <div class="container-fluid">
					@if(session()->has('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}
					</div>
				@endif
                    <div class="row">
                    <div class="card">
					<form method="post" action="{{ route('profileStd.update', $student->idStudent) }}">
						@method('PUT')
                    	@csrf
		                            <div class="card-header">
									    <h4 class="card-title">
											Thông tin 
										</h4>
									</div>
		                            <div class="card-content">
											<label>Mã sinh viên</label>
	                                        <input type="text" disabled value="BKC1000{{ $student->idStudent }}"  class="form-control">
	                                        <label>Địa chỉ email</label>
	                                        <input type="text" disabled value="{{ $student->email }}"  class="form-control">
	                                        <label>Tên</label>
	                                        <input type="text" name='nameStudent' value="{{ $student->nameStudent}}"  class="form-control">
											<label>Ngày sinh</label>
	                                        <input type="date" name='dateBirth' value="{{ $student->dateBirth}}"  class="form-control">
											<label>Lớp</label>
	                                        <input type="text" value="{{ $student->nameGrade}}" disabled  class="form-control">
											<label>Ngành</label>
	                                        <input type="text"  value="{{ $student->nameMajor}}" disabled class="form-control">
											<label>Khóa</label>
	                                        <input type="text"value="{{ $student->nameCourse}}" disabled class="form-control">
											@if (Session::exists('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error.message') }}
                    </div>
                @endif
	                                    </div>
	                                   
	                                    <center><button type="submit" class="btn btn-fill btn-info">Sửa</button></center>
		                            </div>
							    </form>
	                        </div> <!-- end card -->
                </div>
            </div>
            
@endsection