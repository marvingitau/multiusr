<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobAttributsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_attributs', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',[
                'language_level',
                'career_level',
                'functional_area',
                'industry',
                'experience',
                'skills',
                'type',
                'shift',
                'degree_level',
                'degree_types',
                'major_subject',
                'result_type',
                'marital_status',
                'ownership_types',
                'salary_periods',
                'number_of_employee',
                'currency',
                'language',
            ]);
            $table->string('name');
            $table->text('image')->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('job_attributs');
    }
}
