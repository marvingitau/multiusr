<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('company_name')->nullable();
            $table->unsignedInteger('industry_id')->nullable()->default(NULL);
            $table->unsignedInteger('ownership_type_id')->nullable()->default(NULL);
            $table->unsignedInteger('number_of_employee_id')->nullable()->default(NULL);
            $table->longText('description')->nullable();
            $table->integer('number_of_office')->nullable();
            $table->string('web')->nullable();
            $table->year('establish_year')->nullable();
            $table->string('fax')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('country_id')->nullable()->default(NULL);
            $table->unsignedInteger('state_id')->nullable()->default(NULL);
            $table->unsignedInteger('city_id')->nullable()->default(NULL);
            $table->text('address')->nullable();
            $table->string('company_logo')->nullable();
            $table->longText('social_address')->nullable();
            $table->longText('map_script')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('subscribe')->default(1);
            $table->timestamp('membership_expired')->nullable();
            $table->integer('remaining_job')->default(0);
            $table->boolean('email_verified')->default(0);
            $table->string('email_verified_code')->nullable();
            $table->boolean('sms_verified')->default(0);
            $table->string('sms_verified_code')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
        $emp = new \App\Model\Employer();
        $emp->username = 'employee';
        $emp->password = bcrypt('employee');
        $emp->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
}
