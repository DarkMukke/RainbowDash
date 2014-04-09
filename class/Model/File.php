<?php
 /**
 * Created by Mukke's brain.
 * @author DarkMukke <mukke@tbs-dev.org>
 * @date 09/04/2014
 * @time 13:43
 *
 */

namespace RainbowDash\Model;


class File{

    public $data = array();
    public $destfile = '';

    public function __construct($destfile)
    {
        $this->destfile = $destfile;
    }

    public function toCsv()
    {
        $handle = fopen($this->destfile, 'w');
        foreach ($this->data as $line) {
            fputcsv($handle, $line);
        }
        fclose($handle);
    }

} 