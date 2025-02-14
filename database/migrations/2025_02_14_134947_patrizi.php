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
        Schema::create('patrizi', function (Blueprint $table) {
            $table->id();
            $table->integer('register_number');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birth');
            $table->boolean('living')->nullable();
            $table->date('death')->nullable();
            $table->date('patriziato_lost')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->integer('zip')->nullable();
            $table->string('picture')->nullable();
            $table->string('note')->nullable();
            $table->string('password')->nullable();
            $table->boolean('confirmed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
