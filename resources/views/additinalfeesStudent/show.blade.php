@extends ('layouts.appstudent')
@section('content')

<div class="card">
    {{-- Thêm thì các bạn sử dụng cho chị post --}}
    <form method="post" action="{{ route('additinalfeesStd.store') }}" id='create-addtinalfees-form'>
        @csrf
        <div class=" card-header">
            <h4 class="card-title">
                Thông tin môn học lại : {{$Additinalfee->nameAdditionalFees }}
            </h4>
        </div>
        <div class="card-content">
            <div class="form-group">
                
                <input type="hidden" name="idAdditionalFees" class="form-control" value='{{$Additinalfee->idAdditionalFees }}'>
                <label>Tên môn học lại</label>
                <input type="text" name="nameAdditionalFees" class="form-control" value='{{$Additinalfee->nameAdditionalFees }}' disabled>
                <label>Số tiền</label>
                <input type="number" name="amount" class="form-control" value='{{$Additinalfee->amount}}' disabled>
                <label>Ngành</label>
                <input type="text" name="major" class="form-control" value='{{$Additinalfee->nameMajor}}' disabled >
                <label>Khóa</label>
                <input type="text" name="course" class="form-control" value='{{$Additinalfee->nameCourse}}'disabled>
                <label>Loại phụ phí</label><br>
                <div class="radio">
                    <input type="radio" name="role"  id="radio1" value="0" checked="" disabled>
                    <label for="radio1">
                        Môn học lại
                    </label>
                </div>

                <div class="radio">
                    <input type="radio" name="role" id="radio2" value="1" disabled>
                    <label for="radio2">
                        Phụ phí phải đóng
                    </label>
                </div>
                <label>Ngày hết hạn đăng kí </label>
                <input type="date" name="dueDate" class="form-control" value='{{$Additinalfee->dueDate}}' disabled>
            @if (Session::exists('error'))
            <div class="alert alert-danger">
                {{ Session::get('error.message') }}
            </div>
        @endif
            </div>
           <center><button class="btn btn-info btn-fill" >Đăng ký</button></center> 
        </div>
        <a href="{{ route ('additinalfeesStd.index') }}"><i class="ti-arrow-left">Quay lại</i></a>
    </form>
</div>
<script>
    $('#create-addtinalfees-form').submit(function (event) {
        event.preventDefault();
        swal({
            title: "Bạn có chắc chắn muốn tạo bản ghi mới?",
            text: "Hành động này không thể hoàn tác!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-success",
            cancelButtonClass: "btn btn-danger",
            confirmButtonText: "Tạo mới",
            buttonsStyling: false
        }).then(function () {
            // Gửi dữ liệu đến máy chủ để tạo bảng ghi mới
            $.ajax({
                method: "POST",
                url: "{{ route('additinalfeesStd.store') }}",
                data: $('#create-addtinalfees-form').serialize()
            }).done(function (response) {
                // Hiển thị thông báo tạo bảng ghi mới thành công
                swal("Tạo bảng ghi mới thành công!", "", "success");
            }).fail(function (error) {
                // Hiển thị thông báo lỗi nếu không thể tạo bảng ghi mới
                swal("Lỗi!", "Không thể tạo bảng ghi mới.", "error");
            });
        }, function (dismiss) {
            // Nếu người dùng nhấn nút Hủy, không làm gì cả
        });
    });
</script>
@endsection