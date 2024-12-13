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
        // Create the 'services' table
        Schema::create('services', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Service name
            $table->longText('description'); // Detailed service description
            $table->string('category'); // Service category
            $table->decimal('price', 10, 2); // Price with two decimal places
            $table->string('contact'); // Service provider's contact
            $table->foreignId('user_id')->constrained(); // Foreign key to the 'users' table (creator of the service)
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'services' table if it exists
        Schema::dropIfExists('services');
    }
};
