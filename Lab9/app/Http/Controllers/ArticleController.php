<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Policy check - chỉ cần đăng nhập là được tạo bài viết
        $this->authorize('create', Article::class);
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        \Log::info('Store method called', ['user_id' => auth()->id(), 'request_data' => $request->all()]);
        
        // Kiểm tra đăng nhập
        if (!auth()->check()) {
            \Log::warning('User not authenticated');
            return redirect()->route('login');
        }

        // Policy check
        try {
            $this->authorize('create', Article::class);
            \Log::info('Authorization passed');
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            \Log::error('Authorization failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Bạn không có quyền tạo bài viết.']);
        }
        
        try {
            \Log::info('Starting validation');
            $data = $request->validated();
            \Log::info('Validation passed', ['data' => $data]);

            // Xử lý ảnh (nếu có)
            if ($request->hasFile('image')) {
                // Lưu vào disk 'public' (đường dẫn: storage/app/public/articles/...)
                $path = $request->file('image')->store('articles', 'public');
                $data['image_path'] = $path; // lưu đường dẫn tương đối
            }

            // Gán user_id cho bài viết
            $data['user_id'] = auth()->id();

            Article::create($data);

            return redirect()->route('articles.index')
                ->with('success', 'Tạo bài viết thành công');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Error creating article: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->withErrors(['error' => 'Có lỗi xảy ra khi tạo bài viết: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load('user');
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Xoá ảnh cũ (nếu có)
            if (!empty($article->image_path) && Storage::disk('public')->exists($article->image_path)) {
                Storage::disk('public')->delete($article->image_path);
            }
            $data['image_path'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('articles.show', $article)
            ->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        
        // Xóa ảnh nếu có
        if (!empty($article->image_path) && Storage::disk('public')->exists($article->image_path)) {
            Storage::disk('public')->delete($article->image_path);
        }
        
        $article->delete();
        
        return redirect()->route('articles.index')
            ->with('success', 'Đã xóa bài viết');
    }
}

