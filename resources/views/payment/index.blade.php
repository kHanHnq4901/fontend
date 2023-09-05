@extends('layouts.app')
@section('content')
{{-- <div class="content"> 
    <div class="text-right">
        <a href="{{ route('payment.create') }}" class="btn btn-info btn-fill btn-wd">Thêm </a>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Danh sách các hình thức nộp </h4>
        </div>

        <div class="card-content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                    <th class="text-center">Mã</th>
                    <th class="text-center">Tên</th>
                    <th class="text-center">Giảm học phí</th>
                    <th class="text-center">Sửa</th>
                    
                </thead>
                <tbody>
                   @foreach ($payments as $payment) 
                        <tr>
                            <th class="text-center">{{ $payment->idPaymentOption  }}</th>
                            <th class="text-center">{{ $payment->namePaymentOption }}</th>
                            <th class="text-center">{{ $payment->discount ."%" }} </th>  
                            <th class="text-center"><a class="btn btn-warning btn-sm"
                                    href="{{ route('payment.edit', $payment->idPaymentOption) }}">Sửa</a></th>
                           
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
                    <a href="{{ route('payment.create') }}" class="btn btn-info btn-fill btn-wd">Thêm hình thức </a>
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
                                    <th class="text-center">Mã</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Giảm học phí</th>
                                    <th class="text-center">Số đợt nộp</th>
                                    <th class="disabled-sorting">Hành Động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Mã</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Số đợt nộp</th>
                                    <th class="text-center">Giảm học phí</th>
                                    <th>Hành Động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($payments as $payment) 
                                <tr>
                                    <td class="text-center">{{ $payment->idPaymentOption  }}</td>
                                    <td class="text-center">{{ $payment->namePaymentOption }}</td>
                                    <td class="text-center">{{ $payment->discount ."%" }} </td>  
                                    <td class="text-center">{{ $payment->depositInstallment}}</td>

                                    <td>
                                        <a href="{{  route('payment.edit', $payment->idPaymentOption)  }}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
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
	</script>
@endsection