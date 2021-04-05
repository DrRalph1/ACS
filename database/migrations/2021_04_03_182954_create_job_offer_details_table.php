<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOfferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offer_details', function (Blueprint $table) {
            $table->increments('id')->startingValue(1);
            $table->float('basic_salary')->nullable();
            $table->float('allowances');
            $table->float('net_salary');
            $table->float('total_paye_tax')->nullable();
            $table->float('gross_salary')->nullable();
            $table->float('employee_pension_cont_amt')->nullable();
            $table->float('employee_pension_amt')->nullable();
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
        Schema::dropIfExists('job_offer_details');
    }
}
