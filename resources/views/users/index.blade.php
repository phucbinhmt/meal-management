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
        <div class="row gx-3 justify-content-center">
            <div class="col-10">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-header mt-3 border-0 pb-0">
                        <h5 class="card-title fw-semibold ms-2 mb-3">{{ $title }}</h5>
                        <div class="row px-2">
                            <div class="col-auto">
                                <a href="{{ route('users.create') }}" class="btn btn-primary" role="button">
                                    <i class="fa-regular fa-plus fa-fw"></i>
                                    Thêm</a>
                            </div>
                            <div class="col">
                                <form action="" method="GET" class="form-search">
                                    <div class="row g-2 justify-content-end">
                                        <div class="col-auto">
                                            <select class="form-select" name="position_id" id="position_id">
                                                <option value="">Chức vụ</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->position_id }}"
                                                        @if (request()->position_id == $position->position_id) selected @endif>
                                                        {{ $position->position_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <select class="form-select" name="status" id="status">
                                                <option value="">Trạng thái</option>
                                                <option value="{{ config('constants.ACTIVE_USER') }}"
                                                    @if (request()->status == config('constants.ACTIVE_USER')) selected @endif>
                                                    Hoạt động
                                                </option>
                                                <option value="{{ config('constants.SUSPEND_USER') }}"
                                                    @if (request()->status == config('constants.SUSPEND_USER')) selected @endif>
                                                    Tạm ngưng
                                                </option>
                                            </select>
                                        </div>
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
                        </div>
                    </div>
                    <div class="card-body mx-0 px-0 pb-1">
                        {{-- Start table --}}
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                @if ($users->isEmpty())
                                    <caption class="text-center fs-7">Không có dữ liệu để hiển thị</caption>
                                @endif
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="ps-3">#</th>
                                        <th scope="col" class="text-start ps-4">Mã nhân viên</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col" class="text-start ps-4">Họ và tên</th>
                                        <th scope="col">Chức vụ</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = $users->firstItem();
                                    @endphp
                                    @foreach ($users as $user)
                                        <tr class="text-center">
                                            <td scope="row" class="text-id ps-3">{{ $index }}</td>
                                            <td class="text-id text-start ps-4">{{ $user->user_id }}</td>
                                            <td><img src="{{ asset('images/users/' . ($user->image ?? 'user-placeholder.png')) }}"
                                                    class="avatar img-fluid rounded" alt="image">
                                            </td>
                                            <td class="text-start ps-4">{{ $user->last_name . ' ' . $user->first_name }}
                                            </td>
                                            <td>{{ $user->position->position_name }}</td>
                                            <td>
                                                @if ($user->status == config('constants.ACTIVE_USER'))
                                                    <span class="badge text-bg-success">Hoạt động</span>
                                                @else
                                                    <span class="badge text-bg-danger">Tạm ngưng</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('users.show', $user->user_id) }}" class="text-info"
                                                    role="button">
                                                    <i class="fa-solid fa-eye fa-fw"></i>
                                                </a>
                                                <a href="{{ route('users.edit', $user->user_id) }}" class="text-warning"
                                                    role="button">
                                                    <i class="fa-solid fa-pen-to-square fa-fw"></i>
                                                </a>
                                                {{-- Form delete --}}
                                                <form action="{{ route('users.destroy', $user->user_id) }}" method="POST"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="text-danger border-0 bg-transparent"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirm_modal_{{ $user->user_id }}">
                                                        <i class="fa-solid fa-trash fa-fw"></i>
                                                    </button>
                                                    <!-- Modal Confirm -->
                                                    <div class="modal fade" id="confirm_modal_{{ $user->user_id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-confirm">
                                                            <div class="modal-content">
                                                                <div class="modal-header flex-column">
                                                                    <div class="icon-box icon-box-danger">
                                                                        <i class="fa-fw fa-regular fa-xmark"></i>
                                                                    </div>
                                                                    <h6 class="modal-title w-100 fw-bolder mt-4">Bạn có
                                                                        chắc
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
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Xóa</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                {{-- End form delete --}}
                                            </td>
                                        </tr>
                                        @php
                                            $index++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end me-4">
                            {{ $users->appends(request()->query())->links('components.pagination') }}
                        </div>
                        {{-- End table --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
