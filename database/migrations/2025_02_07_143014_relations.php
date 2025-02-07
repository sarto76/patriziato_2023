<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id(); //
            $table->unsignedBigInteger('patrizio1_id');
            $table->unsignedBigInteger('patrizio2_id');
            $table->enum('type', ['parent', 'spouse']);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('relations');
    }
};
