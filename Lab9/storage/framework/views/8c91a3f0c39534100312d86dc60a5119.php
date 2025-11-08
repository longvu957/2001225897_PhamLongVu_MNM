

<?php $__env->startSection('title', $article->title); ?>

<?php $__env->startSection('content'); ?>
    <div class="article-card" style="max-width: 900px; margin: 0 auto;">
        <h1 style="font-size: 2rem; margin-bottom: 15px;"><?php echo e($article->title); ?></h1>
        
        <div style="margin-bottom: 20px; color: #6b7280; font-size: 14px;">
            Tác giả: <?php echo e($article->user->name); ?> | 
            Ngày tạo: <?php echo e($article->created_at->format('d/m/Y H:i')); ?>

            <?php if($article->updated_at != $article->created_at): ?>
                | Cập nhật: <?php echo e($article->updated_at->format('d/m/Y H:i')); ?>

            <?php endif; ?>
        </div>

        <?php if($article->image_path): ?>
            <div style="margin-bottom: 20px;">
                <img src="<?php echo e(asset('storage/' . $article->image_path)); ?>" alt="Ảnh minh hoạ" style="max-width: 100%; height: auto; border-radius: 8px;">
            </div>
        <?php endif; ?>

        <div style="line-height: 1.8; color: #374151; white-space: pre-wrap; margin-bottom: 20px;">
            <?php echo e($article->body); ?>

        </div>

        <?php if($article->tags): ?>
            <div style="margin-bottom: 20px;">
                <strong>Tags:</strong> <?php echo e($article->tags); ?>

            </div>
        <?php endif; ?>

        <div class="actions" style="border-top: 1px solid #e5e7eb; padding-top: 20px;">
            <a href="<?php echo e(route('articles.index')); ?>" class="btn" style="background: #6b7280;">Quay lại</a>
            
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

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('update', $article)): ?>
                <div style="margin-top: 15px; padding: 12px; background-color: #dbeafe; border: 1px solid #3b82f6; border-radius: 6px;">
                    <p style="color: #1e40af; margin: 0;">Bạn không phải tác giả của bài viết này.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ADMIN\Downloads\php\resources\views/articles/show.blade.php ENDPATH**/ ?>