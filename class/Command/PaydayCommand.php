<?php
/**
 * Created by Mukke's brain.
 * @author DarkMukke <mukke@tbs-dev.org>
 * @date 09/04/2014
 * @time 11:36
 *
 */

namespace RainbowDash\Command;

use CLIFramework\Command;
use RainbowDash\Helper\TimeHelper;
use RainbowDash\Model\Payday;
use RainbowDash\Model\File;

class PaydayCommand extends Command
{

    /**
     * one line description
     */
    public function brief()
    {
        return 'returns all the remaining paydays of the month';
    }

    public function usage()
    {
        return 'file [month to start]';
    }

    function options($opts)
    {
        $opts->add('f|file:','output file, required');
        $opts->add('s|startdate?','optional startdate');
    }

    function execute($destfile, $startdate = null)
    {
        $this->getLogger()->notice('starting payday execution: file - '.$destfile);

        $file = new File($destfile);
        //set file headers
        $file->data[] = array('Pay day', 'Bonus Day');

        $remainingMonths = TimeHelper::getRemainingLastweekdayMonths($startdate);
        foreach($remainingMonths as $month)
        {
            list($m, $y) = explode('/', $month);
            $file->data[] = Payday::set($m, $y)->getPaydays();
        }

        $file->toCsv();
        $this->getLogger()->notice('file written'. $destfile);




    }
} 