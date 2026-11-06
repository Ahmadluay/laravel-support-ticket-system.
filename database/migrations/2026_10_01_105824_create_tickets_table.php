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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // رقم التذكرة (مثل TCK-2026-001)
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('category');
            $table->string('priority')->default('Medium');
            $table->string('subject');
            $table->text('description');
            $table->enum('status', ['New', 'In Progress', 'Resolved', 'Closed'])->default('New');
            $table->timestamp('created_at_n8n')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
