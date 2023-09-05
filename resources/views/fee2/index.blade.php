@extends('layouts.app')
@section('content')
{{-- <div class="content"> 
  <div class="text-right">
        <a href="{{ route('feee.create')}}" class="btn btn-info btn-fill btn-wd">Thêm </a>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách học phí các ngành</h4>
            <form class="navbar-form navbar-left navbar-search-form" role="search">
            </form>
        </div>

        <div class="card-content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                    <th class="text-center">Ngành</th>
                    <th class="text-center">Khóa</th>
                    <th class="text-center">Học phí</th>
                </thead>
                <tbody>
                    @foreach ($fees as $fee)
                        <tr>
                            <th class="text-center">{{$fee->nameMajor}}</th>
                            <th class="text-center">{{$fee->nameCourse}}</th>
                            <th class="text-center">{{$fee->fee}}</th>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>  
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
                    <a href="{{ route('feee.create')}}" class="btn btn-info btn-fill btn-wd">Thêm học phí </a>
                </div>
                <h4 class="title">Danh sách hình thức nộp học phí</h4>
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
                                    <th class="text-center">Ngành</th>
                                    <th class="text-center">Khóa</th>
                                    <th class="text-center">Học phí</th>
                                    <th class="text-center">Ngày bắt đầu </th>
                                    <th class="text-center">Ngày kết thúc </th>
                                    {{-- <th class="disabled-sorting">Hành Động</th> --}}
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Ngành</th>
                                    <th class="text-center">Khóa</th>
                                    <th class="text-center">Học phí</th>
                                    <th class="text-center">Ngày bắt đầu </th>
                                    <th class="text-center">Ngày kết thúc </th>
                                    {{-- <th>Hành Động</th> --}}
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($fees as $fee)
                                <tr>
                                    <th class="text-center">{{$fee->nameMajor}}</th>
                                    <th class="text-center">{{$fee->nameCourse}}</th>
                                    <th class="text-center">{{number_format($fee->fee) }}</th>
                                    <th class="text-center">{{ date('d/m/Y', strtotime($fee->startDate)) }}</th>
                                    <th class="text-center">{{date('d/m/Y', strtotime($fee->endDate))}}</th>
                                     {{-- <td> --}}
                                        {{-- <a href="{{  route('payment.edit', $payment->idPaymentOption)  }}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a> --}}
                                        {{-- <a href="fee2.edit" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                    </td> --}}
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