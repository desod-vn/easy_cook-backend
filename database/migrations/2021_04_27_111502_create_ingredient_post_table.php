<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_post', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('ingredient_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->string('unit');
            $table->string('quantity');
            $table->boolean('main')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_post');
    }
}
