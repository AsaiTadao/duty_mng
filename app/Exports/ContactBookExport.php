<?php

namespace App\Exports;

use App\Models\ChildrenClass;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Excel;

class ContactBookExport implements WithEvents
{
    protected $contactBook;
    protected $office;
    protected $child;
    protected $date;

    public function __construct($child, $office, $date, $contactBook)
    {
        $this->child = $child;
        $this->office = $office;
        $this->contactBook = $contactBook;
        $this->date = $date;
    }
    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                if ($this->child->class_id === ChildrenClass::AGE_0)
                {
                    $contactType = '0';
                }
                else if ($this->child->class_id === ChildrenClass::AGE_1 || $this->child->class_id === ChildrenClass::AGE_2)
                {
                    $contactType = '1';
                } else {
                    $contactType = '2';
                }
                $templateFile = new LocalTemporaryFile(storage_path('app/excel/contact_book_' . $contactType . '.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(0);

                $sheet->setCellValue('b1', $this->office->name);
                $sheet->setCellValue('b4', $this->child->name);
                $sheet->setCellValue('c4', $this->date);
                $sheet->setCellValue('m4', $this->contactBook->weather);
                $sheet->setCellValue('e6', $this->contactBook->guardian);
                $sheet->setCellValue('n6', $this->contactBook->nurse_name);


                // $sheet->getDelegate()->getStyle("f12:f12")->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'EBCB42']]);


                if ($contactType === '0')
                {
                    $sheet->setCellValue('e8', $this->moodLabel($this->contactBook->mood));
                    $sheet->setCellValue('e9', $this->timeLabel($this->contactBook->pick_up_time));
                    $sheet->setCellValue('n8', $this->timeLabel($this->contactBook->temperature_time_std));
                    $sheet->setCellValue('t8', $this->contactBook->temperature_std);
                    $sheet->setCellValue('n9', $this->contactBook->pick_up_person);

                    $times = [
                        '1800','1830','1900','1930','2000','2030','2100','2130','2200','2230','2300','2330','2400','2430','0100','0130','0200','0230','0300','0330','0400','0430','0500','0530','0600','0630','0700','0730','0800','0830','0900','0930','1000','1030','1100','1130','1200','1230','1300','1330','1400','1430','1500','1530','1600','1630','1700','1730'
                    ];
                    $row1 = 14;
                    foreach ($times as $time)
                    {
                        if ($time === '2400') {
                            $row1 = 28;
                        }
                        $color = $this->sleepColor($time);
                        if ($color)
                        {
                            $sheet->getDelegate()->getStyle("f" . $row1 . ":" . "f" . $row1)->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => $color]]);
                        }
                        $row1++;
                    }
                    $times = [
                        '18','19','20','21','22','23','24','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17'
                    ];
                    $row = 14;
                    foreach ($times as $time)
                    {
                        if ($time === '24')
                        {
                            $row = 28;
                        }
                        $sheet->setCellValue("H$row", $this->temperatureTimedLabel($time));
                        $sheet->setCellValue("K$row", $this->defecationTimedLabel($time));
                        $sheet->setCellValue("O$row", $this->mealTimedLabel($time));
                        $row += 2;
                    }
                    $date = Carbon::parse($this->date);
                    $date->settings(['formatFunction' => 'translatedFormat']);
                    $sheet->setCellValue('b26', $date->format('m月 d日 (l)'));
                    $date->subDays(1);
                    $sheet->setCellValue('b12', $date->format('m月 d日 (l)'));

                    $sheet->setCellValue('b67', $this->contactBook->state_0_home);
                    $sheet->setCellValue('n67', $this->contactBook->state_0_school);
                    $sheet->setCellValue('b77', $this->contactBook->contact_0_home);
                    $sheet->setCellValue('n77', $this->contactBook->contact_0_school);
                } else if ($contactType === '1') {
                    $sheet->setCellValue('e9', $this->timeLabel($this->contactBook->pick_up_time));
                    $sheet->setCellValue('q9', $this->contactBook->pick_up_person);

                    //========home=========
                    $sheet->setCellValue('c15', $this->timeLabel($this->contactBook->meal_time_1_home));
                    $sheet->setCellValue('f15', $this->mealLabel($this->contactBook->meal_amount_1_home));
                    $sheet->setCellValue('h15', $this->contactBook->meal_memo_1_home);

                    $sheet->setCellValue('c17', $this->timeLabel($this->contactBook->meal_time_2_home));
                    $sheet->setCellValue('f17', $this->mealLabel($this->contactBook->meal_amount_2_home));
                    $sheet->setCellValue('h17', $this->contactBook->meal_memo_2_home);

                    $sheet->setCellValue('c19', $this->timeLabel($this->contactBook->meal_time_3_home));
                    $sheet->setCellValue('f19', $this->mealLabel($this->contactBook->meal_amount_3_home));
                    $sheet->setCellValue('h19', $this->contactBook->meal_memo_3_home);

                    $sheet->setCellValue('f22', $this->moodLabel($this->contactBook->mood_1_home));
                    $sheet->setCellValue('f24', $this->moodLabel($this->contactBook->mood_2_home));

                    $sheet->setCellValue('f27', $this->defecationLabel($this->contactBook->defecation_1_home));
                    $sheet->setCellValue('L27', $this->contactBook->defecation_count_1_home);
                    $sheet->setCellValue('f29', $this->defecationLabel($this->contactBook->defecation_2_home));
                    $sheet->setCellValue('L29', $this->contactBook->defecation_count_2_home);


                    $sheet->setCellValue('c32', $this->timePeriodLabel($this->contactBook->sleep_start_1_home, $this->contactBook->sleep_end_1_home));
                    $sheet->setCellValue('c34', $this->timePeriodLabel($this->contactBook->sleep_start_2_home, $this->contactBook->sleep_end_2_home));

                    $sheet->setCellValue('c37', $this->bathLabel($this->contactBook->bathing_home));

                    $sheet->setCellValue('c40', $this->timeLabel($this->contactBook->temperature_time_1_home));
                    $sheet->setCellValue('f40', $this->timeLabel($this->contactBook->temperature_time_2_home));
                    $sheet->setCellValue('j40', $this->timeLabel($this->contactBook->temperature_time_3_home));

                    $sheet->setCellValue('c42', $this->contactBook->temperature_1_home);
                    $sheet->setCellValue('f42', $this->contactBook->temperature_2_home);
                    $sheet->setCellValue('j42', $this->contactBook->temperature_3_home);

                    $sheet->setCellValue('b47', $this->contactBook->state_0_home);


                    //========school=========
                    $sheet->setCellValue('o15', $this->timeLabel($this->contactBook->meal_time_1_school));
                    $sheet->setCellValue('r15', $this->mealLabel($this->contactBook->meal_amount_1_school));
                    $sheet->setCellValue('t15', $this->contactBook->meal_memo_1_school);

                    $sheet->setCellValue('o17', $this->timeLabel($this->contactBook->meal_time_2_school));
                    $sheet->setCellValue('r17', $this->mealLabel($this->contactBook->meal_amount_2_school));
                    $sheet->setCellValue('t17', $this->contactBook->meal_memo_2_school);

                    $sheet->setCellValue('o19', $this->timeLabel($this->contactBook->meal_time_3_school));
                    $sheet->setCellValue('r19', $this->mealLabel($this->contactBook->meal_amount_3_school));
                    $sheet->setCellValue('t19', $this->contactBook->meal_memo_3_school);

                    $sheet->setCellValue('r22', $this->moodLabel($this->contactBook->mood_1_school));
                    $sheet->setCellValue('r24', $this->moodLabel($this->contactBook->mood_2_school));

                    $sheet->setCellValue('r27', $this->defecationLabel($this->contactBook->defecation_1_school));
                    $sheet->setCellValue('x27', $this->contactBook->defecation_count_1_school);
                    $sheet->setCellValue('r29', $this->defecationLabel($this->contactBook->defecation_2_school));
                    $sheet->setCellValue('x29', $this->contactBook->defecation_count_2_school);


                    $sheet->setCellValue('o32', $this->timePeriodLabel($this->contactBook->sleep_start_1_school, $this->contactBook->sleep_end_1_school));
                    $sheet->setCellValue('o34', $this->timePeriodLabel($this->contactBook->sleep_start_2_school, $this->contactBook->sleep_end_2_school));

                    $sheet->setCellValue('o37', $this->bathLabel($this->contactBook->bathing_school));

                    $sheet->setCellValue('o40', $this->timeLabel($this->contactBook->temperature_time_1_school));
                    $sheet->setCellValue('r40', $this->timeLabel($this->contactBook->temperature_time_2_school));
                    $sheet->setCellValue('v40', $this->timeLabel($this->contactBook->temperature_time_3_school));

                    $sheet->setCellValue('o42', $this->contactBook->temperature_1_school);
                    $sheet->setCellValue('r42', $this->contactBook->temperature_2_school);
                    $sheet->setCellValue('v42', $this->contactBook->temperature_3_school);

                    $sheet->setCellValue('n47', $this->contactBook->state_0_school);
                } else {
                    $sheet->setCellValue('b11', $this->contactBook->contact_0_home);
                    $sheet->setCellValue('n11', $this->contactBook->contact_0_school);
                }
            }
        ];
    }
    public function moodLabel($mood)
    {
        if ($mood == 1)
        {
            return '普通';
        }
        if ($mood == 2)
        {
            return '良い';
        }
        if ($mood == 3)
        {
            return '悪い';
        }
        return '';
    }
    public function bathLabel($bath)
    {
        if (!$bath) return null;
        if ($bath == 1) return '有り';
        return '無し';
    }
    public function timePeriodLabel($start, $end)
    {
        if (!$start || !$end) return null;
        return Carbon::parse($start)->format('H:i') . ' ~ ' . Carbon::parse($end)->format('H:i');
    }
    public function timeLabel($time)
    {
        if (!$time) return null;
        return Carbon::parse($time)->format('H:i');
    }
    public function sleepColor($time)
    {
        $varSchool = 'sleep_' . $time . '_school';
        $varHome = 'sleep_' . $time . '_home';
        if ($this->contactBook->$varSchool) return 'EBCB42';
        if ($this->contactBook->$varHome) return '8BB3FC';
        return null;
    }
    public function temperatureTimedLabel($time)
    {
        $varSchool = 'temperature_' . $time . '_school';
        $varHome = 'temperature_' . $time . '_home';
        if ($this->contactBook->$varSchool) return $this->contactBook->$varSchool;
        return $this->contactBook->$varHome;
    }
    public function defecationTimedLabel($time)
    {
        $time = (int) $time;
        $varSchool = 'defecation_' . $time . '_school';
        $varHome = 'defecation_' . $time . '_home';
        if ($this->contactBook->$varSchool) return $this->defecationLabel($this->contactBook->$varSchool);
        return $this->defecationLabel($this->contactBook->$varHome);
    }
    public function mealLabel($meal)
    {
        if ($meal == 1) {
            return '完食';
        }
        if ($meal == 2) {
            return '残食';
        }
        if ($meal == 3) {
            return 'おかわり';
        }
        return null;
    }

    public function defecationLabel($defecation)
    {
        if ($defecation == 1)
        {
            return '普通';
        }
        if ($defecation == 2)
        {
            return '軟い';
        }
        if ($defecation == 3)
        {
            return '固い';
        }
        return null;
    }
    public function mealTimedLabel($time)
    {
        $time = (int) $time;
        $varSchool = 'meal_' . $time . '_school';
        $varHome = 'meal_' . $time . '_home';
        if ($this->contactBook->$varSchool) return $this->contactBook->$varSchool;
        return $this->contactBook->$varHome;
    }
}
