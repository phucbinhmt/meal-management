@extends('layouts.authenticated')

@section('title')
    {{ $title }}
@endsection

@section('scripts')
    @vite(['resources/js/plansearch.js'])
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
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-header mt-3 border-0 pb-0">
                        <h5 class="card-title fw-semibold ms-2 mb-3">{{ $title }}</h5>
                        <div class="row px-2">
                            <div class="col-auto">
                                <form action="" method="GET" class="form-search">
                                    <div class="row g-2 justify-content-end">
                                        <div class="col-auto">
                                            <div class="form-group search-box">
                                                <span class="fa fa-search search-icon"></span>
                                                <input type="search" name="keyword" class="form-control"
                                                    placeholder="Nhập từ khóa..." value="{{ request()->keyword }}">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </form>
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
                                        <a href="{{ route('search', [$date_parse->copy()->subDay()->format('Y-m-d'),1]) }}"
                                            role="button" class="btn btn-icon btn-primary">
                                            <i class="fa-regular fa-angle-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('search', [$date_parse->copy()->addDay()->format('Y-m-d'),1]) }}"
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
                            @foreach ($plans as $plan)
                                <div class="col-12">
                                    <div class="card card-plan ps-2 border-1 d-flex flex-row justify-content-center">
                                        <div class="card-header d-flex align-items-center">
                                            <img src="{{ asset('images/users/' . ($plan->user->image ?? 'user-placeholder.png')) }}"
                                                class="avatar-large img-fluid rounded" alt="image">
                                            <div class="ps-4">
                                                <h6 class="card-title fw-semibold">{{ $plan->user->user_id }}</h6>
                                                <p class="card-text">
                                                    {{ $plan->user->last_name . ' ' . $plan->user->first_name }}</p>
                                            </div>
                                        </div>
                                        <div class="card-body my-auto">
                                            <div class="row">
                                                <div class="col-4  d-flex align-items-center justify-content-center">
                                                    <span>Số món: {{ $plan->dishes->count() }}</span>
                                                </div>
                                                <div class="col-5  d-flex align-items-center justify-content-center">
                                                    @php
                                                        $total = 0;
                                                        foreach ($plan->dishes as $dish) {
                                                            $total += $dish->pivot->quantity * $dish->price;
                                                        }
                                                    @endphp
                                                    <span>Tổng tiền: {{ number_format($total, 0, '.', ',') }}đ</span>
                                                </div>
                                                <div class="col-3  d-flex align-items-center justify-content-center">
                                                    @if ($plan->status == config('constants.WAITING_PLAN'))
                                                        <span class="badge text-bg-info">Đang chờ</span>
                                                    @elseif ($plan->status == config('constants.READY_PLAN'))
                                                        <span class="badge text-bg-success">Sẵn sàng</span>
                                                    @else
                                                        <span class="badge text-bg-secondary">Đã phát</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center">
                                            <div class="row">
                                                <div class="col-auto">
                                                    {{-- Form confirm --}}
                                                    <form action="{{ route('plans.status') }}" method="POST">
                                                        @csrf
                                                        <!-- Button trigger modal -->
                                                        <input type="hidden" name="plan_id" id="plan_id"
                                                            value="{{ $plan->plan_id }}">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirm_modal_{{ $plan->plan_id }}">
                                                            Xem chi tiết
                                                        </button>
                                                        <!-- Modal Confirm -->
                                                        <div class="modal fade" id="confirm_modal_{{ $plan->plan_id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-confirm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header flex-column">
                                                                        <h5 class="fw-semibold">Chi tiết suất ăn</h5>
                                                                    </div>
                                                                    <div class="modal-body p-2">
                                                                        @foreach ($plan->dishes as $dish)
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-7 d-flex justify-content-end">
                                                                                    <span>{{ $dish->dish_name }}</span>
                                                                                </div>
                                                                                <div
                                                                                    class="col-5 d-flex justify-content-start">
                                                                                    <span>x{{ $dish->pivot->quantity }}</span>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="modal-footer mt-3 justify-content-center">
                                                                        <button type="button"
                                                                            class="btn btn-secondary me-3"
                                                                            data-bs-dismiss="modal">Quay lại</button>
                                                                        <button type="submit"
                                                                            class="btn btn-success">Phát</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    {{-- End form confirm --}}
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
