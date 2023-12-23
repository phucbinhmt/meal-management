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
                        <form action="{{ route('dishes.update', $dish->dish_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-4">
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="dish_name" class="form-label">Tên món ăn</label>
                                                <input type="text" name="dish_name" id="dish_name"
                                                    class="form-control @error('dish_name') is-invalid @enderror"
                                                    placeholder="Nhập tên món ăn"
                                                    value="{{ old('dish_name', $dish->dish_name) }}">
                                                @error('dish_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="dish_type_id" class="form-label">Loại món ăn</label>
                                                <select class="form-select @error('dish_type_id') is-invalid @enderror"
                                                    name="dish_type_id" id="dish_type_id">
                                                    <option value="" selected disabled>Chọn loại món ăn</option>
                                                    @foreach ($dish_types as $dish_type)
                                                        <option value="{{ $dish_type->dish_type_id }}"
                                                            @if (old('dish_type_id', $dish->dish_type_id) == $dish_type->dish_type_id) selected @endif>
                                                            {{ $dish_type->dish_type_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('dish_type_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="price" class="form-label">Giá bán</label>
                                                <input type="text" name="price" id="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    placeholder="Nhập giá bán"
                                                    value="{{ old('price', number_format($dish->price, 0, '', '')) }}">
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="description" class="form-label">Mô tả</label>
                                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                    placeholder="Nhập mô tả" rows="5">{{ old('description', $dish->description) }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end my-3 gx-3">
                                        <div class="col-auto">
                                            @php
                                                $previous_url = strtok(url()->previous(), '?');
                                                $back_url = route('dishes.index');
                                                $show_url = route('dishes.show', $dish->dish_id);

                                                if ($previous_url == $back_url || $previous_url == $show_url) {
                                                    session()->put('previous_url', url()->previous());
                                                }

                                                if ($show_url == strtok(session()->get('previous_url'), '?')) {
                                                    $back_url = $show_url;
                                                } elseif ($back_url == strtok(session()->get('previous_url'), '?')) {
                                                    $back_url = session()->get('previous_url');
                                                }
                                            @endphp
                                            <a href="{{ $back_url }}" class="btn btn-secondary" role="button">
                                                Hủy bỏ
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 ps-4">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <label for="" class="form-label">Hình ảnh</label>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <img src="{{ asset('images/dishes/' . ($dish->image ?? 'dish-placeholder.jpg')) }}"
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
