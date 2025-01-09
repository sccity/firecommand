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
        Schema::dropIfExists('fire_assignments');
        
        Schema::create('fire_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fire_id')->constrained('fires')->onDelete('cascade');
            $table->string('unit');
            $table->string('position');  // IC, Assignment 1, Assignment 2, etc.
            $table->timestamp('assignment_time');
            $table->timestamps();
            
            // Unique constraint to ensure a unit can only be in one position
            $table->unique(['fire_id', 'unit']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fire_assignments');
    }
};
