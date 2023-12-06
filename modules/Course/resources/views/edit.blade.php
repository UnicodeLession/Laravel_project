@extends('layouts.backend')
@section('content')
    <div>
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center">
                {{session('msg')}}
            </div>
        @endif
    </div>
    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên khóa học</label>
                    <input id="title" name="name" type="text" class="form-control
                    @error('name') is-invalid @enderror"
                           value="{{ old('name') ?? $course->name }}" autofocus placeholder="Tiêu Đề...">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <label for="">Đường Dẫn Tĩnh</label>
                <div class="mb-3 input-group">
                    <input id="slug" type="text" name="slug"
                           class="form-control slug {{ $errors->has('slug') ? 'is-invalid' : '' }}" placeholder="Slug..."
                           value="{{ old('slug') ?? $course->slug }}">
                    <button style="border-left: 0; border-radius: 0 10px 10px 0; border-color: #BAC8F3;"
                            id="btn-slug" class="btn btn-outline-secondary" type="button"
                            title="Lấy slug theo title"
                    >Title</button>
                    @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giảng viên</label>
                    <select name="teacher_id" id=""
                            class="form-control form-select {{ $errors->has('teacher_id') ? 'is-invalid' : '' }}">
                        <option value="0">Chọn giảng viên</option>
                        <option value="1">Nguyễn Minh Hiếu</option>
                    </select>
                    @error('teacher_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mã khóa học</label>
                    <input type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                           placeholder="Mã khóa học..." id="" value="{{ old('code') ?? $course->code }}">
                    @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <label for="">Giá khóa học</label>
                <div class="mb-3 input-group">
                    <input type="number" name="price"
                           class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" placeholder="Giá khóa học..."
                           id="" value="{{ old('price') ?? $course->price}}">
                    <span class="input-group-text" style="border-left: 0; border-radius: 0 10px 10px 0; border-color: #BAC8F3;">.000 VND</span>
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <label for="">Giá khuyến mãi</label>
                <div class="mb-3 input-group">
                    <input type="number" name="sale_price"
                           class="form-control {{ $errors->has('sale_price') ? 'is-invalid' : '' }}"
                           placeholder="Giá khuyến mãi..." id="" value="{{ old('sale_price') ?? $course->sale_price }}">
                    <span class="input-group-text" style="border-left: 0; border-radius: 0 10px 10px 0; border-color: #BAC8F3;">.000 VND</span>
                    @error('sale_price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tài liệu đính kèm</label>
                    <select name="is_document" id=""
                            class="form-control form-select {{ $errors->has('is_document') ? 'is-invalid' : '' }}">
                        <option value="0" {{ old('is_document') == 0 || $course->is_document == 0 ? 'selected' : false }}>Không</option>
                        <option value="1" {{ old('is_document') == 1 || $course->is_document == 1 ? 'selected' : false }}>Có</option>
                    </select>
                    @error('is_document')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Trạng thái</label>
                    <select name="status" id=""
                            class="form-control form-select {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <option value="0" {{ old('status') == 0 || $course->status == 0 ? 'selected' : false }}>Chưa ra mắt</option>
                        <option value="1" {{ old('status') == 1 || $course->status == 1 ? 'selected' : false }}>Đã ra mắt</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Danh Mục</label>
                    <div class="list-group list-categories {{ $errors->has('categories') ? 'is-invalid' : '' }}">
                        {{getCategoriesCheckboxes($categories, old('categories')??$categoryIds)}}
                    </div>
                    @error('categories')
                    <div class="invalid-feedback d-block">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Hỗ trợ</label>
                    <textarea name="supports" class="form-control {{ $errors->has('supports') ? 'is-invalid' : '' }}"
                              style="height: 170px;"
                              placeholder="Hỗ trợ...">{{ old('supports')  ?? $course->detail}}</textarea>
                    @error('supports')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Nội dung</label>
                    <textarea name="detail" class="form-control {{ $errors->has('detail') ? 'is-invalid' : '' }}"
                              placeholder="Nội dung...">{{ old('detail')  ?? $course->detail}}</textarea>
                    @error('detail')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Ảnh đại diện</label>
                    <div class="row align-items-end ">
                        <div class="col-7 input-group">
                            <input id="thumbnail" type="text" name="thumbnail"
                                   class="form-control {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}"
                                   placeholder="Ảnh đại diện..."  value="{{ old('thumbnail') ?? $course->thumbnail }}">
                            <button id="lfm" data-input="thumbnail" data-preview="holder"
                                    type="button" class="btn btn-primary ml-3">
                                Chọn ảnh
                            </button>
                            @error('thumbnail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{--                        https://mdbootstrap.com/docs/standard/extended/file-input-image/--}}
                        <div class="col-3">
                            <div id="holder">
                                @if (old('thumbnail') || $course->thumbnail)
                                    <img src="{{ old('thumbnail') ?? $course->thumbnail }}" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @csrf
        @method('PUT')
    </form>
@endsection
@section('stylesheets')
    <style>
        img {
            max-width: 100%;
            height: auto !important;
        }

        #holder img {
            width: 100% !important;
        }
        .list-categories{
            max-height: 170px;
            overflow: auto;
        }
    </style>
@endsection
