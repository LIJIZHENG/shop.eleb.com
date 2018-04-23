<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('menu_id');
            $table->string('menu_name');
            $table->float('rating',10,2);
            $table->decimal('menu_price');
            $table->string('description');
            $table->integer('month_sales');
            $table->integer('rating_count');
            $table->string('tips');
            $table->integer('satisfy_count');
            $table->integer('satisfy_rate');
            $table->string('menu_img');
            $table->integer('goodsnews_id');
            $table->integer('menuclass_id');
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
        Schema::dropIfExists('menus');
    }
}
