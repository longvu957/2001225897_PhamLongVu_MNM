# Laravel Lab 9 - Validation, Middleware, Authentication & Authorization

Dự án Laravel 12 hoàn chỉnh cho Lab 9 với tất cả các bài tập về Validation, Middleware, Authentication & Authorization.

## Yêu cầu hệ thống

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM (cho Laravel Breeze)

## Cài đặt

### 1. Cài đặt dependencies

```bash
composer install
```

### 2. Cấu hình môi trường

Sao chép file `.env.example` thành `.env` và cấu hình database:

```bash
cp .env.example .env
php artisan key:generate
```

Cập nhật thông tin database trong `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_lab9
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Chạy migrations và seeders

```bash
php artisan migrate
php artisan db:seed
```

Seeder sẽ tạo 2 tài khoản mẫu:
- **User thường**: `demo@huit.edu.vn` / `password123`
- **Admin**: `admin@huit.edu.vn` / `password123`

### 4. Cài đặt Laravel Breeze (Bài tập 04)

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
php artisan migrate
```

### 5. Tạo symbolic link cho storage

```bash
php artisan storage:link
```

## Cấu trúc dự án

### Bài tập đã hoàn thành

#### ✅ Bài tập 01: Form Request Validation
- `app/Http/Requests/StoreArticleRequest.php`
- `app/Http/Requests/UpdateArticleRequest.php`
- Validation rules, messages, và attributes đã được cấu hình

#### ✅ Bài tập 02: Custom Rule & File Validation
- `app/Rules/NoForbiddenWords.php` - Rule tùy chỉnh kiểm tra từ cấm
- File validation cho upload ảnh (jpg, jpeg, png, max 2MB)
- Xử lý upload và lưu ảnh trong Controller

#### ✅ Bài tập 03: Middleware & Throttle
- `app/Http/Middleware/CheckAdmin.php` - Middleware kiểm tra admin
- Đăng ký middleware trong `bootstrap/app.php` với alias `admin`
- Cấu hình throttle cho API và đăng nhập

#### ✅ Bài tập 04: Authentication (Breeze)
- Cài đặt Laravel Breeze với Blade
- Bảo vệ routes với middleware `auth`
- Navigation menu theo trạng thái người dùng (@auth/@guest)

#### ✅ Bài tập 05: Authorization với Policy
- `app/Policies/ArticlePolicy.php` - Policy cho Article
- Chỉ tác giả được sửa/xóa bài viết
- Ràng buộc quyền ở Controller, Route, và View

#### ✅ Bài tập 09: Gate tổng quát
- Gate `admin` được định nghĩa trong `AppServiceProvider`
- Sử dụng `@can('admin')` trong Blade

## Sử dụng

### Truy cập ứng dụng

Sau khi cài đặt, chạy server:

```bash
php artisan serve
```

Truy cập: `http://localhost:8000`

### Đăng nhập

- **User thường**: `demo@huit.edu.vn` / `password123`
- **Admin**: `admin@huit.edu.vn` / `password123`

### Các tính năng

1. **Xem danh sách bài viết** (công khai)
2. **Xem chi tiết bài viết** (công khai)
3. **Tạo bài viết** (yêu cầu đăng nhập)
4. **Sửa bài viết** (chỉ tác giả)
5. **Xóa bài viết** (chỉ tác giả)
6. **Khu vực admin** (`/admin/articles`) - chỉ admin mới truy cập được

### Validation

- Tiêu đề: required, string, max:255, unique, không chứa từ cấm
- Nội dung: required, string, min:10
- Ảnh: optional, image, mimes:jpg,jpeg,png, max:2048KB
- Tags: optional, nullable, string

### Custom Rule

Rule `NoForbiddenWords` kiểm tra các từ cấm: `test`, `spam`, `xxx`

### Middleware

- `auth`: Yêu cầu đăng nhập
- `admin`: Yêu cầu quyền admin (is_admin = true)
- `throttle:60,1`: Giới hạn 60 requests/phút
- `throttle:5,1`: Giới hạn 5 requests/phút (cho đăng nhập)

## Cấu trúc thư mục quan trọng

```
app/
├── Http/
│   ├── Controllers/
│   │   └── ArticleController.php
│   ├── Middleware/
│   │   └── CheckAdmin.php
│   └── Requests/
│       ├── StoreArticleRequest.php
│       └── UpdateArticleRequest.php
├── Models/
│   ├── Article.php
│   └── User.php
├── Policies/
│   └── ArticlePolicy.php
└── Rules/
    └── NoForbiddenWords.php

database/
├── migrations/
│   ├── 2024_01_01_000001_create_articles_table.php
│   ├── 2024_01_01_000002_add_image_path_to_articles_table.php
│   ├── 2024_01_01_000003_add_user_id_to_articles_table.php
│   └── 2024_01_01_000004_add_is_admin_to_users_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── DemoUserSeeder.php

resources/views/
├── layouts/
│   └── app.blade.php
├── partials/
│   └── nav.blade.php
└── articles/
    ├── index.blade.php
    ├── create.blade.php
    ├── edit.blade.php
    └── show.blade.php
```

## Lưu ý

1. **Breeze**: Cần cài đặt Laravel Breeze để có các route đăng nhập/đăng ký
2. **Storage Link**: Nhớ chạy `php artisan storage:link` để hiển thị ảnh
3. **Database**: Đảm bảo database đã được tạo và cấu hình đúng trong `.env`
4. **Admin**: Chỉ user có `is_admin = true` mới truy cập được `/admin/*`

## Bài tập bổ sung (đã hoàn thành)

- **✅ Bài tập 06**: Localization thông điệp lỗi - File `lang/vi/validation.php`
- **✅ Bài tập 07**: Xác minh email & đặt lại mật khẩu - Cấu hình trong Breeze
- **✅ Bài tập 08**: Middleware CSRF ngoại lệ - Cấu hình trong `bootstrap/app.php`
- **✅ Bài tập 10**: Kiểm thử nhanh với Feature Test - Files trong `tests/Feature/`

Xem chi tiết trong file `HUONG_DAN_BAI_TAP_BO_SUNG.md`

## Tác giả

Dự án được tạo theo yêu cầu của Lab 9 - Lập trình mã nguồn mở

