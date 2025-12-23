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
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('father_name', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('cnic', 20)->unique();
            $table->string('bar_license_number', 50)->unique();
            $table->binary('cnic_image')->nullable();
            $table->binary('fingerprint1')->nullable();
            $table->binary('fingerprint2')->nullable();
            $table->binary('fingerprint3')->nullable();
            $table->binary('fingerprint4')->nullable();
            $table->binary('face_data')->nullable();
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('password', 255);
            $table->foreignId('role_id')->nullable()->constrained();
            $table->boolean('is_verified_nadra')->default(false);
            $table->boolean('is_verified_hcb')->default(false);
            $table->enum('status', ['inactive', 'active', 'suspended'])->default('inactive');
            $table->boolean('dues_paid')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
