<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoodsaccountToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('goodsaccounts', function (Blueprint $table) {
            $table->string('logo');
            $table->smallInteger('is_by');
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
        Schema::table('goodsaccounts', function (Blueprint $table) {
            $table->dropColumn(['logo','is_by']);
        });
    }
}
