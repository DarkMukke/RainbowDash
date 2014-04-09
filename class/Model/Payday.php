<?php
/**
 * Created by Mukke's brain.
 * @author DarkMukke <mukke@tbs-dev.org>
 * @date 09/04/2014
 * @time 11:44
 *
 */

namespace RainbowDash\Model;

use RainbowDash\Helper\TimeHelper;

/**
 * Class that provides dates for payday and bonus payday for a given month and year
 *
 * Class Payday
 * @package RainbowDash\Model
 */
class Payday
{

    public $month;
    public $year;

    protected $format = DATE_RFC2822;
    protected $payDay;
    protected $bonusDay;


    /**
     * Factory method for readability
     *
     * @param $month
     * @param $year
     * @return Payday
     */
    public static function set($month, $year)
    {
        $payday = new Payday();
        $payday->month = $month;
        $payday->year = $year;
        return $payday;

    }

    /**
     * Chained method to set the time
     *
     * @param $format
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }


    /**
     * Last of the chains of method that returns an array containing both paydays
     *
     * @return array
     */
    public function getPaydays()
    {
        $this->payDay = TimeHelper::getLastWeekday($this->month, $this->year);
        $nextMonth = $this->month + 1;
        $nextYear = $this->year;
        if ($nextMonth > 12) {
            $nextYear++;
        }
        $this->bonusDay = TimeHelper::getBonusDay($nextMonth, $nextYear);

        $paydays = array();
        $paydays['payDay'] = date($this->format, $this->payDay);
        $paydays['bonusDay'] = date($this->format, $this->bonusDay);
        return $paydays;

    }


} 