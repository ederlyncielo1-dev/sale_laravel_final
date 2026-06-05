<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            
            // Foreign Keys linking to Users and Subjects
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            
            // Quarterly Grade Columns (Nullable so they can be filled sequentially)
            $table->decimal('q1', 5, 2)->nullable();
            $table->decimal('q2', 5, 2)->nullable();
            $table->decimal('q3', 5, 2)->nullable();
            $table->decimal('q4', 5, 2)->nullable();
            
            $table->timestamps();

            // Guard rails: A student cannot have duplicate rows for the same subject
            $table->unique(['user_id', 'subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};