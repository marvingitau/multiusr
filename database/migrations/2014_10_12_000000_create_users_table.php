<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->longText('address')->nullable();
            $table->enum('sex',['M','F','O'])->default('M');
            $table->string('picture')->nullable();
            $table->string('password')->nullable();
            $table->softDeletes();
            $table->tinyInteger("marital_status_id")->nullable();
            $table->tinyInteger("country_id")->nullable(); 
            $table->tinyInteger("state_id")->nullable(); 
            $table->tinyInteger("city_id")->nullable();
            $table->string("nid_no")->nullable(); 
            $table->tinyInteger("experience_id")->nullable(); 
            $table->tinyInteger("career_level_id")->nullable();
            $table->tinyInteger("industry_id")->nullable(); 
            $table->tinyInteger("functional_area_id")->nullable(); 
            $table->float("current_salary")->default('0'); 
            $table->float("expected_salary")->default('0'); 
            $table->tinyInteger("currency_id")->nullable(); 
            $table->string("father_name")->nullable(); 
            $table->string("mother_name")->nullable();
            $table->text("permanent_address")->nullable();
            $table->string("nationality")->nullable();
            $table->text("cv_summary")->nullable();
            $table->string("vsent")->nullable();
            $table->boolean('email_verified')->default(0);
            $table->boolean('email_send')->default(0);
            $table->boolean('email_verified_code')->default(0);
            $table->boolean('sms_verified')->default(0);
            $table->boolean('sms_verified_code')->default(0);
            $table->boolean('sms_send')->default(0);
            $table->boolean('status')->default(1);
            $table->text('current_employer')->nullable(); //elis
            $table->text('current_role')->nullable();  //elis
            $table->tinyInteger('info_acknowledgement')->default(0);  //elis
            $table->string('alt_phone')->nullable();  //elis

            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
