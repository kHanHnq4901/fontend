@extends('layouts.app')
@section('content')
{{-- <div class="content"> 
    <div class="text-right">
        <a href="{{route('scholarship.create') }}" class="btn btn-info btn-fill btn-wd">Thêm học bổng </a>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Danh sách học bổng </h4>
        </div>

        <div class="card-content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                    <th class="text-center">Mã</th>
                    <th class="text-center">Học bổng</th>
                    <th class="text-center">Sửa</th>
                    
                </thead>
                <tbody>
                  @foreach ($scholarships as $scholarship) 
                        <tr>
                            <th class="text-center">{{ $scholarship->idScholarship }}</th>
                            <th class="text-center">{{ $scholarship->fee }}</th> 
                            <th class="text-center"><a class="btn btn-warning btn-sm"
                                    href="{{ route('scholarship.edit', $scholarship->idScholarship) }}">Sửa</a></th>
                        </tr>
                   @endforeach 
                    
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
{{-- <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="title">Danh sách học bổng </h4>
                <p class="category">A powerful jQuery plugin handcrafted by our friends from <a href="https://datatables.net/" target="_blank">dataTables.net</a>. It is a highly flexible tool, based upon the foundations of progressive enhancement and will add advanced interaction controls to any HTML table. Please check out the <a href="https://datatables.net/manual/index" target="_blank">full documentation.</a></p>
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
                                    <th>Mã</th>                                  
                                    <th>Office</th>
                                    <th class="disabled-sorting">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Mã</th>
                                    <th>Office</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($scholarships as $scholarship) 
                                <tr>
                                    <th class="text-center">{{ $scholarship->idScholarship }}</th>
                                    <th class="text-center">{{ $scholarship->fee }}</th> 
                                    <th>
                                        <a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
                                        <a href="{{ route('scholarship.edit', $scholarship->idScholarship) }}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
                                    </th>
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
</div> --}}
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
                    <a href="{{route('scholarship.create') }}" class="btn btn-info btn-fill btn-wd">Thêm học bổng </a>
                </div>
                <h4 class="title">Danh sách học bổng</h4>
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
                                    <th>Mã học bổng</th>
                                    <th>Giá trị</th>
                                    <th class="disabled-sorting">Hành Động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Mã học bổng</th>
                                    <th>Giá trị</th>
                                    <th>Hành Động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($scholarships as $scholarship) 
                                <tr>
                                    <td>{{ $scholarship->idScholarship }}</td>
                                    <td>{{number_format($scholarship->fee) }} VNĐ</td>
                                    <td>
                                        <a href="{{ route('scholarship.edit', $scholarship->idScholarship) }}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                        {{-- <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a> --}}
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
	            alert( 'Bạn chỉnh sửa học bổng mã: ' + data[0] );
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