@extends('layouts.authenticated')

@section('title')
    {{ $title }}
@endsection

@section('scripts')
    @vite(['resources/js/plancooking.js'])
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
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-header mt-3 border-0 pb-0">
                        <h5 class="card-title fw-semibold ms-2 mb-3">{{ $title }}</h5>
                        <div class="row px-2">
                            <div class="col-auto">
                                {{-- Form confirm --}}
                                <form action="{{ route('plans.status') }}" method="POST">
                                    @csrf
                                    <!-- Button trigger modal -->
                                    <input type="hidden" name="date" id="date" value="{{ $date }}">
                                    <input type="hidden" name="session" id="session" value="{{ $session }}">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#confirm_modal_{{ $date }}">
                                        Hoàn thành
                                    </button>
                                    <!-- Modal Confirm -->
                                    <div class="modal fade" id="confirm_modal_{{ $date }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-confirm">
                                            <div class="modal-content">
                                                <div class="modal-header flex-column">
                                                    <div class="icon-box icon-box-success">
                                                        <i class="fa-fw fa-regular fa-check"></i>
                                                    </div>
                                                    <h6 class="modal-title w-100 fw-bolder mt-4">Xác nhận hoàn thành?
                                                    </h6>
                                                </div>
                                                <div class="modal-body p-2">
                                                    <p>Hãy đảm bảo tất cả các món ăn đã được chuẩn bị? Quá trình này
                                                        không thể được hoàn tác.</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-secondary me-3"
                                                        data-bs-dismiss="modal">Hủy bỏ</button>
                                                    <button type="submit" class="btn btn-success">Xác nhận</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- End form confirm --}}
                            </div>
                            <div class="col">
                                <div class="row g-2 justify-content-end">
                                    <div class="col-auto">
                                        <select class="form-select" name="session" id="session">
                                            <option value="{{ config('constants.MORNING_SESSION') }}"
                                                @if ($session == config('constants.MORNING_SESSION')) selected @endif>
                                                Buổi sáng
                                            </option>
                                            <option value="{{ config('constants.NOON_SESSION') }}"
                                                @if ($session == config('constants.NOON_SESSION')) selected @endif>
                                                Buổi trưa
                                            </option>
                                            <option value="{{ config('constants.EVENING_SESSION') }}"
                                                @if ($session == config('constants.EVENING_SESSION')) selected @endif>
                                                Buổi tối
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" name="date" id="date" class="form-control"
                                            value="{{ $date_parse->toDateString() }}">
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('cooking', [$date_parse->copy()->subDay()->format('Y-m-d'),1]) }}"
                                            role="button" class="btn btn-icon btn-primary">
                                            <i class="fa-regular fa-angle-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('cooking', [$date_parse->copy()->addDay()->format('Y-m-d'),1]) }}"
                                            role="button" class="btn btn-icon btn-primary">
                                            <i class="fa-regular fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mx-0 px-0 pb-4 mt-1">
                        <div class="row px-4 g-3">
                            @foreach ($list_dishes as $dish_obj)
                                <div class="col-12">
                                    <div class="card card-plan ps-2 border-1 d-flex flex-row justify-content-center">
                                        <div class="card-header card-header-fixed d-flex align-items-center">
                                            <img src="{{ asset('images/dishes/' . ($dish_obj['dish']->image ?? 'dish-placeholder.jpg')) }}"
                                                class="avatar-large img-fluid rounded" alt="image">
                                            <div class="ps-4">
                                                <h6 class="card-title fw-semibold">{{ $dish_obj['dish']->dish_name }}</h6>
                                                <p class="card-text">
                                                    {{ number_format($dish_obj['dish']->price, 0, '.', ',') }}đ</p>
                                            </div>
                                        </div>
                                        <div class="card-body my-auto">
                                            <div class="row">
                                                <div class="col-4  d-flex align-items-center justify-content-center">
                                                    <span>Số lượng: {{ $dish_obj['total'] }}</span>
                                                </div>
                                                <div class="col-6  d-flex align-items-center justify-content-end">
                                                    @if ($dish_obj['status'] == config('constants.WAITING_PLAN'))
                                                        <span class="badge text-bg-info">Đang chờ</span>
                                                    @elseif ($dish_obj['status'] == config('constants.READY_PLAN'))
                                                        <span class="badge text-bg-success">Sẵn sàng</span>
                                                    @else
                                                        <span class="badge text-bg-secondary">Đã phát</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
