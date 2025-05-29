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
        Schema::create('book_authors', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->timestamps();
            $table->foreignUlid('book_id')->constrained('books')->cascadeOnDelete();
            $table->foreignUlid('author_id')->constrained('authors')->cascadeOnDelete();
           

            // Composite unique index untuk mencegah duplikasi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_authors');
    }
};