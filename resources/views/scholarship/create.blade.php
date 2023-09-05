@extends('layouts.app')
@section('content')
    <div class="card">
        {{-- Thêm thì các bạn sử dụng cho chị post --}}
        <form method="post" action="{{ route('scholarship.store') }}">
            @csrf
            <div class=" card-header">
                <h4 class="card-title">
                    Thêm học bổng
                </h4>
            </div>
            <div class="card-content">
                <div class="form-group">
                    <label>Giá trị học bổng (VNĐ)</label>
                    <input type="text" name="name" class="form-control">
                    @if (Session::exists('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error.message') }}
                    </div>
                @endif
                </div>
               <center><button type="submit" class="btn btn-fill btn-info">Thêm</button></center> 
            </div>
            <a href="{{ route ('scholarship.index') }}"><i class="ti-arrow-left">Quay lại</i></a>
        </form>
    </div>
@endsection