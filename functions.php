<?php

use \SCVA\Model\User;

function getUserName()
{
    $user = User::getFromSession();
    return $resultado = utf8_decode($user->getname());
}

function getUserRegistration()
{
    $user = User::getFromSession();
    return $user->getregistration();
}

function formatDate($date)
{

    return date('d/m/Y H:i:s', strtotime($date));

}

function selectOption($value, $results, $data)
{

    if ($data == $value)
    {
        echo "<option value='$value' selected >$results</option>";
    }
    else
    {
        echo "<option value='$value' >$results</option>";
    }


}
