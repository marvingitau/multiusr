<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employer_id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->unsignedInteger('country_id')->nullable()->default(NULL);
            $table->unsignedInteger('state_id')->nullable()->default(NULL);
            $table->unsignedInteger('city_id')->nullable()->default(NULL);
            $table->float('salary_from')->default(0);
            $table->float('salary_to')->default(0);
            $table->unsignedInteger('currency_id')->nullable()->default(NULL);
            $table->unsignedInteger('salary_period_id')->nullable()->default(NULL);
            $table->unsignedInteger('career_level_id')->nullable()->default(NULL);
            $table->unsignedInteger('functional_area_id')->nullable()->default(NULL);
            $table->unsignedInteger('job_type_id')->nullable()->default(NULL);
            $table->unsignedInteger('job_shift_id')->nullable()->default(NULL);
            $table->unsignedInteger('degree_level_id')->nullable()->default(NULL);
            $table->unsignedInteger('experience_id')->nullable()->default(NULL);
            $table->enum('preference',['M','F'])->nullable();
            $table->integer('number_of_position')->default(0);
            $table->date('expired_date')->nullable();
            $table->boolean('salary_hide')->default(1);
            $table->boolean('status')->default(1);
            $table->mediumText('skills')->nullable();
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
        Schema::dropIfExists('post_jobs');
    }
}
