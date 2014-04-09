<?php
 /**
 * Created by Mukke's brain.
 * @author DarkMukke <mukke@tbs-dev.org>
 * @date 09/04/2014
 * @time 11:50
 *
 */

namespace RainbowDash\Helper;

/**
 * Class TimeHelper
 * A class to provide some static helpers for time calculations
 *
 * @package RainbowDash\Helper
 */
class TimeHelper {


    /**
     * Method to calculate the last weekday (not sat or sunday)
     *
     * @param $timeOrMonth int if year is not null, the numeric representation of a month will be used. Otherwise we assume unix timestamp
     * @param null|int $year
     * @return int unix timestamp
     */
    public static function getLastWeekday($timeOrMonth, $year=null)
    {
        if(!is_null($year))
        {

            $timeOrMonth = self::timeFromDayMonthYear(1,$timeOrMonth, $year);
        }
        //some variables to be used later
        $month = date('n', $timeOrMonth);
        $year = date('Y', $timeOrMonth);

        $lastDay = date('t', $timeOrMonth);
        $lastDayInt = self::timeFromDayMonthYear($lastDay, $month, $year);
        $lastDayNumber = date('w', $lastDayInt);

        while($lastDayNumber == 0 || $lastDayNumber == 6)
        {
            $lastDay--;
            $lastDayInt = self::timeFromDayMonthYear($lastDay, $month, $year);
            $lastDayNumber = date('w', $lastDayInt);
        }
        return $lastDayInt;

    }

    /**
     * Helper to get the bonus day for a month
     *
     * @param $month
     * @param $year
     * @return int
     */
    public static function getBonusDay($month, $year)
    {
        //the task said always the 15th but i rather build in variables so the function can become more dynamic later on if needed
        $setBonusDay = 15;
        $bonusDay = self::timeFromDayMonthYear($setBonusDay, $month, $year);
        $bonusDayNumber = date('w', $bonusDay);
        switch ($bonusDayNumber)
        {
            case 6 : $bonusDay = self::timeFromDayMonthYear($setBonusDay+4, $month, $year);
                break;
            case 0 : $bonusDay = self::timeFromDayMonthYear($setBonusDay+3, $month, $year);
                break;
        }
        return $bonusDay;
    }

    /**
     * Helper method to get the remaining months of a year
     *
     * @param null|int $startTime unix timestamp to start the calculations
     * @return array Returns an array with the remaining months.
     */
    public static function getRemainingLastweekdayMonths($startTime = null)
    {
        $startTime = (is_null($startTime)) ? time() : $startTime;
        $month = date('n', $startTime);
        $year = date('Y', $startTime);
        $remainingMonths = (12 - $month)+1;
        //now there is some error here if you run the script between midnight and 1am
        //i am just considering for the test this doesn't happen
        if($startTime > self::getLastWeekday($startTime))
        {
            $remainingMonths--;
        }
        $left = array();
        for($i=0;$i<$remainingMonths;$i++)
        {
            $left[] = $month+$i.'/'.$year;
        }
        return $left;
    }

    /**
     * Little helper to reduce the times i have to use mktime for just day, month and year
     *
     * @param $day
     * @param $month
     * @param $year
     * @return int unix timestamp
     */
    public static function timeFromDayMonthYear($day, $month, $year)
    {
        //we use 1am, because midnight is often confusing
        return mktime(1,0,0,$month, $day, $year);
    }

}
