@extends('layouts.authenticated')

@section('title')
    {{ $title }}
@endsection

@section('scripts')
    @vite(['resources/js/menushow.js'])
@endsection

@section('content')
    {{-- Notify --}}
    @if (Session::has('success'))
        <div class="notify shadow-sm active">
            <div class="notify-content">
                <div class="icon-box icon-box-success">
                    <i class="fa-fw fa-regular fa-check"></i>
                </div>
                <div class="message">
                    <h5 class="message-title">Thành công</h5>
                    <p>{{ Session::get('success') }}</p>
                </div>
            </div>
            <i class="fa-solid fa-xmark close"></i>
            <div class="progress active"></div>
        </div>
    @elseif (Session::has('failed'))
        <div class="notify shadow-sm active">
            <div class="notify-content">
                <div class="icon-box icon-box-failed">
                    <i class="fa-fw fa-regular fa-xmark"></i>
                </div>
                <div class="message">
                    <h5 class="message-title">Thất bại</h5>
                    <p>{{ Session::get('failed') }}</p>
                </div>
            </div>
            <i class="fa-solid fa-xmark close"></i>
            <div class="progress active"></div>
        </div>
    @endif
    {{-- End notify --}}
    <div class="container px-5">
        <div class="row gx-3 justify-content-center">
            <div class="col-9">
                <div class="card card-main border-0 h-100 shadow-sm">
                    <div class="card-header mt-3 border-0 pb-0">
                        <h5 class="card-title fw-semibold ms-2 mb-3">{{ $title }}</h5>
                        <div class="row px-2">
                            <div class="col-auto">
                                <a href="{{ route('menus.edit', $date) }}" class="btn btn-primary" role="button">Cập
                                    nhật</a>
                            </div>
                            <div class="col">
                                <div class="row g-2 justify-content-end">
                                    <div class="col-auto">
                                        <input type="date" name="date" id="date" class="form-control"
                                            value="{{ $date_parse->toDateString() }}">
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('menus.show',$date_parse->copy()->subDay()->format('Y-m-d')) }}"
                                            role="button" class="btn btn-icon btn-primary">
                                            <i class="fa-regular fa-angle-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('menus.show',$date_parse->copy()->addDay()->format('Y-m-d')) }}"
                                            role="button" class="btn btn-icon btn-primary">
                                            <i class="fa-regular fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mx-0 px-0 pb-4 mt-1">
                        @if ($menu)
                            <div
                                class="row px-2 g-3 row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-sm-1">
                                @foreach ($menu->dishes as $dish)
                                    <div class="col d-flex justify-content-center">
                                        <div class="card card-dish shadow-sm border-0">
                                            <img class="card-img-top img-fluid p-0"
                                                src="{{ asset('images/dishes/' . ($dish->image ?? 'dish-placeholder.jpg')) }}"
                                                alt="image">
                                            <div class="card-img-overlay p-0">
                                                {{-- <span class="text-description text-bg-info px-2 rounded">Đã đặt: 2</span> --}}
                                            </div>
                                            <div class="card-body text-center p-2">
                                                <h6 class="card-title fw-semibold">{{ $dish->dish_name }}</h6>
                                                <p class="card-text">{{ number_format($dish->price, 0, '.', ',') }}đ</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-center">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Không có món ăn nào trong thực đơn</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
