<?php

use \SCVA\PageOperador;
use \SCVA\Model\User;
use \SCVA\Model\Called;


$app->get('/operador', function () {

    User::verifyLogin(3);

    $called = Called::listAllOperador();

    $page = new PageOperador();

    $page->setTpl("index",[
        'called'=>$called
    ]);

});

$app->get('/operador/visualizar-chamado/:id_called', function ($id_called) {

    User::verifyLogin(3);

    $called = new Called();

    $called->get((int)$id_called);

    $page = new PageOperador();

    $page->setTpl("called-preview-status", [
        'called'=>$called->getValues()
    ]);

});

$app->post('/operador/visualizar-chamado/:id_called', function ($id_called) {

    User::verifyLogin(3);

    $called = new Called();

    $called->get((int)$id_called);

    $called->setData($_POST);

    $called->updateStatus();

    header("Location: /operador");

    exit;

});