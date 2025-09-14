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
        Schema::create('campus_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('location');
            $table->enum('category', ['academic', 'club', 'sports', 'job_fair', 'seminar', 'social', 'other']);
            $table->string('organizer'); // Club name, department, etc.
            $table->integer('max_attendees')->nullable();
            $table->boolean('requires_rsvp')->default(false);
            $table->string('contact_email')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campus_events');
    }
};
