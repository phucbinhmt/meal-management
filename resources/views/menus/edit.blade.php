@extends('layouts.authenticated')

@section('title')
    {{ $title }}
@endsection

@section('scripts')
    @vite(['resources/js/menuedit.js'])
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
            <div class="col-8">
                <div class="card card-main border-0 h-100 shadow-sm">
                    <div class="card-header mt-3 border-0 pb-0">
                        <h5 class="card-title fw-semibold ms-2 mb-3">{{ $title }}</h5>
                        <div class="row px-2 g-2">
                            <div class="col-auto">
                                <button id="deleteAll" type="button" class="btn btn-danger">Xóa hết</button>
                            </div>
                            <div class="col">
                                <div class="row g-2 justify-content-end">
                                    <div class="col-auto">
                                        <select class="form-select" name="dish_types" id="dish_types">
                                            @foreach ($dish_types as $dish_type)
                                                <option value="{{ $dish_type->dish_type_id }}">
                                                    {{ $dish_type->dish_type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mx-0 px-0 pb-4 mt-1">
                        @foreach ($dish_types as $dish_type)
                            <div id="list_dish_{{ $dish_type->dish_type_id }}"
                                class="row d-none px-2 g-3 row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-sm-1">
                                @foreach ($dish_type->dishes as $dish)
                                    <div class="col d-flex justify-content-center">
                                        <div class="card card-dish shadow-sm border-0" data-dish-id="{{ $dish->dish_id }}">
                                            <img class="card-img-top img-fluid p-0"
                                                src="{{ asset('images/dishes/' . ($dish->image ?? 'dish-placeholder.jpg')) }}"
                                                alt="image">
                                            <div class="card-img-overlay text-end p-0">
                                                <span class="text-description text-bg-success px-2 rounded d-none">Đã
                                                    chọn</span>
                                            </div>
                                            <div class="card-body text-center p-2">
                                                <h6 class="card-title fw-semibold">{{ $dish->dish_name }}</h6>
                                                <p class="card-text">{{ number_format($dish->price, 0, '.', ',') }}đ</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-main border-0 h-100 shadow-sm">
                    <div class="card-header mt-3 border-0 pb-0">
                        <h5 id="total_message" class="card-title fw-semibold ms-2 mb-3">Đã chọn: <span></span></h5>
                    </div>
                    <div class="card-body mx-0 px-0 pb-4 mt-1">
                        <div id="list_selected" class="row px-3 g-2">

                        </div>
                    </div>
                    <div class="card-footer"></div>
                    <form id="dishForm" action="{{ route('menus.update', $date) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center pb-3">
                            <div class="col-auto">
                                <a href="{{ route('menus.show', $date) }}" class="btn btn-secondary" role="button">Quay
                                    lại</a>
                            </div>
                            <div class="col-auto">
                                <input type="hidden" name="dishes" id="dishes"
                                    value="{{ old('dishes', $menu ? json_encode($menu->dishes) : '') }}">
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
