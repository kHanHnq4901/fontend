@extends('layouts.app')
@section('content')
    <div class="card">
        {{-- Thêm thì các bạn sử dụng cho chị post --}}
        <form method="post" action="{{ route('major.store') }}">
            @csrf
            <div class=" card-header">
                <h4 class="card-title">
                    Thêm ngành học
                </h4>
            </div>
            <div class="card-content">
                <div class="form-group">
                    <label>Thêm ngành</label>
                    <input type="text" name="name" class="form-control">
                    @if (Session::exists('error'))
												<div class="alert alert-danger">
													{{ Session::get('error.message') }}
												</div>
											@endif
                </div>
                <center><button type="submit" class="btn btn-fill btn-info">Thêm</button></center>
            </div>           
            <a href="{{ route ('major.index') }}"><i class="ti-arrow-left">Quay lại</i></a>
        </form>
    </div>
    	
@endsection