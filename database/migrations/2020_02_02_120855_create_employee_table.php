<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_name');
            $table->string('dob')->nullable();
            $table->string('date_of_apptt')->nullable();
            $table->string('date_of_incr')->nullable();
            $table->string('pay_band_level')->nullable();
            $table->string('pay')->nullable();
            $table->string('grade_pay')->nullable();
            $table->string('total')->nullable();
            $table->string('da_17')->nullable();
            $table->string('ha')->nullable();
            $table->string('hra')->nullable();
            $table->string('cca')->nullable();
            $table->string('total_salary')->nullable();
            $table->string('basic_da')->nullable();
            $table->string('it')->nullable();
            $table->string('nps')->nullable();
            $table->string('co_operative_loan')->nullable();
            $table->string('lic')->nullable();
            $table->string('gr_ins')->nullable();
            $table->string('total_dedu')->nullable();
            $table->string('total_payment')->nullable();
            $table->string('nps_govt_share')->nullable();
            $table->enum('emp_status', ['working', 'retired', 'retired_working'])->default('working');
            $table->enum('status', ['0', '1'])->default('1');
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
        Schema::dropIfExists('employees');
    }
}
