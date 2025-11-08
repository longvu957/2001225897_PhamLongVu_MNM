# Huong dan cai dat va chay du an Laravel Lab 9

## Buoc 1: Cai dat Composer dependencies

```bash
composer install
```

## Buoc 2: Tao file .env

1. Sao chep file env.example thanh .env:
   - Windows PowerShell: Copy-Item env.example .env
   - Windows CMD: copy env.example .env
   - Linux/Mac: cp env.example .env

2. Tao application key:
```bash
php artisan key:generate
```

3. Cap nhat thong tin database trong file .env:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_lab9
DB_USERNAME=root
DB_PASSWORD=
```

Luu y: Neu dung XAMPP, DB_PASSWORD de trong neu khong co password.

## Buoc 3: Khoi dong MySQL

Neu dung XAMPP:
1. Mo XAMPP Control Panel
2. Click Start ben canh MySQL
3. Doi cho den khi MySQL hien thi mau xanh (dang chay)

## Buoc 4: Tao database

Co 2 cach:

Cach 1: Dung phpMyAdmin (De nhat)
1. Trong XAMPP Control Panel, click Admin ben canh MySQL
2. Hoac mo trinh duyet va vao: http://localhost/phpmyadmin
3. Click "New" hoac "Databases" o menu ben trai
4. Nhap ten database: laravel_lab9
5. Chon Collation: utf8mb4_unicode_ci
6. Click "Create"

Cach 2: Dung MySQL Command Line
1. Mo Command Prompt hoac Terminal
2. Chay: mysql -u root -p
3. Nhap password (neu co, neu khong thi Enter)
4. Chay: CREATE DATABASE laravel_lab9;
5. Chay: exit;

## Buoc 5: Cai dat Laravel Breeze (Bat buoc)

QUAN TRONG: Phai cai Breeze TRUOC khi chay migrations vi Breeze se tao bang users can cho foreign key.

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
```

Luu y: Neu gap loi voi npm, co the can cai dat Node.js truoc.

## Buoc 6: Chay migrations va seeders

```bash
php artisan migrate
php artisan db:seed
```

Sau khi chay seeder, ban se co 2 tai khoan:
- User thuong: demo@huit.edu.vn / password123
- Admin: admin@huit.edu.vn / password123

## Buoc 7: Tao symbolic link cho storage (De hien thi anh)

```bash
php artisan storage:link
```

## Buoc 8: Chay server

```bash
php artisan serve
```

Truy cap ung dung tai: http://localhost:8000

## Thu tu dung de setup du an

1. composer install - Cai dependencies PHP
2. Tao file .env va php artisan key:generate
3. Cau hinh database trong .env
4. Tao database trong MySQL
5. php artisan breeze:install blade - Cai Breeze (QUAN TRONG)
6. npm install - Cai dependencies Node
7. npm run build - Build assets
8. php artisan migrate - Chay migrations
9. php artisan db:seed - Chay seeders
10. php artisan storage:link - Tao storage link
11. php artisan serve - Chay server

## Kiem tra cac tinh nang

### 1. Dang nhap
- Truy cap /login
- Dang nhap voi demo@huit.edu.vn / password123

### 2. Tao bai viet
- Sau khi dang nhap, click "Viet bai"
- Thu nhap tieu de co tu cam (test, spam, xxx) -> se bao loi
- Upload anh -> kiem tra validation
- Tao bai viet thanh cong

### 3. Kiem tra quyen
- Dang xuat va dang nhap bang tai khoan khac
- Thu sua/xoa bai viet cua nguoi khac -> se bi tu choi (403)

### 4. Kiem tra Admin
- Dang nhap voi admin@huit.edu.vn / password123
- Se thay nut "Quan tri" trong menu
- Truy cap /admin/articles -> thanh cong
- Dang nhap voi user thuong -> truy cap /admin/articles -> bi tu choi (403)

### 5. Kiem tra Throttle
- Goi lien tiep endpoint /public-info nhieu lan (hon 60 lan/phut) -> se bi gioi han

## Cau truc bai tap da hoan thanh

Bai tap 01: Form Request Validation
- File: app/Http/Requests/StoreArticleRequest.php
- File: app/Http/Requests/UpdateArticleRequest.php

Bai tap 02: Custom Rule & File Validation
- File: app/Rules/NoForbiddenWords.php
- Validation file upload trong Form Request

Bai tap 03: Middleware & Throttle
- File: app/Http/Middleware/CheckAdmin.php
- Cau hinh trong bootstrap/app.php
- Throttle trong routes/web.php

Bai tap 04: Authentication (Breeze)
- Cai dat Breeze
- Bao ve routes voi auth middleware
- Navigation menu dong

Bai tap 05: Authorization voi Policy
- File: app/Policies/ArticlePolicy.php
- Rang buoc quyen o Controller, Route, View

Bai tap 09: Gate tong quat
- Gate admin trong AppServiceProvider
- Su dung @can('admin') trong Blade

## Xu ly loi thuong gap

### Loi: Class not found
```bash
composer dump-autoload
```

### Loi: Storage link khong hoat dong
```bash
php artisan storage:link
```

### Loi: Route login khong tim thay
- Dam bao da cai Breeze: php artisan breeze:install blade

### Loi: 419 CSRF Token Mismatch
- Dam bao form co @csrf
- Kiem tra session driver trong .env

### Loi: 403 Forbidden khi truy cap admin
- Kiem tra user co is_admin = true trong database
- Chay lai seeder: php artisan db:seed

### Loi: SQLSTATE[HY000] [2002] No connection could be made
- Kiem tra MySQL da khoi dong chua (XAMPP Control Panel)
- Kiem tra DB_HOST, DB_PORT trong .env
- Kiem tra database da tao chua

### Loi: Vite manifest not found
- Chay: npm install
- Chay: npm run build

## Tai lieu tham khao

- Laravel 12 Documentation: https://laravel.com/docs/12.x
- Laravel Breeze: https://laravel.com/docs/breeze
- File PDF: 09_LTMNM_Chuong4_Lab9.v1.1.pdf

