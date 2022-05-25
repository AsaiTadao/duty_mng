<?php

namespace App\Exports;

use App\Models\ChildrenClass;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;

class ChildDiaryExport implements WithEvents
{
    protected $childrenClasses;
    protected $office;
    protected $diary;
    protected $childrenClassId;
    protected $stat;

    public function __construct($office, $diary, $childrenClassId, $stat)
    {
        $this->childrenClasses = ChildrenClass::get();
        $this->office = $office;
        $this->diary = $diary;
        $this->childrenClassId = $childrenClassId;
        $this->stat = $stat;
    }


    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(storage_path('app/excel/child_diary.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(0);

                $sheet->setCellValue('a1', $this->office->name);
                $sheet->setCellValue('b5', $this->getClassLabel($this->childrenClassId));

                $date = Carbon::parse($this->diary->date);
                $date->settings(['formatFunction' => 'translatedFormat']);
                $sheet->setCellValue('i3', $date->format('Y年 F jS（l）'));
                $sheet->setCellValue('j4', $this->diary->weather);

                $sheet->setCellValue('a9', $this->stat['all']);
                $sheet->setCellValue('c9', $this->stat['attend']);
                $sheet->setCellValue('e9', $this->stat['absent']);

                $sheet->setCellValue('g8', $this->diary->reason_for_absence);
                $sheet->setCellValue('r8', $this->diary->special_note);

                $sheet->setCellValue('d16', $this->diary->aim);
                $sheet->setCellValue('p16', $this->diary->activity_content);


                $sheet->setCellValue('d20', $this->diary->consideration);
                $sheet->setCellValue('d22', $this->diary->evaluation_reflection);


                $sheet->setCellValue('a29', $this->diary->health_status);
                $sheet->setCellValue('a37', $this->diary->remarks);

            }
        ];
    }
    public function getClassLabel($classId)
    {
        $cClass = $this->childrenClasses->firstWhere('id', $classId);
        if ($cClass) return $cClass->name;
        return '';
    }

}
