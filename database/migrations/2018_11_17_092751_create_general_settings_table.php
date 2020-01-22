<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('color')->nullable();
            $table->string('cur')->nullable()->comment('CURRENCY');
            $table->string('cur_sym')->nullable()->comment('CURRENCY SYMBOL');
            $table->boolean('reg')->default(1);
            $table->boolean('ev')->default(1)->comment('EMAIL VERIFIED');
            $table->boolean('mv')->default(1)->comment('SMS VERIFIED');
            $table->boolean('en')->default(1)->comment('EMAIL NOTIFICATION');
            $table->boolean('mn')->default(1)->comment('SMS NOTIFICATION');
            $table->string('sender_email')->nullable();
            $table->longText('email_message')->nullable();
            $table->longText('sms_api')->nullable();
            $table->longText('meta_key_word')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_author')->nullable();
            $table->timestamps();
        });
        $gs = new \App\Model\GeneralSetting();
        $gs->title = 'TSK';
        $gs->color = '37c071';
        $gs->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
