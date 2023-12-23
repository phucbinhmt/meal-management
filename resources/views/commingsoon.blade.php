@extends('layouts.authenticated')

@section('title')
    Sắp ra mắt
@endsection

@section('content')
    <div class="container px-5">
        <div class="row px-5 justify-content-center">
            <div class="col-6 px5">
                <div class="card border-0 shadow-sm py-5">
                    <div class="card-header">
                        <h1 class="text-center fw-bolder" style="font-size: 50px">Comming Soon!</h1>
                        <p class="text-center">Chức năng này đang được phát triển</p>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <a class="btn btn-primary" href="{{ route('dashboard') }}" role="button">Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
