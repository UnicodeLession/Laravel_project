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
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tiêu Đề</label>
                    <input id="name" name="name" type="text" class="form-control
                    @error('name') is-invalid @enderror"
                           value="{{old('name') ?? $category->name }}" autofocus placeholder="Tiêu Đề...">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Đường Dẫn Tĩnh</label>
                    <input id="slug" name="slug" type="text"
                           class="form-control @error('slug') is-invalid @enderror" value=" {{old('slug') ?? $category->slug }}"
                           autofocus placeholder="Đường Dẫn Tĩnh...">
                    @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Catogory Cha</label>
                    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                        <option value="0">Chọn Nhóm</option>
                        <option value="1">Tiếng Anh</option>
                        <option value="2">Toán</option>
                    </select>
                    @error('parent_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{route('admin.categories.index')}}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    @method('PUT')
    </form>
@endsection
