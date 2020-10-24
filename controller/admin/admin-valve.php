<?php

use \SCVA\PageAdmin;
use \SCVA\Model\Valve;
use \SCVA\Model\User;

$app->get('/administrador/valvula', function () {

    User::verifyLogin(1);

    $valve = Valve::listAll();

    $page = new PageAdmin();

    $page->setTpl("valve", [
        'valves'=>$valve,
        'valveError'=>User::getError()
    ]);

});

$app->get('/administrador/valvula/cadastrar', function () {

    User::verifyLogin(1);

    $page = new PageAdmin();

    $page->setTpl("valve-create", [
        'valveError'=>User::getError()
    ]);

});

$app->post('/administrador/valvula/cadastrar', function () {

    User::verifyLogin(1);

    $sql = new \SCVA\DB\Sql();
    $valves = $sql->select("select * from valves where valve = :valve", [":valve" => $_POST["valve"]]);

    if (!isset($_POST['valve']) || $_POST['valve'] == '') {
        User::setError("Preencha o campo válvula");
        header('Location: /administrador/valvula/cadastrar');
        exit;
    }

    if ($valves) {
        User::setError("Essa valvula já foi cadastrada");
        header('Location: /administrador/valvula/cadastrar');
        exit;
    }

    $valve = new Valve();

    $valve->setData($_POST);

    $valve->create();

    header("Location: /administrador/valvula");

    exit;

});

$app->get('/administrador/valvula/:id_valve/deletar', function ($id_valve) {

    User::verifyLogin(1);

    $valve = Valve::check_linked_group($id_valve);

    if ($valve != null)
    {
        User::setError("A válvula não pode ser excluida, por que está vinculada a um grupo");
        header('Location: /administrador/valvula');
        exit;
    } else {

        $valve = new Valve();

        $valve->get((int)$id_valve);

        $valve->delete();

        header("Location: /administrador/valvula");

        exit;

    }



});

$app->get('/administrador/valvula/:id_valve', function ($id_valve) {

    User::verifyLogin(1);

    $valve = new Valve();

    $valve->get((int)$id_valve);

    $page = new PageAdmin();

    $page->setTpl("valve-update", array(
        'valve'=>$valve->getValues(),
        'valveError'=>User::getError()
    ));

});

$app->post('/administrador/valvula/:id_valve', function ($id_valve) {

    User::verifyLogin(1);

    if (!isset($_POST['valve']) || $_POST['valve'] == '') {
        User::setError("Preencha o campo válvula");
        header("Location: /administrador/valvula/$id_valve");
        exit;
    }

    $valve = new Valve();

    $valve->get((int)$id_valve);

    $valve->setData($_POST);

    $valve->update();

    header("Location: /administrador/valvula");

    exit;

});