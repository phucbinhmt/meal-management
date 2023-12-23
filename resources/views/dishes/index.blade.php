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
                                <a href="{{ route('dishes.create') }}" class="btn btn-primary" role="button">Thêm mới</a>
                            </div>
                            <div class="col">
                                <form action="" method="GET" class="form-search">
                                    <div class="row g-3 justify-content-end">
                                        <div class="col-auto">
                                            <select class="form-select" name="dish_type_id" id="dish_type_id">
                                                <option value="">Loại món ăn</option>
                                                @foreach ($dish_types as $dish_type)
                                                    <option value="{{ $dish_type->dish_type_id }}"
                                                        @if (request()->dish_type_id == $dish_type->dish_type_id) selected @endif>
                                                        {{ $dish_type->dish_type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <select class="form-select" name="status" id="status">
                                                <option value="">Trạng thái</option>
                                                <option value="{{ config('constants.ACTIVE_DISH') }}"
                                                    @if (request()->status == config('constants.ACTIVE_DISH')) selected @endif>
                                                    Hoạt động
                                                </option>
                                                <option value="{{ config('constants.PENDING_DISH') }}"
                                                    @if (request()->status == config('constants.PENDING_DISH')) selected @endif>
                                                    Chờ phê duyệt
                                                </option>
                                                <option value="{{ config('constants.SUSPEND_DISH') }}"
                                                    @if (request()->status == config('constants.SUSPEND_DISH')) selected @endif>
                                                    Tạm ngưng
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <div class="form-group search-box">
                                                <span class="fa fa-search search-icon"></span>
                                                <input type="search" name="keyword" class="form-control"
                                                    placeholder="Nhập từ khóa" value="{{ request()->keyword }}">
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
                                @if ($dishes->isEmpty())
                                    <caption class="text-center fs-7">Không có dữ liệu để hiển thị</caption>
                                @endif
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="ps-3">#</th>
                                        <th scope="col" class="text-start ps-4">Tên món ăn</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Loại món ăn</th>
                                        <th scope="col" class="text-start ps-4">Giá bán</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = $dishes->firstItem();
                                    @endphp
                                    @foreach ($dishes as $dish)
                                        <tr class="text-center">
                                            <td scope="row" class="text-id ps-3">{{ $index }}</td>
                                            <td class="text-start ps-4">{{ $dish->dish_name }}</td>
                                            <td><img src="{{ asset('images/dishes/' . ($dish->image ?? 'dish-placeholder.jpg')) }}"
                                                    class="avatar img-fluid rounded" alt="image">
                                            </td>
                                            <td>{{ $dish->dish_type->dish_type_name }}</td>
                                            <td class="text-start ps-4">{{ number_format($dish->price, 0, '.', ',') }}đ
                                            </td>
                                            <td>
                                                @if ($dish->status == config('constants.ACTIVE_DISH'))
                                                    <span class="badge text-bg-success">Hoạt động</span>
                                                @elseif ($dish->status == config('constants.PENDING_DISH'))
                                                    <span class="badge text-bg-info">Đang chờ</span>
                                                @else
                                                    <span class="badge text-bg-danger">Tạm ngưng</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('dishes.show', $dish->dish_id) }}" class="text-info"
                                                    role="button">
                                                    <i class="fa-solid fa-eye fa-fw"></i>
                                                </a>
                                                <a href="{{ route('dishes.edit', $dish->dish_id) }}" class="text-warning"
                                                    role="button">
                                                    <i class="fa-solid fa-pen fa-fw"></i>
                                                </a>
                                                {{-- Form delete --}}
                                                <form action="{{ route('dishes.destroy', $dish->dish_id) }}" method="POST"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="text-danger border-0 bg-transparent"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirm_modal_{{ $dish->dish_id }}">
                                                        <i class="fa-solid fa-trash fa-fw"></i>
                                                    </button>
                                                    <!-- Modal Confirm -->
                                                    <div class="modal fade" id="confirm_modal_{{ $dish->dish_id }}"
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
                            {{ $dishes->appends(request()->query())->links('components.pagination') }}
                        </div>
                        {{-- End table --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
