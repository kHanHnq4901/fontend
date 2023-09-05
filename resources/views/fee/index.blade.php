@extends ('layouts.app')
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
                <h4 class="title">Danh sách học phí của sinh viên</h4>
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
                                    <th class="text-center">Mã Sinh Viên</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Ngày sinh</th>
                                    <th class="text-center">Lớp</th>
                                    <th class="text-center">Hình thức nôp</th>
                                    <th class="text-center">Học phí còn nợ</th>
                                    <th class="text-center">Phụ phí còn nợ</th>
                                    <th class="disabled-sorting">Hành Động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Stt</th>
                                    <th class="text-center">Mã Sinh Viên</th>
                                   <th class="text-center">Tên</th>
                                   <th class="text-center">Ngày sinh</th>
                                   <th class="text-center">Lớp</th>           
                                   <th class="text-center">Hình thức nôp</th>
                                   <th class="text-center">Học phí còn nợ</th>
                                   <th class="text-center">Phụ phí còn nợ</th>
                                   <th>Hành Động</th>
                                </tr>
                            </tfoot>
                               <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="text-center">BKC1000{{ $student->idStudent}}</td>
                                    <td class="text-center">{{ $student->nameStudent }} </td>
                                    <td class="text-center">{{ date('d/m/Y', strtotime($student->dateBirth))}}</td>
                                    <td class="text-center">{{$student->nameGrade}}</td>
                                    <td class="text-center">{{$student->namePaymentOption}}</td>
                                    <td class="text-center">{{ number_format($student->amount)}}VNĐ</td>
                                    <th class="text-center">Phụ phí còn nợ</th>
                                    <td class="text-center">
                                        <a href="{{ route('fee.edit', $student->idStudent) }}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-eye"></i></a>
                                        <a href="{{ route('fee.show', $student->idStudent) }}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-credit-card"></i></a>
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