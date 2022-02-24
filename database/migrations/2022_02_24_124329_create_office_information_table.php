<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->nullable()->constrained('offices');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
            $table->smallInteger('capacity')->nullable();
            $table->smallInteger('appropriate_number_0');
            $table->smallInteger('appropriate_number_1');
            $table->smallInteger('appropriate_number_2');
            $table->smallInteger('appropriate_number_3');
            $table->smallInteger('appropriate_number_4');
            $table->smallInteger('appropriate_number_5');
            $table->foreignId('business_type_id')->constrained('business_types');

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
        Schema::dropIfExists('office_information');
    }
}
