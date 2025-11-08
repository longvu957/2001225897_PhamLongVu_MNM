

<?php $__env->startSection('title', 'Danh sách bài viết'); ?>

<?php $__env->startSection('content'); ?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Danh sách bài viết</h1>
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('articles.create')); ?>" class="btn">Viết bài mới</a>
        <?php endif; ?>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="article-card">
            <h3>
                <a href="<?php echo e(route('articles.show', $article)); ?>" style="color: #111827; text-decoration: none;">
                    <?php echo e($article->title); ?>

                </a>
            </h3>
            <p style="color: #6b7280; margin: 10px 0;">
                <?php echo e(Str::limit($article->body, 150)); ?>

            </p>
            <?php if($article->image_path): ?>
                <img src="<?php echo e(asset('storage/' . $article->image_path)); ?>" alt="Ảnh minh hoạ">
            <?php endif; ?>
            <div class="article-meta">
                Tác giả: <?php echo e($article->user->name); ?> | 
                Ngày tạo: <?php echo e($article->created_at->format('d/m/Y H:i')); ?>

            </div>
            <div class="actions">
                <a href="<?php echo e(route('articles.show', $article)); ?>" class="btn">Xem chi tiết</a>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $article)): ?>
                    <a href="<?php echo e(route('articles.edit', $article)); ?>" class="btn">Sửa</a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $article)): ?>
                    <form action="<?php echo e(route('articles.destroy', $article)); ?>" method="post" style="display:inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa bài viết này?')">Xóa</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="article-card">
            <p>Chưa có bài viết nào.</p>
        </div>
    <?php endif; ?>

    <div style="margin-top: 20px;">
        <?php echo e($articles->links()); ?>

    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ADMIN\Downloads\php\resources\views/articles/index.blade.php ENDPATH**/ ?>