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
            $table->boolean('living');
            $table->date('death');
            $table->date('patriziato_lost');
            $table->string('phone');
            $table->string('email');
            $table->string('street');
            $table->string('city');
            $table->integer('zip');
            $table->string('picture');
            $table->string('note');
            $table->string('password');
            $table->boolean('confirmed');
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
