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
        Schema::create('articles_categories', function (Blueprint $table) {
            $table->integer('article_id');
            $table->foreign('article_id')->references('article_id')->on('articles');
            $table->integer('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->primary(['article_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles_categories');
    }
};
