@extends('layouts.app')
@section('content')
    {{-- <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thêm sinh viên</h4>
                        </div>
                        <div class="card-content">
                            <form method="get" action="{{ route('alumnus.store')}}" class="form-horizontal">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Họ và tên</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control">
                                            <span class="help-block">A block of help text that breaks onto a new line.</span>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Giới tính</label>
                                        <div class="col-sm-10">
                                         
                                            <div class="radio">
                                                <input type="radio" name="radio1" id="radio1" value="option1" checked="">
                                                <label for="radio1">
                                                     Nữ
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <input type="radio" name="radio1" id="radio2" value="option2">
                                                <label for="radio2">
                                                    Nam
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Ngày sinh</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control datepicker" placeholder="Date Picker Here"/>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Địa Chỉ</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="placeholder" class="form-control">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" disabled="" value="123456" class="form-control">
                                        </div>
                                    </div>
                                </fieldset>                          
                                <fieldset>
                                    <label class="col-sm-2 control-label">Chọn Lớp</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select class="selectpicker" data-style="btn btn-danger btn-block" title="Lớp" data-size="7">
                                                    @foreach($grades as $grade)
                                                    <option value="{{ $grade->idGrade  }}">@if($grade->idMajor==1)BKD @else BKN @endif {{ $grade->nameGrade  }}K{{$grade->nameCourse}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>                               
                                </fieldset>
                                <fieldset>
                                    <label class="col-sm-2 control-label">Học Bổng</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select class="selectpicker" data-style="btn btn-danger btn-block" title="Hình Thức Nộp HP" data-size="7">
                                                    @foreach($scholarships as $scholarship)
                                                    <option value="{{ $scholarship->idScholarship }}">{{ $scholarship->fee }} vnd</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>                               
                                </fieldset>
                                <fieldset>
                                    <label class="col-sm-2 control-label">Hình Thức Nộp Học Phí</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select class="selectpicker" data-style="btn btn-danger btn-block" title="Hình Thức Nộp Học Phí" data-size="7">
                                                    @foreach($paymentoptions as $paymentOption)
                                                    <option value="{{ $paymentOption->idPaymentOption  }}">{{ $paymentOption->namePaymentOption }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>                               
                                </fieldset>

                                <button type="submit" class="btn btn-fill btn-info">Thêm</button>
                            </form>
                        </div>
                    </div>  <!-- end card -->
                </div> <!-- end col-md-12 -->
            </div> <!-- end row -->
        </div>
    </div>   --}}
    <div class="card">
          <form method="post" action="{{ route('alumnus.store') }}">   
             @csrf
             <div class=" card-header">
                <h4>Thêm sinh viên</h4>
             </div>
             <div class="card-content">
                 <div class="form-group">
                     <label>Họ và tên</label>
                     <input type="text" name="nameStudent" class="form-control">
                     
                     <label>Giới tính</label><br>
                            <div class="radio">
                                <input type="radio" name="gender"  id="radio1" value="1" checked="">
                                <label for="radio1">
                                     Nam
                                </label>
                            </div>

                            <div class="radio">
                                <input type="radio" name="gender" id="radio2" value="0">
                                <label for="radio2">
                                    Nữ
                                </label>
                            </div>
                      
                     <label>Ngày sinh</label>
                     
                     <input type="date" name="dateBirth" class="form-control">
                     <label>Địa chỉ</label>
                     <input type="text" name="address" class="form-control">
                     <label>Email</label>
                     <input type="text" name="email" class="form-control">
                     <label>Password</label>
                     <input type="text" value="123456" disabled  class="form-control">
                     <input type="hidden" name="password" value="123456"  class="form-control">
                     <label>Lớp</label>
                     {{-- <label>Khóa</label>                              
                     <input type='text' name='idGrade'disabled class="form-control" value='{{$grade->nameGrade }} '> --}}
                     <div class="row">
                        <div class="col-sm-6">
                            <select class="selectpicker" name="idGrade"  data-style="btn btn-danger btn-block" title="Chọn Lớp" data-size="7">
                                @foreach($grades as $grade)
                                <option value="{{ $grade->idGrade  }}">{{ $grade->nameGrade  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <label>Khóa</label>                              
                    <input type='text' name='idCourse'disabled class="form-control" value='{{ $grade->nameCourse }} '>
                    <input type='hidden' name='idCourse' class="form-control" value='{{ $grade->idCourse }} '>
                    <label>Ngành</label>  
                    <input type='text'name='idMajor' disabled class="form-control"value='{{ $grade->nameMajor}} '>
                    <input type='hidden'name='idMajor'   class="form-control"value='{{ $grade->idMajor}} '>
                     <label>Hình thức nộp học phí</label>
                     {{-- <select name="idPaymentOption" id="" class="form-control">
                         <option value="">-----</option>
                         @foreach($paymentoptions as $paymentOption)
                         <option value="{{ $paymentOption->idPaymentOption  }}">{{ $paymentOption->namePaymentOption }}</option>
                         @endforeach
                     </select> --}}
                     <div class="row">
                        <div class="col-sm-6">
                            <select class="selectpicker"  name="idPaymentOption" data-style="btn btn-danger btn-block" title="Chọn hình thức" data-size="7">
                                @foreach($paymentoptions as $paymentOption)
                                <option value="{{ $paymentOption->idPaymentOption  }}">{{ $paymentOption->namePaymentOption }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                     <label>Học bổng</label>
                     {{-- <select name="idScholarship" id="" class="form-control">
                     <option value="">-----</option>
                         @foreach($scholarships as $scholarship)
                         <option value="{{ $scholarship->idScholarship }}">{{ $scholarship->fee }} vnd</option>
                         @endforeach
                     </select> --}}
                     <div class="row">
                        <div class="col-sm-6">
                            <select class="selectpicker" name="idScholarship" data-style="btn btn-danger btn-block" title="Chọn học bổng" data-size="7">
                                @foreach($scholarships as $scholarship)
                                <option value="{{ $scholarship->idScholarship }}">{{ $scholarship->fee }} vnd</option>
                                @endforeach
                            </select>
                        </div>
                    </div>     
                  
                     @if (Session::exists('error'))
                                                 <div class="alert alert-danger">
                                                     {{ Session::get('error.message') }}
                                                 </div>
                                             @endif
                 </div>
                <center><button type="submit" class="btn btn-fill btn-info">Thêm</button></center> 
             </div>
             <a href="{{ route('alumnus.show', $grade->idGrade) }}"><i class="ti-arrow-left">Quay lại</i></a>
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