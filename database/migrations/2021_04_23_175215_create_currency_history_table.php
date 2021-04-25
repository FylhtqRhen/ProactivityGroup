<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_history', function (Blueprint $table) {
            $table->id();
            $table->string('currency_id');
            $table->date('date');
            $table->float('rate');
            $table->timestamps();
        });

        Schema::table('currency_history', function (Blueprint $table) {
            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('currency_history', function (Blueprint $table) {
            $table->dropForeign('currency_history_currency_id_foreign');
        });
        Schema::dropIfExists('currency_history');

    }
}
