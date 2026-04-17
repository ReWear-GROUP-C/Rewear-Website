<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 255);
            $table->text('description');
            $table->string('size', 45);
            $table->enum('condition', ['new_with_tags', 'like_new', 'good', 'fair']);
            $table->decimal('price', 12, 2);
            $table->json('photo_path')->nullable();
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
