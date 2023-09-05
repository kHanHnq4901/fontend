@extends ('layouts.appstudent')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
<h3>Tổng tiền phải đóng:<font color="red">{{ number_format($total)}} VNĐ </font> </h3>
           
            <div class="col-md-12">
                <h4 class="title">Học phí của sinh viên</h4>
                <br>
                <div class="card">
                    <div class="card-content">
                        <div class="toolbar">
                            <!--Here you can write extra buttons/actions for the toolbar-->
                        </div>
                        <div class="fresh-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Mã Sinh Viên</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Ngày sinh</th>
                                    <th class="text-center">Lớp</th>
                                    <th class="text-center">Hình thức nôp</th>
                                    <th class="text-center">Học phí còn nợ</th>
                                </tr>
                            </thead>
                               <tbody>
                                <tr>                          
                                    <td class="text-center">BKC1000{{ $student->idStudent}}</td>
                                    <td class="text-center">{{ $student->nameStudent }} </td>
                                    <td class="text-center">{{ date('d/m/Y', strtotime($student->dateBirth))}}</td>
                                    <td class="text-center">{{$student->nameGrade}}</td>
                                    <td class="text-center">{{$student->namePaymentOption}}</td>
                                    <td class="text-center"><p style="color: rgb(255, 0, 13);">{{ number_format($student->amount)}}VNĐ</p></td>
                                </tr>  
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--  end card  -->
            </div> 
            <div class="col-md-12">
                <h4 class="title">Danh sách phụ phí của sinh viên</h4>
                <br>
                <div class="card">
                    <div class="card-content">
                        <div class="toolbar">
                            <!--Here you can write extra buttons/actions for the toolbar-->
                        </div>
                        <div class="fresh-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Stt</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Loại</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Số tiền</th>
                                </tr>
                            </thead>
                               <tbody>
                                @foreach ($Additinalfees as $Additinalfee)
                                <tr>     
                                    <td class="text-center">{{ $loop->iteration }}</td>                     
                                    <td class="text-center">{{ $Additinalfee->nameAdditionalFees}}</td>
                                    <td class="text-center">{{ $Additinalfee->role}}</td>
                                    <th class="text-center"><p style="color: red;">Chưa thanh toán</p></th>
                                    <td class="text-center"><p style="color: rgb(255, 0, 13);">{{ number_format($Additinalfee->amount) }}</p> </td>
                                </tr>
                                @endforeach
                               </tbody>
                            </table>
                        </div>


                    </div>
                </div><!--  end card  -->
            </div> 
            <div class="col-md-12">
                <h4 class="title">Danh sách môn học lại sinh viên đăng kí</h4>
                <br>
                <div class="card">
                    <div class="card-content">
                        <div class="toolbar">
                            <!--Here you can write extra buttons/actions for the toolbar-->
                        </div>
                        <div class="fresh-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Stt</th>
                                    <th class="text-center">Tên</th>
                                    {{-- <th class="text-center">Loại</th> --}}
                                    <th class="text-center">Ngày hết hạn</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Số tiền</th>
                                </tr>
                            </thead>
                               <tbody>
                                @foreach ($Additinalfees2 as $Additinalfee2)
                                <tr>     
                                    <td class="text-center">{{ $loop->iteration }}</td>                     
                                    <td class="text-center">{{ $Additinalfee2->nameAdditionalFees}}</td>
                                    {{-- <td class="text-center">{{ $Additinalfee2->role}}</td> --}}
                                    <td class="text-center">{{date('d/m/Y', strtotime($Additinalfee2->dueDate))}}</td>
                                    <th class="text-center"><p style="color: red;">Chưa thanh toán</p></th>
                                    <td class="text-center"><p style="color: rgb(255, 0, 13);">{{ number_format($Additinalfee2->amount) }} VNĐ</p> </td>
                                </tr>
                                @endforeach
                               </tbody>
                            </table>
                        </div>


                    </div>
                </div><!--  end card  -->
            </div> 
        </div> <!-- end row -->
    </div>
</div>   
@endsection