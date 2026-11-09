<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('magazines', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category_label');   // «معرفی کتاب»، «نقد و بررسی» ...
            $table->text('excerpt');
            $table->longText('body')->nullable();
            $table->string('image');
            $table->string('read_time');        // «۵ دقیقه مطالعه»
            $table->string('published_label');  // «۳ روز پیش»
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('magazines'); }
};