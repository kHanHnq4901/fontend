@extends('layouts.app')
@section('content')
   
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="title">Danh sách sinh viên : {{--$student->nameAdditionalFees --}}</h4>
                    <div class="text-right">
                        <a href="{{ route('alumnus.create') }}" class="btn btn-info btn-fill btn-wd">Thêm sinh viên</a>
                    </div>
                    {{-- <h4 class="title">Danh sách sinh viên của lớp {{$nameGrade->nameGrade}} </h4> --}}
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
                                        <th>Stt</th>
                                        <th>Mã Sinh Viên</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Lớp</th>
                                        <th>Số tiền</th>
                                        <th>Tình trạng</th>
                                        <th class="disabled-sorting">Hành Động</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã Sinh Viên</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Lớp</th>
                                        <th>Số tiền</th>
                                        <th>Tình trạng</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                 @foreach ($students as $student)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>BKC1000{{ $student->idStudent }}</td>
                                        <td>{{ $student->nameStudent}}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->nameGrade }}</td>
                                        <td>{{ $student->amount }}</td>
                                        <td>@if ($student->status == 0 ) <font color="red">Chưa nộp tiền</font> @elseif($student->status == 2 ) <font color="green"> Đã nộp tiền</font> @endif </td>
                                        {{-- <td>{{ number_format($student->fee) }}</td> --}}
                                        <td>
                                            <a href="{{ route('additinalfeesStd.edit', $student->idJunction) }}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-credit-card"></i></a>
                                        </td>
                                        </td>
                                    </tr>
                                    @endforeach 
                                   </tbody>
                                </table>
                            </div>
                            <a href="{{ route ('additinalfees.index') }}"><i class="ti-arrow-left">Quay lại</i></a>
    
                        </div>
                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div> <!-- end row -->
        </div>
    </div>
    
    
        <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
        <script src="../../assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="../../assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../../assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
        <script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>
    
        <!--  Forms Validations Plugin -->
        <script src="../../assets/js/jquery.validate.min.js"></script>
    
        <!-- Promise Library for SweetAlert2 working on IE -->
        <script src="../../assets/js/es6-promise-auto.min.js"></script>
    
        <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
        <script src="../../assets/js/moment.min.js"></script>
    
        <!--  Date Time Picker Plugin is included in this js file -->
        <script src="../../assets/js/bootstrap-datetimepicker.js"></script>
    
        <!--  Select Picker Plugin -->
        <script src="../../assets/js/bootstrap-selectpicker.js"></script>
    
        <!--  Switch and Tags Input Plugins -->
        <script src="../../assets/js/bootstrap-switch-tags.js"></script>
    
        <!-- Circle Percentage-chart -->
        <script src="../../assets/js/jquery.easypiechart.min.js"></script>
    
        <!--  Charts Plugin -->
        <script src="../../assets/js/chartist.min.js"></script>
    
        <!--  Notifications Plugin    -->
        <script src="../../assets/js/bootstrap-notify.js"></script>
    
        <!-- Sweet Alert 2 plugin -->
        <script src="../../assets/js/sweetalert2.js"></script>
    
        <!-- Vector Map plugin -->
        <script src="../../assets/js/jquery-jvectormap.js"></script>
    
        <!-- Wizard Plugin    -->
        <script src="../../assets/js/jquery.bootstrap.wizard.min.js"></script>
    
        <!--  Bootstrap Table Plugin    -->
        <script src="../../assets/js/bootstrap-table.js"></script>
    
        <!--  Plugin for DataTables.net  -->
        <script src="../../assets/js/jquery.datatables.js"></script>
    
        <script type="text/javascript">
            $(document).ready(function() {
    
                $('#datatables').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    responsive: true,
                    language: {
                    search: "_INPUT_",
                        searchPlaceholder: "Tìm Kiếm",
                    }
                });
    
    
                var table = $('#datatables').DataTable();
                 // Edit record
                 table.on( 'click', '.edit', function () {
                    $tr = $(this).closest('tr');
    
                    var data = table.row($tr).data();
                    alert( 'Bạn chỉnh sửa cột: ' + data[0] + ' ' + data[1] + ' ' + data[2]);
                 } );
    
                 // Delete a record
                 table.on( 'click', '.remove', function (e) {
                    $tr = $(this).closest('tr');
                    table.row($tr).remove().draw();
                    e.preventDefault();
                 } );
    
                //Like record
                table.on( 'click', '.like', function () {
                    alert('You clicked on Like button');
                 });
    
            });
        </script>
        
@endsection