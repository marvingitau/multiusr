<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('degree_level_id')->nullable();
            $table->unsignedInteger('major_subject_id')->nullable();
            $table->string('degree_title')->nullable();
            $table->string('institute')->nullable();
            $table->year('passing_year')->nullable();
            $table->string('result')->nullable();
            $table->unsignedInteger('result_type_id')->nullable();
            $table->text('other_qualifications')->nullable();  // cpa, cisco etc
            $table->longText('other_degreeAndCollege')->nullable();
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
        Schema::dropIfExists('cv_educations');
    }
}
