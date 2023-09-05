@extends ('layouts.appstudent')
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
                <h4 class="title">Danh sách các môn học lại của ngành {{$major->nameMajor}} {{$course->nameCourse}}  </h4>
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
                                    <th class="text-center">Mã môn học lại</th>
                                    <th class="text-center">Tên môn </th>
                                    <th class="text-center">Sô tiền</th>
                                    <th class="text-center">Ngày nộp</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="disabled-sorting">Hành Động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Mã môn học lại</th>
                                    <th class="text-center">Tên môn </th>
                                    <th class="text-center">Sô tiền</th>
                                    <th class="text-center">Ngày nộp</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th>Hành Động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($Additinalfees as $Additinalfee)
                                <tr>
                                    <th class="text-center">{{$Additinalfee->idAdditionalFees}}</th>
                                    <th class="text-center">{{$Additinalfee->nameAdditionalFees}}</th>
                                    <th class="text-center">{{number_format($Additinalfee->amount) }}</th>
                            
                                    <th class="text-center">{{ date('d/m/Y', strtotime($Additinalfee->dueDate))}}</th>
                                    <th class="text-center">
                                    @if ($Additinalfee->status== 0 )
                                        <div class="alert alert-info">Đang mở đăng kí</div>
                                    @elseif ($Additinalfee->status== 1 )
                                    <div class="alert alert-success">Đã đăng kí</div>
                                    @elseif ($Additinalfee->status== 2 )
                                    <div class="alert alert-success">Đã Nộp</div>
                                    @elseif ($Additinalfee->dueDate < now() )
                                    <div class="alert alert-danger">Đã hết hạn đang ký</div>
                                    @endif</th>
                                    <th class="text-center">
                                        @if ($Additinalfee->status== 0 )
                                        <a href="{{route('additinalfeesStd.show', $Additinalfee->idAdditionalFees)}}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-eye">
                                        {{-- @elseif() --}}
                                        @endif</i></a>
                                    </th>
                                </tr>
                               @endforeach
                               </tbody>
                            </table>
                        </div>
                        <a href="{{ route ('fee.index') }}"><i class="ti-arrow-left">Quay lại</i></a>

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
        demo1 = {


    showSwal: function(type){
    if(type == 'basic'){
        swal({
            title: "Here's a message!",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-success btn-fill"
        });

    }else if(type == 'title-and-text'){
        swal({
            title: "Here's a message!",
            text: "It's pretty, isn't it?",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-info btn-fill"
        });

    }else if(type == 'success-message'){
        swal({
            title: "Thành công!",
            text: "Bạn đã đăng ký môn học thành công!",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-success btn-fill",
            type: "success"
        });

    }else if(type == 'warning-message-and-confirmation'){
        swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success btn-fill',
                cancelButtonClass: 'btn btn-danger btn-fill',
                confirmButtonText: 'Yes, delete it!',
                buttonsStyling: false
            }).then(function() {
              swal({
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                type: 'success',
                confirmButtonClass: "btn btn-success btn-fill",
                buttonsStyling: false
                })
            });
    }else if(type == 'warning-message-and-cancel'){
        swal({
                title: 'Bạn có chắc chắc đăng ký?',
                text: 'Bạn sẽ không thể khôi phục',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy!',
                confirmButtonClass: "btn btn-success btn-fill",
                cancelButtonClass: "btn btn-danger btn-fill",
                buttonsStyling: false
            }).then(function() {
              window.location.href = "{{route('history.index')}}"; // Chuyển sang trang khác
            }, function(dismiss) {
              // Nếu người dùng nhấn nút hủy, không có gì xảy ra
              if (dismiss === 'cancel') {
                swal({
                  title: 'Đã hủy',
                  text: 'Bạn đã hủy đăng ký môn học',
                  type: 'error',
                  confirmButtonClass: "btn btn-info btn-fill",
                  buttonsStyling: false
                })
              }
            })

    }else if(type == 'custom-html'){
        swal({
            title: 'HTML example',
            buttonsStyling: false,
            confirmButtonClass: "btn btn-success btn-fill",
            html:
                    'You can use <b>bold text</b>, ' +
                    '<a href="http://github.com">links</a> ' +
                    'and other HTML tags'
            });

    }else if(type == 'auto-close'){
        swal({ title: "Auto close alert!",
               text: "I will close in 2 seconds.",
               timer: 2000,
               showConfirmButton: false
            });
    } else if(type == 'input-field'){
        swal({
                title: 'Input something',
                html: '<div class="form-group">' +
                          '<input id="input-field" type="text" class="form-control" />' +
                      '</div>',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success btn-fill',
                cancelButtonClass: 'btn btn-danger btn-fill',
                buttonsStyling: false
            }).then(function(result) {
                swal({
                    type: 'success',
                    html: 'You entered: <strong>' +
                            $('#input-field').val() +
                          '</strong>',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    buttonsStyling: false

                })
            }).catch(swal.noop)
        }
    },
}
	</script>

@endsection