@extends('layouts.app')

@section('title', 'Tạo bài viết mới')

@section('content')
    <h1>Tạo bài viết mới</h1>

    @if (session('success'))
        <div class="alert alert-success" style="background: #dfd; border: 1px solid #9c9; padding: 15px; margin: 20px 0; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data" style="max-width: 800px; margin-top: 20px;">
        @csrf

        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nội dung</label>
            <textarea name="body" rows="6" required>{{ old('body') }}</textarea>
            @error('body')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Ảnh minh hoạ (tuỳ chọn)</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png">
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tags (tuỳ chọn)</label>
            <input type="text" name="tags" value="{{ old('tags') }}" placeholder="Ví dụ: php, laravel, web">
            @error('tags')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Lưu</button>
            <a href="{{ route('articles.index') }}" class="btn" style="background: #6b7280; margin-left: 10px;">Hủy</a>
        </div>
    </form>
@endsection

