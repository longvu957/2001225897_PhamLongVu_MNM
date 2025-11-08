@extends('layouts.app')

@section('title', 'Sửa bài viết')

@section('content')
    <h1>Sửa bài viết</h1>

    <form action="{{ route('articles.update', $article) }}" method="post" enctype="multipart/form-data" style="max-width: 800px; margin-top: 20px;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="title" value="{{ old('title', $article->title) }}" required>
            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nội dung</label>
            <textarea name="body" rows="6" required>{{ old('body', $article->body) }}</textarea>
            @error('body')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Ảnh minh hoạ (tuỳ chọn)</label>
            @if($article->image_path)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $article->image_path) }}" alt="Ảnh hiện tại" style="max-width: 300px; border-radius: 6px;">
                    <p style="font-size: 12px; color: #6b7280; margin-top: 5px;">Ảnh hiện tại</p>
                </div>
            @endif
            <input type="file" name="image" accept=".jpg,.jpeg,.png">
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tags (tuỳ chọn)</label>
            <input type="text" name="tags" value="{{ old('tags', $article->tags) }}" placeholder="Ví dụ: php, laravel, web">
            @error('tags')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Cập nhật</button>
            <a href="{{ route('articles.show', $article) }}" class="btn" style="background: #6b7280; margin-left: 10px;">Hủy</a>
        </div>
    </form>
@endsection

