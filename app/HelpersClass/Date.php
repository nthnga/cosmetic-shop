<?php

namespace APP\HelpersClass;

class Date
{
    public static function getListDayInMonth()
    {
        $arrayDay = [];
        $month = date('m');
        $year = date('Y');

        //Lấy tất cả các ngày trong tháng
        for ($day = 1; $day <=31; $day++)
        {
            $item = mktime($month, $day, $year);
                if(date('m', $time) == $month)
                    $arrayDay[] = date('Y-m-d', $time);
        }
        return $arrayDay;
    }

}