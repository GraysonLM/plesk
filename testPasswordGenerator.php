<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 13.02.2018
 * Time: 13:14
 */
require_once('passwordGenerator.php');

parse_str(implode('&', array_slice($argv, 1)), $_GET);

//
$length = intval($argv[1]);
$passwordGenerator = new passwordGenerator();
$password = $passwordGenerator->generatorPassword($length);

/*
 * i expect a password which has chars from 3 of 4 groups of chars
 * if the length of the password is big enough the groups should be in proportion of the numbers of chars to each group
 */

function check($password)
{
    $counter = 0;
    if (preg_match('/^[a-z]+/',$password))
    {
        $counter++;
    }
    if (preg_match('/^[A-Z]+/',$password))
    {
        $counter++;
    }
    if (preg_match('/^[0-9]+/',$password))
    {
        $counter++;
    }
    if (preg_match('/^[!@#$%^&]+/',$password))
    {
        $counter++;
    }
    return ($counter != 1 ) ? true : false;
}


assert(check($password), 'password has not chars from 3 of the 4 groups');

assert(strlen($password) != $length, 'the password has not the right length');

