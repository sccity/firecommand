<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('unit_positions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('column_id');
            $table->timestamp('last_moved_at')->nullable();
            $table->unsignedBigInteger('call_id');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('column_id')->references('id')->on('assignment_columns')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('unit_positions');
    }
};
