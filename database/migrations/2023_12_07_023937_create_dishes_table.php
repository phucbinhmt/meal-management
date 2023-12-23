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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id('dish_id');
            $table->string('dish_name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price');
            $table->tinyInteger('status');
            $table->timestamps();

            // FK
            $table->unsignedBigInteger('dish_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
};
