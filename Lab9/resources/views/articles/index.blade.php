@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Danh sách bài viết</h1>
        @auth
            <a href="{{ route('articles.create') }}" class="btn">Viết bài mới</a>
        @endauth
    </div>

    @forelse($articles as $article)
        <div class="article-card">
            <h3>
                <a href="{{ route('articles.show', $article) }}" style="color: #111827; text-decoration: none;">
                    {{ $article->title }}
                </a>
            </h3>
            <p style="color: #6b7280; margin: 10px 0;">
                {{ Str::limit($article->body, 150) }}
            </p>
            @if($article->image_path)
                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Ảnh minh hoạ">
            @endif
            <div class="article-meta">
                Tác giả: {{ $article->user->name }} | 
                Ngày tạo: {{ $article->created_at->format('d/m/Y H:i') }}
            </div>
            <div class="actions">
                <a href="{{ route('articles.show', $article) }}" class="btn">Xem chi tiết</a>
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
            </div>
        </div>
    @empty
        <div class="article-card">
            <p>Chưa có bài viết nào.</p>
        </div>
    @endforelse

    <div style="margin-top: 20px;">
        {{ $articles->links() }}
    </div>
@endsection

