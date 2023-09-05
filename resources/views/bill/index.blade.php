@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-success text-center">
                                        <i class="ti-wallet"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Tổng tiền/số hóa đơn </p>
                                        <p>{{number_format($total_amount)}}VNĐ/{{$total_bill}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-reload"></i> Ngày hôm nay
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-success text-center">
                                        <i class="ti-wallet"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Tổng tiền/số hóa đơn</p>
                                        <p>{{number_format($total_amount2)}}VNĐ/{{$total_bill2}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-calendar"></i> Ngày hôm qua
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-success text-center">
                                        <i class="ti-wallet"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Tổng tiền/số hóa đơn </p>
                                        <p>{{number_format($total_amount3)}}VNĐ/{{$total_bill3}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-timer"></i> Tháng này
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-success text-center">
                                        <i class="ti-wallet"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Tổng tiền/số hóa đơn </p>
                                        <p>{{number_format($total_amount4)}}VNĐ/{{$total_bill4}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-reload"></i> Tháng trước
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="get" action="{{route('bill.index') }}">
                @csrf
                <div class="card-content">
                    <div class="form-group">
                        <label>Ngày bắt đầu</label>
                        <input type="date" name="startDate" value="{{ isset($startDate) ?$startDate : '' }}" class="form-control">
                        <label>Ngày kết thúc</label>
                        <input type="date" name="endDate" value="{{ isset($endDate) ?$endDate : '' }}" class="form-control">
                      
                    </div>
                   <center><button type="submit" class="btn btn-fill btn-info">Tìm kiếm</button></center> 
                   @if (Session::exists('error'))
                   <div class="alert alert-danger">
                       {{ Session::get('error.message') }}
                   </div>
               @endif
                </div>
            </form>
            <div class="row">
                @if(session()->has('success1'))
                <div class="alert alert-info">
                    {{ session()->get('success1') }}
                </div>
            @endif
                <div class="col-md-12">
                    <div class="text-right">
                        {{-- <a href="{{ route('grade.create')}}" class="btn btn-info btn-fill btn-wd">Thêm lớp học </a> --}}
                    </div>
                    <h4 class="title">Danh sách hóa đơn</h4>
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
                                        <th class="text-center">Mã hóa đơn</th>
                                        <th class="text-center">Mã sinh viên</th>
                                        <th class="text-center">Tên sinh viên</th>
                                        <th class="text-center">Hình thức nộp</th>
                                        <th class="text-center">Số tiền</th>
                                        <th class="text-center">Ngày</th>
                                        <th class="text-center">Ghi chú</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Mã hóa đơn</th>
                                        <th class="text-center">Mã sinh viên</th>
                                        <th class="text-center">Tên sinh viên</th>
                                        <th class="text-center">Hình thức nộp</th>
                                        <th class="text-center">Số tiền</th>
                                        <th class="text-center">Ngày</th>
                                        <th class="text-center">Ghi chú</th>
                                     
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($bills as $bill)
                                    <tr>
                                        <td class="text-center">{{$bill->idBill}}</td>
                                        <td class="text-center">BKC1000{{$bill->idStudent}}</td>
                                        <td class="text-center">{{$bill->nameStudent}}</td>
                                        <td class="text-center">{{$bill->namePaymentOption}}</td>
                                        <td class="text-center">{{number_format($bill->feeBill) }} VNĐ</td>                                        
                                        <td class="text-center">{{date('H:i:s d/m/Y', strtotime($bill->created_at))}}</td>
                                        <td class="text-center">{{$bill->note}}</td>

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
        <script type="text/javascript">
            $().ready(function(){
                // Init Sliders
                demo.initFormExtendedSliders();
                // Init DatetimePicker
                demo.initFormExtendedDatetimepickers();
            });
        </script>
@endsection