@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="article-card" style="max-width: 900px; margin: 0 auto;">
        <h1 style="font-size: 2rem; margin-bottom: 15px;">{{ $article->title }}</h1>
        
        <div style="margin-bottom: 20px; color: #6b7280; font-size: 14px;">
            Tác giả: {{ $article->user->name }} | 
            Ngày tạo: {{ $article->created_at->format('d/m/Y H:i') }}
            @if($article->updated_at != $article->created_at)
                | Cập nhật: {{ $article->updated_at->format('d/m/Y H:i') }}
            @endif
        </div>

        @if($article->image_path)
            <div style="margin-bottom: 20px;">
                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Ảnh minh hoạ" style="max-width: 100%; height: auto; border-radius: 8px;">
            </div>
        @endif

        <div style="line-height: 1.8; color: #374151; white-space: pre-wrap; margin-bottom: 20px;">
            {{ $article->body }}
        </div>

        @if($article->tags)
            <div style="margin-bottom: 20px;">
                <strong>Tags:</strong> {{ $article->tags }}
            </div>
        @endif

        <div class="actions" style="border-top: 1px solid #e5e7eb; padding-top: 20px;">
            <a href="{{ route('articles.index') }}" class="btn" style="background: #6b7280;">Quay lại</a>
            
            @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}" class="btn">Sửa</a>
            @endcan

            @can('delete', $article)
                <form action="{{ route('articles.destroy', $article) }}" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa bài viết này?')">Xóa</button>
                </form>
            @endcan

            @cannot('update', $article)
                <div style="margin-top: 15px; padding: 12px; background-color: #dbeafe; border: 1px solid #3b82f6; border-radius: 6px;">
                    <p style="color: #1e40af; margin: 0;">Bạn không phải tác giả của bài viết này.</p>
                </div>
            @endcannot
        </div>
    </div>
@endsection

