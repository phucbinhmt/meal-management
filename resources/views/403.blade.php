@extends('layouts.authenticated')

@section('title')
    Không có quyền truy cập
@endsection

@section('content')
    <div class="container px-5">
        <div class="row px-5 justify-content-center">
            <div class="col-6 px5">
                <div class="card border-0 shadow-sm py-5">
                    <div class="card-header">
                        <h1 class="text-center fw-bolder" style="font-size: 80px">403!</h1>
                        <p class="text-center">Bạn không có quyền truy cập đến trang này</p>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <a class="btn btn-primary" href="{{ route('dashboard') }}" role="button">Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
