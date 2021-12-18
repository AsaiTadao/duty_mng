<?php

namespace App\Services;

use App\Models\Office;
use Illuminate\Support\Carbon;

class ChildcareService
{
    const TIME_PERIODS = [
        '07:00:00', '07:30:00','08:00:00','08:30:00','09:00:00','09:30:00','10:00:00','10:30:00','11:00:00','11:30:00',
        '12:00:00','12:30:00','13:00:00','13:30:00','14:00:00','14:30:00','15:00:00','15:30:00','16:00:00','16:30:00',
        '17:00:00','17:30:00','18:00:00','18:30:00','19:00:00','19:30:00','20:00:00','20:30:00','21:00:00','21:30:00', '22:00:00'
    ];

    public function calcWorkerNumberPerPeriod($shifts)
    {
        $timePeriods = self::TIME_PERIODS;
        $len = count($timePeriods);

        $dateString = "2021-11-08";

        $result = [];
        for ($i = 0; $i < $len - 1; $i++)
        {
            $count = 0;
            foreach ($shifts as $shift)
            {
                if (!$shift->start_time || !$shift->end_time)
                {
                    continue;
                }
                $overlapped = calcOverlappedPeriod(
                    Carbon::parse($dateString . ' ' . $timePeriods[$i]),
                    Carbon::parse($dateString . ' ' . $timePeriods[$i + 1]),
                    Carbon::parse($dateString . ' ' . $shift->start_time),
                    Carbon::parse($dateString . ' ' . $shift->end_time),
                );
                if ($overlapped)
                {
                    $count++;
                }
            }
            $result[] = $count;
        }
        return $result;
    }

    public function getChildSchedule(Office $office, Carbon $date)
    {
        $children0 =
            [ 0, 6, 6, 6, 6, 6, 6, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 6, 6, 6, 6, 6, 6, 6, 0, 0, 0, 0];
        $children1 =
            [ 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 0];
        $children2 =
            [ 0, 2, 2, 2, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 0, 0, 4, 4, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0];
        $children3 =
            [ 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 0, 0, 0, 2, 2, 2, 2, 2, 2, 2, 0, 0, 0, 0];
        $children4 =
            [ 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 2, 2, 2, 2, 2, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $children5 =
            [ 0, 0, 0, 3, 3, 3, 3, 3, 3, 3, 3, 0, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, 0, 0];

        $nurseRate = [3, 6, 7, 7, 7, 7];

        $timePeriods = self::TIME_PERIODS;
        $len = count($timePeriods);
        $neededNurse0 = [];
        $neededNurse1 = [];
        $neededNurse2 = [];
        $neededNurse3 = [];
        $neededNurse4 = [];
        $neededNurse5 = [];

        $sumPrecise = [];
        $sumRound = [];

        for ($i = 0; $i < $len - 1; $i++)
        {
            $needed0 = round($children0[$i] / $nurseRate[0], 1);
            $needed1 = round($children1[$i] / $nurseRate[1], 1);
            $needed2 = round($children2[$i] / $nurseRate[2], 1);
            $needed3 = round($children3[$i] / $nurseRate[3], 1);
            $needed4 = round($children4[$i] / $nurseRate[4], 1);
            $needed5 = round($children5[$i] / $nurseRate[5], 1);

            $precise =  $needed0 + $needed1 + $needed2 + $needed3 + $needed4 + $needed5 ;
            $round = round($precise);

            $sumPrecise[] = $precise;
            $sumRound[] = $round;
            $neededNurse0[] = $needed0;
            $neededNurse1[] = $needed1;
            $neededNurse2[] = $needed2;
            $neededNurse3[] = $needed3;
            $neededNurse4[] = $needed4;
            $neededNurse5[] = $needed5;
        }

        return [
            'children0'     =>  $children0,
            'neededNurse0'  => $neededNurse0,
            'children1'     =>  $children1,
            'neededNurse1'  => $neededNurse1,
            'children2'     =>  $children2,
            'neededNurse2'  => $neededNurse2,
            'children3'     =>  $children3,
            'neededNurse3'  => $neededNurse3,
            'children4'     =>  $children4,
            'neededNurse4'  => $neededNurse4,
            'children5'     =>  $children5,
            'neededNurse5'  => $neededNurse5,
            'sumPrecise'    =>  $sumPrecise,
            'sumRound'      =>  $sumRound
        ];
    }
}
