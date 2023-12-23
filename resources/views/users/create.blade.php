@extends('layouts.authenticated')

@section('title')
    {{ $title }}
@endsection

@section('scripts')
    <script>
        const btnAvatar = document.querySelector("#image_upload");
        const imagePreview = document.querySelector(".image-preview");
        btnAvatar.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection

@section('content')
    <div class="container px-5">
        <div class="row gx-4 px-5">
            <div class="col-12 px-5">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-header ms-2 mt-3 mb-2 ps-4 border-0 pb-0 d-flex">
                        <h5 class="card-title fw-bolder me-4">{{ $title }}</h5>
                    </div>
                    <div class="card-body mx-3">
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="user_id" class="form-label">Mã nhân viên</label>
                                                <input type="text" name="user_id" id="user_id"
                                                    class="form-control @error('user_id') is-invalid @enderror"
                                                    placeholder="Nhập mã nhân viên" value="{{ old('user_id') }}">
                                                @error('user_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="last_name" class="form-label">Họ nhân viên</label>
                                                <input type="text" name="last_name" id="last_name"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    placeholder="Nhập họ nhân viên" value="{{ old('last_name') }}">
                                                @error('last_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="first_name" class="form-label">Tên nhân viên</label>
                                                <input type="text" name="first_name" id="first_name"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    placeholder="Nhập tên nhân viên" value="{{ old('first_name') }}">
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="gender" class="form-label">Giới tính</label>
                                                <select class="form-select @error('gender') is-invalid @enderror"
                                                    name="gender" id="gender">
                                                    <option value="" selected disabled>Chọn giới tính</option>
                                                    <option value="{{ config('constants.MALE_GENDER') }}"
                                                        @if (old('gender') == config('constants.MALE_GENDER')) selected @endif>
                                                        Nam
                                                    </option>
                                                    <option value="{{ config('constants.FEMALE_GENDER') }}"
                                                        @if (old('gender') == config('constants.FEMALE_GENDER')) selected @endif>
                                                        Nữ
                                                    </option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="birth_date" class="form-label">Ngày sinh</label>
                                                <input type="date" name="birth_date" id="birth_date"
                                                    class="form-control @error('birth_date') is-invalid @enderror"
                                                    value="{{ old('birth_date') }}">
                                                @error('birth_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="phone" class="form-label">Số điện thoại</label>
                                                <input type="text" name="phone" id="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" name="email" id="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Nhập địa chỉ email" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="address_id" class="form-label">Địa chỉ</label>
                                                <select class="form-select @error('address_id') is-invalid @enderror"
                                                    name="address_id" id="address_id">
                                                    <option value="" selected disabled>Chọn địa chỉ</option>
                                                    @foreach ($addresses as $address)
                                                        <option value="{{ $address->address_id }}"
                                                            @if (old('address_id') == $address->address_id) selected @endif>
                                                            {{ $address->province_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('address_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="position_id" class="form-label">Chức vụ</label>
                                                <select class="form-select @error('position_id') is-invalid @enderror"
                                                    name="position_id" id="position_id">
                                                    <option value="" disabled>Chọn chức vụ</option>
                                                    @foreach ($positions as $position)
                                                        <option value="{{ $position->position_id }}"
                                                            @if (old('position_id') == $position->position_id) selected @endif>
                                                            {{ $position->position_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('position_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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
                                            <a href="{{ $back_url }}" class="btn btn-secondary" role="button">
                                                Hủy bỏ
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 ps-4">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <label for="" class="form-label">Ảnh đại diện</label>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <img src="{{ asset('images/users/user-placeholder.png') }}"
                                                class="image-preview img-fluid img-thumbnail @error('image_upload') border-danger @enderror"
                                                alt="image">
                                        </div>
                                        @error('image_upload')
                                            <div class="invalid-feedback d-block text-center">{{ $message }}</div>
                                        @enderror
                                        <div class="col-12 d-flex justify-content-center">
                                            <label for="image_upload" class="btn btn-primary mt-3 py-2">Upload</label>
                                            <input type="file" name="image_upload" id="image_upload" class="d-none"
                                                placeholder="" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
