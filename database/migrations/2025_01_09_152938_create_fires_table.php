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
        Schema::create('fires', function (Blueprint $table) {
            $table->id();
            $table->string('call_id')->unique();
            $table->string('incident_id');
            $table->string('agency');
            $table->string('nature');
            $table->string('zone');
            $table->string('responsible_unit');
            $table->string('address');
            $table->string('city');
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->string('type');
            $table->string('status');
            $table->string('status_time');
            $table->string('callnum');
            $table->timestamp('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fires');
    }
};
