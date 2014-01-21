<?php
/**
 * Created by Ethan Liew
 * Project  :
 * Date     : 1/16/14
 * Time     : 6:49 PM
 * Version  :
 * Desc     :
 *
 *
 */

class CPerson2
{
    public $name;
    public $addr;
    public $city;
    public $other_data;

    function __construct($other = '')
    {
        $this->address = preg_replace('/[a-z]/', 'x', $this->address);
        $this->other_data = $other;
    }
}