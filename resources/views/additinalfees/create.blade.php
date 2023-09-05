@extends('layouts.app')
@section('content')
    <div class="card">
          <form method="post" action="{{route('additinalfees.store')}}">   
             @csrf
             <div class=" card-header">
                <h4>Thêm phụ phí cho sinh viên</h4>
             </div>
             <div class="card-content">
                 <div class="form-group">
                     <label>Tên phụ phí</label>
                     <input type="text" name="nameAdditionalFees" class="form-control">
                     <label>Số tiền</label>
                     <input type="number" name="amount" class="form-control">
                     <label>Chọn ngành</label>
                     <select name="idMajor" id=""class="form-control" >
                        <option value="">-----</option>
                        @foreach($majors as $major)
                    <option value="{{ $major->idMajor  }}"> {{$major->nameMajor}}</option>
                        @endforeach
                    </select>
                    <label>Chọn khóa</label>
                     <select name="idCourse" id=""class="form-control" >
                        <option value="">-----</option>
                        @foreach($courses as $course)
                    <option value="{{ $course->idCourse  }}">{{$course->nameCourse}}</option>
                        @endforeach
                    </select>
                    <label>Loại phụ phí</label><br>
                    <div class="radio">
                        <input type="radio" name="role"  id="radio1" value="0" checked="">
                        <label for="radio1">
                            Môn học lại
                        </label>
                    </div>

                    <div class="radio">
                        <input type="radio" name="role" id="radio2" value="1">
                        <label for="radio2">
                            Phụ phí phải đóng
                        </label>
                    </div>
                     <label>Ngày hết hạn</label>
                     <input type="date" name="dueDate" class="form-control">
                     @if (Session::exists('error'))
                                                 <div class="alert alert-danger">
                                                     {{ Session::get('error.message') }}
                                                 </div>
                                             @endif
                 </div>
                <center><button type="submit" class="btn btn-fill btn-info">Thêm</button></center> 
             </div>
             <a href="{{ route('additinalfees.index') }}"><i class="ti-arrow-left">Quay lại</i></a>
         </form>
     </div>

    <script type="text/javascript">
        $().ready(function(){
			// Init Sliders
            demo.initFormExtendedSliders();
            // Init DatetimePicker
            demo.initFormExtendedDatetimepickers();
        });
    </script>

@endsection