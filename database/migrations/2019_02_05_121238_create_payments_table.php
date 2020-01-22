<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model_type');
            $table->unsignedInteger('model_id');
            $table->unsignedInteger('gateway_id');
            $table->float('amount',8,2)->default(0);
            $table->float('usd_amo',8,2)->default(0);
            $table->string('trx');
            $table->longText('note')->nullable();
            $table->longText('meta_data')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('try')->default(0);
            $table->float('btc_amo',8,2)->default(0);
            $table->float('btc_wallet',8,2)->default(0);
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
        Schema::dropIfExists('payments');
    }
}
