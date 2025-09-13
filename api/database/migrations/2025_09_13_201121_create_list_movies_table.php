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
        Schema::create('list_movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_id')->constrained('movie_lists')->onDelete('cascade');
            $table->unsignedBigInteger('tmdb_id')->index();
            $table->timestamps();

            $table->unique(['list_id', 'tmdb_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_movies');
    }
};
