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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('bio')->nullable()->after('phone');
            $table->string('university')->nullable()->after('bio');
            $table->string('major')->nullable()->after('university');
            $table->string('year_of_study')->nullable()->after('major'); // Freshman, Sophomore, Junior, Senior, Graduate
            $table->string('graduation_year', 4)->nullable()->after('year_of_study');
            $table->string('location')->nullable()->after('graduation_year');
            $table->json('interests')->nullable()->after('location'); // Academic interests/subjects
            $table->json('social_links')->nullable()->after('interests'); // LinkedIn, GitHub, etc.
            $table->string('preferred_contact')->default('email')->after('social_links'); // email, phone, both
            $table->boolean('profile_visibility')->default(true)->after('preferred_contact'); // Public/private profile
            $table->timestamp('last_active_at')->nullable()->after('profile_visibility');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'bio',
                'university',
                'major',
                'year_of_study',
                'graduation_year',
                'location',
                'interests',
                'social_links',
                'preferred_contact',
                'profile_visibility',
                'last_active_at'
            ]);
        });
    }
};
