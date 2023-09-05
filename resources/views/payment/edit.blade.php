@extends('layouts.app')
@section('content')
    <div class="card">
        {{-- Thêm thì các bạn sử dụng cho chị post --}}
        <form method="post" action="{{ route('payment.update', $paymentOption->idPaymentOption) }}">
            @method("PUT")
            @csrf
            <div class=" card-header">
                <h4 class="card-title">
                    Sửa hình thức
                </h4>
            </div>
            <div class="card-content">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" class="form-control" value="{{ $paymentOption->namePaymentOption }}">
                    <label>Giảm giá (%)</label>
                    <input type="text" name="discount" class="form-control" value="{{ $paymentOption->discount}}">
                    <label>Số lần đóng tiền</label>
                    <input type="number" name="depositInstallment" class="form-control" value="{{ $paymentOption->depositInstallment}}">
                    @if (Session::exists('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error.message') }}
                    </div>
                @endif
                </div>
                <center><button type="submit" class="btn btn-fill btn-info">Sửa</button></center>
            </div>
            <a href="{{ route ('payment.index') }}"><i class="ti-arrow-left">Quay lại</i></a>
        </form>
    </div>
@endsection