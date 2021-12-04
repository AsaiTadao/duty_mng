<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('attendance_id')->nullable();
            $table->unsignedInteger('class')->nullable();
            $table->unsignedTinyInteger('status')->nullable();
            $table->dateTime('application_datetime')->nullable();
            $table->dateTime('approval_datetime')->nullable();
            $table->string('reason', 200)->nullable();
            $table->dateTime('time_before_correction')->nullable();
            $table->dateTime('time_after_correction')->nullable();
            $table->foreignId('reason_id')->nullable();

            $table->foreignId('create_user_id')->nullable();
            $table->foreignId('update_user_id')->nullable();

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
        Schema::dropIfExists('applications');
    }
}