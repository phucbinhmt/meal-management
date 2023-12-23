@extends('layouts.authenticated')

@section('title')
    Bảng điều khiển
@endsection

@section('content')
    <div class="container px-5">
        <div class="row px-5 justify-content-center">
            <div class="col-6 px5">
                <div class="card border-0 shadow-sm py-5">
                    <div class="card-header">
                        <h1 class="text-center fw-bolder" style="font-size: 50px">Chào mừng!</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <span>Mã nhân viên:</span>
                            </div>
                            <div class="col-6">
                                <span>{{ Auth::user()->user_id }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <span>Họ và tên:</span>
                            </div>
                            <div class="col-6">
                                <span>{{ Auth::user()->full_name }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <span>Chức vụ:</span>
                            </div>
                            <div class="col-6">
                                <span>{{ Auth::user()->position->position_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
