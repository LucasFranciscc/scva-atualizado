<?php

use \SCVA\PageAdmin;
use \SCVA\Model\User;
use \SCVA\Model\Region;

$app->get('/administrador/regiao', function () {

    User::verifyLogin(1);

    $region = Region::listAll();

    $page = new PageAdmin();

    $page->setTpl("region", [
        'regions'=>$region,
        'regionError'=>User::getError()
    ]);

});

$app->get('/administrador/regiao/cadastrar', function () {

    User::verifyLogin(1);

    $page = new PageAdmin();

    $page->setTpl("region-create", [
        'regionError'=>User::getError()
    ]);

});

$app->post('/administrador/regiao/cadastrar', function () {

    User::verifyLogin(1);

    $sql = new \SCVA\DB\Sql();
    $regions = $sql->select("select * from regions where region = :region", [":region" => $_POST["region"]]);

    if (!isset($_POST['region']) || $_POST['region'] == '') {
        User::setError("Preencha o campo região");
        header('Location: /administrador/regiao/cadastrar');
        exit;
    }

    if ($regions) {
        User::setError("Essa região já foi cadastrada");
        header('Location: /administrador/regiao/cadastrar');
        exit;
    }

    $region = new Region();

    $region->setData($_POST);

    $region->create();

    header("Location: /administrador/regiao");

    exit;

});

$app->get('/administrador/regiao/:id_region/deletar', function ($id_region) {

    User::verifyLogin(1);

    $region = new Region();

    $region->get((int)$id_region);

    $region->delete();

    header("Location: /administrador/regiao");

    exit;

});

$app->get('/administrador/regiao/:id_region', function ($id_region) {

    User::verifyLogin(1);

    $region = new Region();

    $region->get((int)$id_region);

    $page = new PageAdmin();

    $page->setTpl("region-update", array(
        'region'=>$region->getValues(),
        'regionError'=>User::getError()
));

});

$app->post('/administrador/regiao/:id_region', function ($id_region) {

    User::verifyLogin(1);

    if (!isset($_POST['region']) || $_POST['region'] == '') {
        User::setError("Preencha o campo região");
        header("Location: /administrador/regiao/$id_region");
        exit;
    }

    $region = new Region();

    $region->get((int)$id_region);

    $region->setData($_POST);

    $region->update();

    header("Location: /administrador/regiao");

    exit;

});