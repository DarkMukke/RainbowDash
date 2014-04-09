<?php
 /**
 * Created by Mukke's brain.
 * @author DarkMukke <mukke@tbs-dev.org>
 * @date 09/04/2014
 * @time 13:53
 *
 */
use RainbowDash\CLIApi;

$loader = require 'vendor/autoload.php';

date_default_timezone_set('Europe/London');

$app = new CLIApi();
$app->run($argv);