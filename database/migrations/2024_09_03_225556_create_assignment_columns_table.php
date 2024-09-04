<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_columns', function (Blueprint $table) {
            $table->id();
            $table->string('call_id')->unique();  // Ensure call_id is unique
            $table->json('columns');              // Store columns as JSON
            $table->timestamps();                 // Add created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_columns');
    }
}