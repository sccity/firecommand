<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCallIdToUnitPositionsTable extends Migration
{
    public function up()
    {
        Schema::table('unit_positions', function (Blueprint $table) {
            $table->string('call_id')->after('unit_name'); // Add the column after 'unit_name'
        });
    }

    public function down()
    {
        Schema::table('unit_positions', function (Blueprint $table) {
            $table->dropColumn('call_id');
        });
    }
}