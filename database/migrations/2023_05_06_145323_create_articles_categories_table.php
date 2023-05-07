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
            $table->integer('id_article');
            $table->integer('id_category');
            $table->foreign('id_article')->references('id_article')->on('articles');
            $table->foreign('id_category')->references('id_category')->on('categories');
            $table->primary(['id_article','id_category']);
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
