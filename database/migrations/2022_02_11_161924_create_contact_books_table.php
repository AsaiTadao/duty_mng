<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('child_id')->constrained('children');
            $table->string('weather')->nullable();
            $table->string('pick_up_person')->nullable();
            $table->time('pick_up_time')->nullable();
            $table->unsignedTinyInteger('mood')->nullable();
            $table->boolean('sleep_0100_home')->default(0);
            $table->boolean('sleep_0130_home')->default(0);
            $table->boolean('sleep_0200_home')->default(0);
            $table->boolean('sleep_0230_home')->default(0);
            $table->boolean('sleep_0300_home')->default(0);
            $table->boolean('sleep_0330_home')->default(0);
            $table->boolean('sleep_0400_home')->default(0);
            $table->boolean('sleep_0430_home')->default(0);
            $table->boolean('sleep_0500_home')->default(0);
            $table->boolean('sleep_0530_home')->default(0);
            $table->boolean('sleep_0600_home')->default(0);
            $table->boolean('sleep_0630_home')->default(0);
            $table->boolean('sleep_0700_home')->default(0);
            $table->boolean('sleep_0730_home')->default(0);
            $table->boolean('sleep_0800_home')->default(0);
            $table->boolean('sleep_0830_home')->default(0);
            $table->boolean('sleep_0900_home')->default(0);
            $table->boolean('sleep_0930_home')->default(0);
            $table->boolean('sleep_1000_home')->default(0);
            $table->boolean('sleep_1030_home')->default(0);
            $table->boolean('sleep_1100_home')->default(0);
            $table->boolean('sleep_1130_home')->default(0);
            $table->boolean('sleep_1200_home')->default(0);
            $table->boolean('sleep_1230_home')->default(0);
            $table->boolean('sleep_1300_home')->default(0);
            $table->boolean('sleep_1330_home')->default(0);
            $table->boolean('sleep_1400_home')->default(0);
            $table->boolean('sleep_1430_home')->default(0);
            $table->boolean('sleep_1500_home')->default(0);
            $table->boolean('sleep_1530_home')->default(0);
            $table->boolean('sleep_1600_home')->default(0);
            $table->boolean('sleep_1630_home')->default(0);
            $table->boolean('sleep_1700_home')->default(0);
            $table->boolean('sleep_1730_home')->default(0);
            $table->boolean('sleep_1800_home')->default(0);
            $table->boolean('sleep_1830_home')->default(0);
            $table->boolean('sleep_1900_home')->default(0);
            $table->boolean('sleep_1930_home')->default(0);
            $table->boolean('sleep_2000_home')->default(0);
            $table->boolean('sleep_2030_home')->default(0);
            $table->boolean('sleep_2100_home')->default(0);
            $table->boolean('sleep_2130_home')->default(0);
            $table->boolean('sleep_2200_home')->default(0);
            $table->boolean('sleep_2230_home')->default(0);
            $table->boolean('sleep_2300_home')->default(0);
            $table->boolean('sleep_2330_home')->default(0);
            $table->boolean('sleep_2400_home')->default(0);
            $table->boolean('sleep_2430_home')->default(0);
            $table->boolean('sleep_0100_school')->default(0);
            $table->boolean('sleep_0130_school')->default(0);
            $table->boolean('sleep_0200_school')->default(0);
            $table->boolean('sleep_0230_school')->default(0);
            $table->boolean('sleep_0300_school')->default(0);
            $table->boolean('sleep_0330_school')->default(0);
            $table->boolean('sleep_0400_school')->default(0);
            $table->boolean('sleep_0430_school')->default(0);
            $table->boolean('sleep_0500_school')->default(0);
            $table->boolean('sleep_0530_school')->default(0);
            $table->boolean('sleep_0600_school')->default(0);
            $table->boolean('sleep_0630_school')->default(0);
            $table->boolean('sleep_0700_school')->default(0);
            $table->boolean('sleep_0730_school')->default(0);
            $table->boolean('sleep_0800_school')->default(0);
            $table->boolean('sleep_0830_school')->default(0);
            $table->boolean('sleep_0900_school')->default(0);
            $table->boolean('sleep_0930_school')->default(0);
            $table->boolean('sleep_1000_school')->default(0);
            $table->boolean('sleep_1030_school')->default(0);
            $table->boolean('sleep_1100_school')->default(0);
            $table->boolean('sleep_1130_school')->default(0);
            $table->boolean('sleep_1200_school')->default(0);
            $table->boolean('sleep_1230_school')->default(0);
            $table->boolean('sleep_1300_school')->default(0);
            $table->boolean('sleep_1330_school')->default(0);
            $table->boolean('sleep_1400_school')->default(0);
            $table->boolean('sleep_1430_school')->default(0);
            $table->boolean('sleep_1500_school')->default(0);
            $table->boolean('sleep_1530_school')->default(0);
            $table->boolean('sleep_1600_school')->default(0);
            $table->boolean('sleep_1630_school')->default(0);
            $table->boolean('sleep_1700_school')->default(0);
            $table->boolean('sleep_1730_school')->default(0);
            $table->boolean('sleep_1800_school')->default(0);
            $table->boolean('sleep_1830_school')->default(0);
            $table->boolean('sleep_1900_school')->default(0);
            $table->boolean('sleep_1930_school')->default(0);
            $table->boolean('sleep_2000_school')->default(0);
            $table->boolean('sleep_2030_school')->default(0);
            $table->boolean('sleep_2100_school')->default(0);
            $table->boolean('sleep_2130_school')->default(0);
            $table->boolean('sleep_2200_school')->default(0);
            $table->boolean('sleep_2230_school')->default(0);
            $table->boolean('sleep_2300_school')->default(0);
            $table->boolean('sleep_2330_school')->default(0);
            $table->boolean('sleep_2400_school')->default(0);
            $table->boolean('sleep_2430_school')->default(0);
            $table->float('temperature_01_home', 3, 1)->nullable();
            $table->float('temperature_02_home', 3, 1)->nullable();
            $table->float('temperature_03_home', 3, 1)->nullable();
            $table->float('temperature_04_home', 3, 1)->nullable();
            $table->float('temperature_05_home', 3, 1)->nullable();
            $table->float('temperature_06_home', 3, 1)->nullable();
            $table->float('temperature_07_home', 3, 1)->nullable();
            $table->float('temperature_08_home', 3, 1)->nullable();
            $table->float('temperature_09_home', 3, 1)->nullable();
            $table->float('temperature_10_home', 3, 1)->nullable();
            $table->float('temperature_11_home', 3, 1)->nullable();
            $table->float('temperature_12_home', 3, 1)->nullable();
            $table->float('temperature_13_home', 3, 1)->nullable();
            $table->float('temperature_14_home', 3, 1)->nullable();
            $table->float('temperature_15_home', 3, 1)->nullable();
            $table->float('temperature_16_home', 3, 1)->nullable();
            $table->float('temperature_17_home', 3, 1)->nullable();
            $table->float('temperature_18_home', 3, 1)->nullable();
            $table->float('temperature_19_home', 3, 1)->nullable();
            $table->float('temperature_20_home', 3, 1)->nullable();
            $table->float('temperature_21_home', 3, 1)->nullable();
            $table->float('temperature_22_home', 3, 1)->nullable();
            $table->float('temperature_23_home', 3, 1)->nullable();
            $table->float('temperature_24_home', 3, 1)->nullable();
            $table->float('temperature_01_school', 3, 1)->nullable();
            $table->float('temperature_02_school', 3, 1)->nullable();
            $table->float('temperature_03_school', 3, 1)->nullable();
            $table->float('temperature_04_school', 3, 1)->nullable();
            $table->float('temperature_05_school', 3, 1)->nullable();
            $table->float('temperature_06_school', 3, 1)->nullable();
            $table->float('temperature_07_school', 3, 1)->nullable();
            $table->float('temperature_08_school', 3, 1)->nullable();
            $table->float('temperature_09_school', 3, 1)->nullable();
            $table->float('temperature_10_school', 3, 1)->nullable();
            $table->float('temperature_11_school', 3, 1)->nullable();
            $table->float('temperature_12_school', 3, 1)->nullable();
            $table->float('temperature_13_school', 3, 1)->nullable();
            $table->float('temperature_14_school', 3, 1)->nullable();
            $table->float('temperature_15_school', 3, 1)->nullable();
            $table->float('temperature_16_school', 3, 1)->nullable();
            $table->float('temperature_17_school', 3, 1)->nullable();
            $table->float('temperature_18_school', 3, 1)->nullable();
            $table->float('temperature_19_school', 3, 1)->nullable();
            $table->float('temperature_20_school', 3, 1)->nullable();
            $table->float('temperature_21_school', 3, 1)->nullable();
            $table->float('temperature_22_school', 3, 1)->nullable();
            $table->float('temperature_23_school', 3, 1)->nullable();
            $table->float('temperature_24_school', 3, 1)->nullable();
            $table->unsignedTinyInteger('defecation_1_home')->nullable();
            $table->unsignedTinyInteger('defecation_2_home')->nullable();
            $table->unsignedTinyInteger('defecation_3_home')->nullable();
            $table->unsignedTinyInteger('defecation_4_home')->nullable();
            $table->unsignedTinyInteger('defecation_5_home')->nullable();
            $table->unsignedTinyInteger('defecation_6_home')->nullable();
            $table->unsignedTinyInteger('defecation_7_home')->nullable();
            $table->unsignedTinyInteger('defecation_8_home')->nullable();
            $table->unsignedTinyInteger('defecation_9_home')->nullable();
            $table->unsignedTinyInteger('defecation_10_home')->nullable();
            $table->unsignedTinyInteger('defecation_11_home')->nullable();
            $table->unsignedTinyInteger('defecation_12_home')->nullable();
            $table->unsignedTinyInteger('defecation_13_home')->nullable();
            $table->unsignedTinyInteger('defecation_14_home')->nullable();
            $table->unsignedTinyInteger('defecation_15_home')->nullable();
            $table->unsignedTinyInteger('defecation_16_home')->nullable();
            $table->unsignedTinyInteger('defecation_17_home')->nullable();
            $table->unsignedTinyInteger('defecation_18_home')->nullable();
            $table->unsignedTinyInteger('defecation_19_home')->nullable();
            $table->unsignedTinyInteger('defecation_20_home')->nullable();
            $table->unsignedTinyInteger('defecation_21_home')->nullable();
            $table->unsignedTinyInteger('defecation_22_home')->nullable();
            $table->unsignedTinyInteger('defecation_23_home')->nullable();
            $table->unsignedTinyInteger('defecation_24_home')->nullable();
            $table->unsignedTinyInteger('defecation_1_school')->nullable();
            $table->unsignedTinyInteger('defecation_2_school')->nullable();
            $table->unsignedTinyInteger('defecation_3_school')->nullable();
            $table->unsignedTinyInteger('defecation_4_school')->nullable();
            $table->unsignedTinyInteger('defecation_5_school')->nullable();
            $table->unsignedTinyInteger('defecation_6_school')->nullable();
            $table->unsignedTinyInteger('defecation_7_school')->nullable();
            $table->unsignedTinyInteger('defecation_8_school')->nullable();
            $table->unsignedTinyInteger('defecation_9_school')->nullable();
            $table->unsignedTinyInteger('defecation_10_school')->nullable();
            $table->unsignedTinyInteger('defecation_11_school')->nullable();
            $table->unsignedTinyInteger('defecation_12_school')->nullable();
            $table->unsignedTinyInteger('defecation_13_school')->nullable();
            $table->unsignedTinyInteger('defecation_14_school')->nullable();
            $table->unsignedTinyInteger('defecation_15_school')->nullable();
            $table->unsignedTinyInteger('defecation_16_school')->nullable();
            $table->unsignedTinyInteger('defecation_17_school')->nullable();
            $table->unsignedTinyInteger('defecation_18_school')->nullable();
            $table->unsignedTinyInteger('defecation_19_school')->nullable();
            $table->unsignedTinyInteger('defecation_20_school')->nullable();
            $table->unsignedTinyInteger('defecation_21_school')->nullable();
            $table->unsignedTinyInteger('defecation_22_school')->nullable();
            $table->unsignedTinyInteger('defecation_23_school')->nullable();
            $table->unsignedTinyInteger('defecation_24_school')->nullable();
            $table->string('meal_1_home')->nullable();
            $table->string('meal_2_home')->nullable();
            $table->string('meal_3_home')->nullable();
            $table->string('meal_4_home')->nullable();
            $table->string('meal_5_home')->nullable();
            $table->string('meal_6_home')->nullable();
            $table->string('meal_7_home')->nullable();
            $table->string('meal_8_home')->nullable();
            $table->string('meal_9_home')->nullable();
            $table->string('meal_10_home')->nullable();
            $table->string('meal_11_home')->nullable();
            $table->string('meal_12_home')->nullable();
            $table->string('meal_13_home')->nullable();
            $table->string('meal_14_home')->nullable();
            $table->string('meal_15_home')->nullable();
            $table->string('meal_16_home')->nullable();
            $table->string('meal_17_home')->nullable();
            $table->string('meal_18_home')->nullable();
            $table->string('meal_19_home')->nullable();
            $table->string('meal_20_home')->nullable();
            $table->string('meal_21_home')->nullable();
            $table->string('meal_22_home')->nullable();
            $table->string('meal_23_home')->nullable();
            $table->string('meal_24_home')->nullable();
            $table->string('meal_1_school')->nullable();
            $table->string('meal_2_school')->nullable();
            $table->string('meal_3_school')->nullable();
            $table->string('meal_4_school')->nullable();
            $table->string('meal_5_school')->nullable();
            $table->string('meal_6_school')->nullable();
            $table->string('meal_7_school')->nullable();
            $table->string('meal_8_school')->nullable();
            $table->string('meal_9_school')->nullable();
            $table->string('meal_10_school')->nullable();
            $table->string('meal_11_school')->nullable();
            $table->string('meal_12_school')->nullable();
            $table->string('meal_13_school')->nullable();
            $table->string('meal_14_school')->nullable();
            $table->string('meal_15_school')->nullable();
            $table->string('meal_16_school')->nullable();
            $table->string('meal_17_school')->nullable();
            $table->string('meal_18_school')->nullable();
            $table->string('meal_19_school')->nullable();
            $table->string('meal_20_school')->nullable();
            $table->string('meal_21_school')->nullable();
            $table->string('meal_22_school')->nullable();
            $table->string('meal_23_school')->nullable();
            $table->string('meal_24_school')->nullable();
            $table->text('state_0_home')->nullable();
            $table->text('state_0_school')->nullable();
            $table->text('contact_0_home')->nullable();
            $table->text('contact_0_school')->nullable();
            $table->time('meal_time_1_home')->nullable();
            $table->time('meal_time_2_home')->nullable();
            $table->time('meal_time_3_home')->nullable();
            $table->time('meal_time_1_school')->nullable();
            $table->time('meal_time_2_school')->nullable();
            $table->time('meal_time_3_school')->nullable();
            $table->tinyInteger('meal_amount_1_home')->nullable();
            $table->tinyInteger('meal_amount_2_home')->nullable();
            $table->tinyInteger('meal_amount_3_home')->nullable();
            $table->tinyInteger('meal_amount_1_school')->nullable();
            $table->tinyInteger('meal_amount_2_school')->nullable();
            $table->tinyInteger('meal_amount_3_school')->nullable();
            $table->time('meal_memo_1_home')->nullable();
            $table->time('meal_memo_2_home')->nullable();
            $table->time('meal_memo_3_home')->nullable();
            $table->text('meal_memo_1_school')->nullable();
            $table->text('meal_memo_2_school')->nullable();
            $table->text('meal_memo_3_school')->nullable();
            $table->tinyInteger('mood_1_home')->nullable();
            $table->tinyInteger('mood_2_home')->nullable();
            $table->tinyInteger('mood_1_school')->nullable();
            $table->tinyInteger('mood_2_school')->nullable();
            $table->tinyInteger('defecation_count_1_home')->nullable();
            $table->tinyInteger('defecation_count_2_home')->nullable();
            $table->tinyInteger('defecation_count_1_school')->nullable();
            $table->tinyInteger('defecation_count_2_school')->nullable();
            $table->time('sleep_start_1_home')->nullable();
            $table->time('sleep_end_1_home')->nullable();
            $table->time('sleep_start_2_home')->nullable();
            $table->time('sleep_end_2_home')->nullable();
            $table->time('sleep_start_1_school')->nullable();
            $table->time('sleep_end_1_school')->nullable();
            $table->time('sleep_start_2_school')->nullable();
            $table->time('sleep_end_2_school')->nullable();
            $table->boolean('bathing_home')->nullable();
            $table->boolean('bathing_school')->nullable();
            $table->time('temperature_time_1_home')->nullable();
            $table->float('temperature_1_home', 3, 1)->nullable();
            $table->time('temperature_time_2_home')->nullable();
            $table->float('temperature_2_home', 3, 1)->nullable();
            $table->time('temperature_time_3_home')->nullable();
            $table->float('temperature_3_home', 3, 1)->nullable();
            $table->time('temperature_time_1_school')->nullable();
            $table->float('temperature_1_school', 3, 1)->nullable();
            $table->time('temperature_time_2_school')->nullable();
            $table->float('temperature_2_school', 3, 1)->nullable();
            $table->time('temperature_time_3_school')->nullable();
            $table->float('temperature_3_school', 3, 1)->nullable();
            $table->text('state_1_home')->nullable();
            $table->text('state_1_school')->nullable();
            $table->text('contact_3_home')->nullable();
            $table->text('contact_3_school')->nullable();
            $table->softDeletes();

            $table->foreignId('create_user_id')->nullable();
            $table->foreignId('update_user_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_books');
    }
}
