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
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id')->primary();
            $table->string('last_name');
            $table->string('first_name');
            $table->tinyInteger('gender');
            $table->date('birth_date');
            $table->string('phone');
            $table->string('email')->unique();
            $table->tinyInteger('status');
            $table->decimal('salary')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->timestamps();

            // FK
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('position_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
