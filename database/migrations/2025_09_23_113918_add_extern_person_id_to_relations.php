<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relations', function (Blueprint $table) {
            // Add extern_person_id column to relations table
            $table->unsignedBigInteger('extern_person_id')->nullable()->after('patrizio2_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relations', function (Blueprint $table) {
            // Remove extern_person_id column from relations table
            $table->dropColumn('extern_person_id');
        });
    }
};
