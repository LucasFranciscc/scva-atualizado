<?php
session_start();
require_once ("vendor/autoload.php");

use \Slim\Slim;

$app = new Slim();

$app->config('debug', true);

    require_once("controller/admin/admin.php");
    require_once("controller/admin/admin-users.php");
    require_once("controller/admin/admin-region.php");
    require_once("controller/admin/admin-valve.php");
    require_once("controller/admin/admin-group.php");

    require_once("controller/operador/operador.php");

    require_once("controller/tecnico/tecnico.php");

    require_once ("functions.php");


$app->run();