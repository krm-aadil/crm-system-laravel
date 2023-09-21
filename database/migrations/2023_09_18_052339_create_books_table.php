<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('ISBN')->unique();
            $table->decimal('price', 10, 2);
            $table->text('summary')->nullable();
            $table->string('CoverImage')->nullable();
            $table->date('publication_date');

            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('language_id');

            $table->timestamps();




            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
           $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

        /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
