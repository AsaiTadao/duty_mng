<?php

namespace App\Services;

use Illuminate\Support\Str;
use DateTime;

class UtilService
{
    public function bladeCompile($value, array $args = array())
    {
        $generated = \Blade::compileString($value);

        ob_start() and extract($args, EXTR_SKIP);
        // We'll include the view contents for parsing within a catcher
        // so we can avoid any WSOD errors. If an exception occurs we
        // will throw it out to the exception handler.
        try
        {
            eval('?>'.$generated);
        }

        // If we caught an exception, we'll silently flush the output
        // buffer so that no partially rendered views get thrown out
        // to the client and confuse the user with junk.
        catch (\Exception $e)
        {
            ob_get_clean(); throw $e;
        }

        $content = ob_get_clean();

        return $content;
    }

    public function templateCompile($value, $args)
    {
        $search = [];
        $replace = [];
        foreach($args as $s => $r)
        {
            // if (!$r) continue;
            $search[] = '__' . $s . '__';
            $replace[] = $r;
        }
        return Str::replace($search, $replace, $value);
    }

    /**
     * 日時の差分比較
     * $datetime
     */
    function diffTime($datetime) {
        $date_time = new DateTime($datetime);
        $date_time2 = new DateTime();
        $diff = $date_time->diff($date_time2);
        if (!empty($y = $diff->format('%y'))) {
            return $y . '年前';
        } else if (!empty($m = $diff->format('%m'))) {
            return $m . 'ヶ月前';
        } else if (!empty($d = $diff->format('%d'))) {
            return $d . '日前';
        } else if (!empty($h = $diff->format('%h'))) {
            return $h . '時間前';
        } else if (!empty($i= $diff->format('%i'))) {
            return $i . '分前';
        }
        return null;
    }
}
