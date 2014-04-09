<?php
/**
 * Created by Mukke's brain.
 * @author DarkMukke <mukke@tbs-dev.org>
 * @date 09/04/2014
 * @time 11:29
 *
 */

namespace RainbowDash;

use CLIFramework\Application;

/**
 * Class to handle the cli side of the application
 *
 * Class CLIApi
 * @package RainbowDash
 */
class CLIApi extends Application
{
    const NAME = 'RainbowDash';
    const VERSION = '0.1-dev';

    public function init()
    {
        parent::init();
        $this->registerCommand('payday', 'RainbowDash\Command\PaydayCommand');
    }

} 