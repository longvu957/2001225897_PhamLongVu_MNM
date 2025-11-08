<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Xem danh sách bài viết
     */
    public function viewAny(User $user): bool
    {
        return true; // công khai
    }

    /**
     * Xem chi tiết bài viết
     */
    public function view(User $user, Article $article): bool
    {
        return true; // công khai
    }

    /**
     * Tạo bài viết: yêu cầu đăng nhập
     */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /**
     * Chỉ tác giả được sửa
     */
    public function update(User $user, Article $article): bool
    {
        return $article->user_id === $user->id;
    }

    /**
     * Chỉ tác giả được xóa
     */
    public function delete(User $user, Article $article): bool
    {
        return $article->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        return false;
    }
}

