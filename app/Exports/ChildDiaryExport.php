<?php

namespace App\Exports;

use App\Models\ChildrenClass;
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

                $sheet->setCellValue('c3', $this->office->name);
                $sheet->setCellValue('c7', $this->getClassLabel($this->childrenClassId));
                $sheet->setCellValue('b11', $this->stat['all']);
                $sheet->setCellValue('c11', $this->stat['attend']);
                $sheet->setCellValue('d11', $this->stat['absent']);

                $sheet->setCellValue('f11', $this->diary->reason_for_absence);
                $sheet->setCellValue('q11', $this->diary->special_note);

                $sheet->setCellValue('f18', $this->diary->aim);
                $sheet->setCellValue('q18', $this->diary->activity_content);


                $sheet->setCellValue('f22', $this->diary->consideration);
                $sheet->setCellValue('f24', $this->diary->evaluation_reflection);


                $sheet->setCellValue('b30', $this->diary->health_status);
                $sheet->setCellValue('b39', $this->diary->remarks);

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
