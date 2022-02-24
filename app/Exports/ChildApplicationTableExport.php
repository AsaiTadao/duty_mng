<?php

namespace App\Exports;

use App\Models\ChildrenClass;
use App\Models\EmploymentStatus;
use App\Models\ReasonForAbsence;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ChildApplicationTableExport implements WithEvents
{
    protected $data;
    protected $office;
    protected $month;
    protected $childrenClasses;

    public function __construct($data, $office, $month)
    {
        $this->data = $data;
        $this->office = $office;
        $this->month = $month;
        $this->childrenClasses = ChildrenClass::get();
    }

    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(storage_path('app/excel/child_application_table.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(0);

                $sheet->setCellValue('B3', Carbon::now()->format('m/d/Y'));
                $sheet->setCellValue('G3', $this->office->name);
                $sheet->setCellValue('O3', $this->office->capacity . '名');

                $sheet->setCellValue('E5', $this->data['children_stat'][ChildrenClass::AGE_0]);
                $sheet->setCellValue('E6', $this->data['children_stat'][ChildrenClass::AGE_1]);
                $sheet->setCellValue('E7', $this->data['children_stat'][ChildrenClass::AGE_2]);
                $sheet->setCellValue('E8', $this->data['children_stat'][ChildrenClass::AGE_3]);
                $sheet->setCellValue('E9', $this->data['children_stat'][ChildrenClass::AGE_4]);
                $sheet->setCellValue('E10', $this->data['children_stat'][ChildrenClass::AGE_5]);

                $sheet->setCellValue('N5', $this->data['children_type_stat']['employee_quota']);
                $sheet->setCellValue('N6', $this->data['children_type_stat']['regional']);
                $sheet->setCellValue('N7', $this->data['children_type_stat']['employee_quota_ratio'] / 100);
                $sheet->setCellValue('N9', $this->data['children_type_stat']['regional_ratio'] / 100);

                $sheet->getDelegate()->getStyle('B5:B10')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'DDEBF7']]);
                $sheet->getDelegate()->getStyle('K5:K10')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'DDEBF7']]);
                $sheet->getDelegate()->getStyle('AJ5:AM15')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'DDEBF7']]);
                $sheet->getDelegate()->getStyle('B18:AN18')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'FFE699']]);


                $baseDay = Carbon::parse($this->month . '-01');
                $daysInMonth = $baseDay->daysInMonth;

                $columns = ['AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV'];

                for ($i = 0; $i < $daysInMonth; $i++)
                {
                    $day = $i + 1;
                    $sheet->setCellValue($columns[$i] . '3', $day);
                    $baseDay->setDay($day);
                    $sheet->setCellValue($columns[$i] . '4', $baseDay->isoFormat('dd'));
                    $sheet->setCellValue($columns[$i] . '5', $this->zeroToString($this->data['children_stat']['extension_stat'][$day]['a']));
                    $sheet->setCellValue($columns[$i] . '6', $this->zeroToString($this->data['children_stat']['extension_stat'][$day]['b']));
                    $sheet->setCellValue($columns[$i] . '7', $this->zeroToString($this->data['children_stat']['extension_stat'][$day]['c']));
                    $sheet->setCellValue($columns[$i] . '8', $this->zeroToString($this->data['children_stat']['extension_stat'][$day]['d']));
                    $sheet->setCellValue($columns[$i] . '9', $this->zeroToString($this->data['children_stat']['extension_stat'][$day]['e']));


                    $sheet->setCellValue($columns[$i] . '10', $this->zeroToString($this->data['children_stat']['absent_stat'][$day][ReasonForAbsence::REASON_CORONA]));
                    $sheet->setCellValue($columns[$i] . '11', $this->zeroToString($this->data['children_stat']['absent_stat'][$day][ReasonForAbsence::REASON_PRIVATE]));
                    $sheet->setCellValue($columns[$i] . '12', $this->zeroToString($this->data['children_stat']['absent_stat'][$day][ReasonForAbsence::REASON_KIBIKI]));
                    $sheet->setCellValue($columns[$i] . '13', $this->zeroToString($this->data['children_stat']['absent_stat'][$day][ReasonForAbsence::REASON_SICK]));
                    $sheet->setCellValue($columns[$i] . '14', $this->zeroToString($this->data['children_stat']['absent_stat'][$day][ReasonForAbsence::REASON_SUSPENSION]));
                    $sheet->setCellValue($columns[$i] . '15', $this->zeroToString($this->data['children_stat']['absent_stat'][$day][ReasonForAbsence::REASON_VACATION]));

                    $sheet->setCellValue($columns[$i] . '17', $day);
                }

                $sheet->setCellValue('BW5', '=sum(ar5:bv5)');
                $sheet->setCellValue('BW6', '=sum(ar6:bv6)');
                $sheet->setCellValue('BW7', '=sum(ar7:bv7)');
                $sheet->setCellValue('BW8', '=sum(ar8:bv8)');
                $sheet->setCellValue('BW9', '=sum(ar9:bv9)');

                $sheet->setCellValue('BW10', '=sum(ar10:bv10)');
                $sheet->setCellValue('BW11', '=sum(ar11:bv11)');
                $sheet->setCellValue('BW12', '=sum(ar12:bv12)');
                $sheet->setCellValue('BW13', '=sum(ar13:bv13)');
                $sheet->setCellValue('BW14', '=sum(ar14:bv14)');
                $sheet->setCellValue('BW15', '=sum(ar15:bv15)');

                $sheet->getDelegate()->getStyle('AR3:BW4')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'F2F2F2']]);
                $sheet->getDelegate()->getStyle('AR17:CG18')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'F2F2F2'],]);

                $row = 19;
                foreach ($this->data['children_table'] as $classId => $childClass)
                {
                    $sheet->mergeCells("B$row:AP$row");
                    $sheet->getDelegate()->getStyle("B$row:AP$row")->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'C6E0B4']]);
                    $sheet->getDelegate()->getStyle("B$row:AP$row")->applyFromArray(['font' => ['bold' => true]]);
                    $sheet->setCellValue("B$row", $this->getClassLabel($classId));

                    $sheet->mergeCells("AR$row:CI$row");
                    $sheet->getDelegate()->getStyle("AR$row:CI$row")->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'C6E0B4']]);
                    $sheet->getDelegate()->getStyle("AR$row:CI$row")->applyFromArray(['font' => ['bold' => true]]);

                    $sheet->getDelegate()->getStyle("AR$row:CI$row")->applyFromArray([
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_LEFT,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '000000'
                                ]
                            ]
                        ]
                    ]);

                    $sheet->setCellValue("AR$row", $this->getClassLabel($classId));
                    $sheet->getDelegate()->getStyle("B$row:AP$row")->applyFromArray([
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_LEFT,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '000000'
                                ]
                            ]
                        ]
                    ]);

                    $row++;
                    $index = 1;
                    foreach ($childClass as $childItem)
                    {
                        $sheet->setCellValue("B$row", $index);
                        $sheet->mergeCells("C$row:F$row");
                        $sheet->setCellValue("C$row", $this->convertToDateString($childItem['admission_date']));
                        $sheet->mergeCells("G$row:K$row");
                        $sheet->setCellValue("G$row", $childItem['name']);
                        $sheet->setCellValue("L$row", $this->convertToDateString($childItem['birthday']));
                        $sheet->mergeCells("L$row:O$row");
                        $sheet->setCellValue("P$row", $this->getAge($childItem['birthday']));
                        $sheet->mergeCells("P$row:R$row");
                        $sheet->setCellValue("S$row", $childItem['type']);
                        $sheet->mergeCells("S$row:W$row");
                        $sheet->setCellValue("X$row", $childItem['company_name']);
                        $sheet->mergeCells("X$row:AC$row");
                        $sheet->setCellValue("AD$row", $childItem['free_of_charge']);
                        $sheet->mergeCells("AD$row:AF$row");
                        $sheet->setCellValue("AG$row", $childItem['certificate_of_payment']);
                        $sheet->mergeCells("AG$row:AI$row");
                        $sheet->setCellValue("AJ$row", $this->convertToDateString($childItem['certificate_expiration_date']));
                        $sheet->mergeCells("AJ$row:AM$row");
                        $sheet->setCellValue("AN$row", $childItem['tax_exempt_household']);
                        $sheet->mergeCells("AN$row:AP$row");

                        for ($i = 0; $i < $daysInMonth; $i++)
                        {
                            $sheet->setCellValue($columns[$i] . $row, $childItem['extension_state'][$i + 1]);
                        }
                        $sheet->getDelegate()->getStyle("AR$row:CI$row")->applyFromArray(['borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '000000'
                                ]
                        ]]]);

                        $sheet->getDelegate()->getStyle("BV$row")->applyFromArray(['borders' => [
                            'right' => [
                                'borderStyle' => Border::BORDER_MEDIUM,
                                'color' => [
                                    'rgb' => '000000'
                                ]
                        ]]]);
                        $sheet->mergeCells("BW$row:BX$row");
                        $sheet->setCellValue("BW$row", $childItem['attend_count']);
                        $sheet->mergeCells("BY$row:BZ$row");
                        $sheet->setCellValue("BY$row", $childItem['absent_count']);
                        $sheet->mergeCells("CG$row:CI$row");
                        $sheet->setCellValue("CG$row", $childItem['exit_date']);

                        $row++;
                        $index++;
                    }
                }

                $row--;
                $sheet->getDelegate()->getStyle("B19:AP$row")->applyFromArray(['borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => [
                            'rgb' => '000000'
                        ]
                ]]]);

            }
        ];
    }
    public function getClassLabel($classId)
    {
        $cClass = $this->childrenClasses->firstWhere('id', $classId);
        if ($cClass) return $cClass->name;
        return '';
    }
    private function zeroToString($value)
    {
        if (!$value) return '';
        return $value;
    }
    private function convertToDateString($date)
    {
        if (!$date) return '';
        return Carbon::parse($date)->format('m/d/Y');
    }

    private function getAge($birthday)
    {
        if (!$birthday) return '';
        $diffInMonths = Carbon::parse($birthday)->diffInMonths(Carbon::now());
        $diffInYear = floor($diffInMonths / 12);
        $months = $diffInMonths % 12;

        return $diffInYear . '歳' . $months .'ヶ月';
    }
    private function getTypeLabel()
    {

    }
}
