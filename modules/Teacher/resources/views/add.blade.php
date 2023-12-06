@extends('layouts.backend')
@section('content')
    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên khóa học</label>
                    <input id="title" name="name" type="text" class="form-control
                    @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" autofocus placeholder="Tiêu Đề...">
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
                    <input id="slug" name="slug" type="text"
                           class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}"
                           autofocus placeholder="Đường dẫn tĩnh..."
                    >
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

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Số năm kinh nghiệm</label>
                    <input type="number" name="exp" class="form-control {{ $errors->has('exp') ? 'is-invalid' : '' }}"
                           placeholder="Số năm kinh nghiệm..." value="{{ old('exp') }}">
                    @error('exp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Mô tả</label>
                    <textarea name="description" class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}"
                              placeholder="Mô tả...">{{ old('description') }}</textarea>
                    @error('description')
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
                            <input id="image" type="text" name="image"
                                   class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                   placeholder="Ảnh đại diện..."  value="{{ old('image') }}">
                            <button id="lfm" data-input="image" data-preview="holder"
                                    type="button" class="btn btn-primary ml-3">
                                Chọn ảnh
                            </button>
                            @error('image')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        {{--                        https://mdbootstrap.com/docs/standard/extended/file-input-image/--}}
                        <div class="col-3">
                            <div id="holder">
                                @if (old('image'))
                                    <img src="{{ old('image') }}" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @csrf
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
    </style>
@endsection
