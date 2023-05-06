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
            $table->string('article_slug', 100);
            $table->string('category_slug', 9);
            $table->foreign('article_slug')->references('slug')->on('articles');
            $table->foreign('category_slug')->references('slug')->on('categories');
            $table->primary(['article_slug','category_slug']);
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
