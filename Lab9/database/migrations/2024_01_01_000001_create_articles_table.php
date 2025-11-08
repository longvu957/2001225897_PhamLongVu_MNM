<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            // user_id sẽ được thêm sau khi bảng users được tạo (bởi Breeze)
            // Migration này chỉ tạo các cột cơ bản
            $table->string('title');
            $table->text('body');
            $table->string('image_path')->nullable();
            $table->string('tags')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

