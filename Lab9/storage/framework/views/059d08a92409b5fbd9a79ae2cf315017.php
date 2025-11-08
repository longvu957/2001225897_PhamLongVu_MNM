

<?php $__env->startSection('title', 'Tạo bài viết mới'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Tạo bài viết mới</h1>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger" style="background: #fee; border: 1px solid #fcc; padding: 15px; margin: 20px 0; border-radius: 5px;">
            <strong>Lỗi:</strong>
            <ul style="margin: 10px 0 0 20px;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success" style="background: #dfd; border: 1px solid #9c9; padding: 15px; margin: 20px 0; border-radius: 5px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('articles.store')); ?>" method="post" enctype="multipart/form-data" style="max-width: 800px; margin-top: 20px;">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="title" value="<?php echo e(old('title')); ?>" required>
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Nội dung</label>
            <textarea name="body" rows="6" required><?php echo e(old('body')); ?></textarea>
            <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Ảnh minh hoạ (tuỳ chọn)</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png">
            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Tags (tuỳ chọn)</label>
            <input type="text" name="tags" value="<?php echo e(old('tags')); ?>" placeholder="Ví dụ: php, laravel, web">
            <?php $__errorArgs = ['tags'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Lưu</button>
            <a href="<?php echo e(route('articles.index')); ?>" class="btn" style="background: #6b7280; margin-left: 10px;">Hủy</a>
        </div>
    </form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ADMIN\Downloads\php\resources\views/articles/create.blade.php ENDPATH**/ ?>