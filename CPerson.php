<?php
/**
 * Created by Ethan Liew
 * Project  :
 * Date     : 1/16/14
 * Time     : 6:15 PM
 * Version  :
 * Desc     :
 *
 *
 */

class CPerson
{
    public $username;
    public $password;


    function __construct($username, $password)
    {
        $this->password = $password;
        $this->username = $username;
    }
}