<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Đăng ký alias middleware
        $middleware->alias([
            'admin' => CheckAdmin::class,
        ]);

        // Bài tập 08: Cấu hình CSRF ngoại lệ (chỉ demo, có rủi ro bảo mật)
        // Lưu ý: Chỉ nên dùng cho webhook hoặc API đặc biệt, không nên dùng cho routes thông thường
        // $middleware->validateCsrfTokens(except: [
        //     'webhook/*', // Ví dụ: webhook từ bên thứ 3
        // ]);

        // Cấu hình throttle cho API (nếu cần)
        // $middleware->throttleApi('60,1');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

