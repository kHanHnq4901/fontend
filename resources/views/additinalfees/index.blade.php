@extends('layouts.app')
@section('content')
   
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if(session()->has('success'))
		<div class="alert alert-success">
			{{ session()->get('success') }}
		</div>
	@endif
                <div class="col-md-12">
                    <div class="text-right">
                        <a href="{{ route('additinalfees.create')}}" class="btn btn-info btn-fill btn-wd">Thêm phụ phí </a>
                    </div>
                    <h4 class="title">Danh sách phụ phí</h4>
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
                                        <th class="text-center">Mã</th>
                                        <th class="text-center">Tên phụ phí</th>
                                        <th class="text-center">Số tiền</th>
                                        <th class="text-center">Ngành</th>
                                        <th class="text-center">Khóa</th>
                                        <th class="text-center">Ngày hết hạn</th>
                                        <th class="text-center">Loại</th>
                                        <th class="disabled-sorting">Hành Động</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Mã</th>
                                        <th class="text-center">Tên phụ phí</th>
                                        <th class="text-center">Số tiền</th>
                                        <th class="text-center">Ngành</th>
                                        <th class="text-center">Khóa</th>
                                        <th class="text-center">Ngày hết hạn</th>
                                        <th class="text-center">Loại</th>
                                        <th class="disabled-sorting">Hành Động</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($Additinalfees as $Additinalfee)
                                    <tr>
                                        <td class="text-center">{{$Additinalfee->idAdditionalFees}}</td>
                                        <td class="text-center">{{$Additinalfee->nameAdditionalFees}}</td>
                                        <td class="text-center">{{number_format($Additinalfee->amount)}}VNĐ</td>
                                        <th class="text-center">{{$Additinalfee->nameMajor}}</th>
                                        <th class="text-center">{{$Additinalfee->nameCourse}}</th>
                                        <td class="text-center">{{ date('d/m/Y', strtotime($Additinalfee->dueDate)) }}</td>
                                        <td class="text-center">@if($Additinalfee->role == 0) Môn học lại @else Phụ phí @endif</td>
                                        <td>
                                            <a href="{{route('additinalfees.show', $Additinalfee->idAdditionalFees)}}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-eye"></i></a>
                                            <a href="{{route('additinalfees.edit', $Additinalfee->idAdditionalFees)}}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                        </td> 
                                    </tr>
                                    @endforeach
                                    
                                   </tbody>
                                </table>
                            </div>
    
    
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