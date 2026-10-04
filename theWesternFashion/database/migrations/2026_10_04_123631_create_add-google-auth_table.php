<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // "Continue with Google"
            $table->string('google_id')->nullable()->unique()->after('email');

            // Google users have no password, so it must be allowed to be empty
            $table->string('password')->nullable()->change();

            // 6-digit email verification code (stored hashed)
            $table->string('verification_code')->nullable();
            $table->timestamp('verification_code_expires_at')->nullable();
            $table->unsignedTinyInteger('verification_attempts')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['google_id']);
            $table->dropColumn([
                'google_id',
                'verification_code',
                'verification_code_expires_at',
                'verification_attempts',
            ]);
            // (password stays nullable on purpose: some rows may already be empty)
        });
    }
};