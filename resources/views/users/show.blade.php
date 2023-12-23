@extends('layouts.authenticated')

@section('title')
    {{ $title }}
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
        <div class="row gx-4 px-5">
            <div class="col-12 px-5">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-header ms-2 mt-3 mb-2 ps-4 border-0 pb-0 d-flex">
                        <h5 class="card-title fw-bolder me-4">{{ $title }}</h5>
                    </div>
                    <div class="card-body mx-3">
                        <div class="row g-4">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{{ asset('images/users/' . ($user->image ?? 'user-placeholder.png')) }}"
                                            class="image-preview img-fluid img-thumbnail mb-3" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 ps-4 align-self-center">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="mb-3">Mã nhân viên: {{ $user->user_id }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-3">Họ và tên: {{ $user->last_name . ' ' . $user->first_name }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-3">Giới tính:
                                            {{ $user->gender == config('constants.MALE_GENDER') ? 'Nam' : 'Nữ' }}
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-3">Ngày sinh:
                                            {{ \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-3">Địa chỉ: {{ $user->address->province_name }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-3">Số điện thoại: {{ $user->phone }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-3">Email: {{ $user->email }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-3">Chức vụ: {{ $user->position->position_name }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-3">Trạng thái:
                                            @if ($user->status == config('constants.ACTIVE_USER'))
                                                <span class="badge text-bg-success">Hoạt động</span>
                                            @else
                                                <span class="badge text-bg-danger">Tạm ngưng</span>
                                            @endif
                                        </p>
                                    </div>
                                    {{-- <div class="col-12">
                                        <p>Mức lương:</p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end my-3 gx-3">
                            <div class="col-auto">
                                @php
                                    $previous_url = strtok(url()->previous(), '?');
                                    $back_url = route('users.index');

                                    if ($previous_url == $back_url) {
                                        session()->put('previous_url', url()->previous());
                                    }

                                    if ($back_url == strtok(session()->get('previous_url'), '?')) {
                                        $back_url = session()->get('previous_url');
                                    }
                                @endphp
                                <a href="{{ $back_url }}" class="btn btn-secondary" role="button">Quay lại</a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-primary" role="button">
                                    Cập nhật
                                </a>
                            </div>
                            <div class="col-auto">
                                {{-- Form delete --}}
                                <form action="{{ route('users.destroy', $user->user_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#confirm_modal_{{ $user->user_id }}">
                                        Xóa
                                    </button>
                                    <!-- Modal Confirm -->
                                    <div class="modal fade" id="confirm_modal_{{ $user->user_id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-confirm">
                                            <div class="modal-content">
                                                <div class="modal-header flex-column">
                                                    <div class="icon-box icon-box-danger">
                                                        <i class="fa-fw fa-regular fa-xmark"></i>
                                                    </div>
                                                    <h6 class="modal-title w-100 fw-bolder mt-4">Bạn có chắc
                                                        không?
                                                    </h6>
                                                </div>
                                                <div class="modal-body p-2">
                                                    <p>Bạn có thực sự muốn xóa thông tin này? Quá trình này
                                                        không thể được hoàn tác.</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-secondary me-3"
                                                        data-bs-dismiss="modal">Hủy bỏ</button>
                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- End form delete --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
