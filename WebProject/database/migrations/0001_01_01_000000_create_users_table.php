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
        // Create the 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // User's name
            $table->string('email')->unique(); // Unique email address
            $table->string('password'); // User's password
            $table->tinyInteger('user_type')->default(1); // Default user type (1: searcher, 2: servicer)
            $table->string('profile_picture')->nullable(); // Optional profile picture field
            $table->rememberToken(); // "Remember me" token
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });

        // Create the 'password_reset_tokens' table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email');  // Email as foreign key
            $table->string('token');  // Password reset token
            $table->timestamp('created_at')->nullable();  // Token creation timestamp

            // Set the 'email' field as a foreign key referencing 'users' table
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });

        // Create the 'sessions' table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();  // Session ID as primary key
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Foreign key to 'users' table
            $table->string('ip_address', 45)->nullable(); // IP address (nullable)
            $table->text('user_agent')->nullable(); // User agent string (nullable)
            $table->longText('payload'); // Session payload
            $table->integer('last_activity')->index(); // Last activity timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the tables if they exist
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
