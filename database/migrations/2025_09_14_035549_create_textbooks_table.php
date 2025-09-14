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
        Schema::create('textbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->nullable();
            $table->string('edition')->nullable();
            $table->text('description')->nullable();
            $table->string('condition'); // "New", "Like New", "Good", "Fair", "Poor"
            $table->decimal('price', 8, 2);
            $table->enum('listing_type', ['sale', 'exchange', 'rent']);
            $table->string('course_code')->nullable();
            $table->string('subject')->nullable();
            $table->json('images')->nullable(); // Store image paths as JSON array
            $table->string('location')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('textbooks');
    }
};
