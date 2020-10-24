<?php

use \SCVA\PageTecnico;
use \SCVA\Model\User;
use \SCVA\Model\Event;
use \SCVA\Model\Called;

$app->get('/tecnico', function () {

    User::verifyLogin(2);

    $page = new PageTecnico();

    $page->setTpl("index");

});

$app->get('/tecnico/evento/:id_event', function ($id_event) {

    User::verifyLogin(2);

    $event = new Event();

    $event->get((int)$id_event);

    $page = new PageTecnico();

    $page->setTpl("event", [
        'event'=>$event->getValues(),
        'eventError' => User::getError()
    ]);

});

$app->post('/tecnico/evento/:id_event', function ($id_event) {

    User::verifyLogin(2);

    $event = new Event();

    $event->get((int)$id_event);

    $event->setData($_POST);

    $event->update_status();

    $sql = new \SCVA\DB\Sql();
    $events = $sql->select("select * from events where id_events = :id_events", [":id_events" => $id_event]);

    if ($events[0]["status"] == 1) {
        User::setError("Placa ativada com sucesso");
        header('Location: /tecnico/evento/'.$id_event);
        exit;
    } else {
        User::setError("Placa desativada com sucesso");
        header('Location: /tecnico/evento/'.$id_event);
        exit;
    }

});

$app->get('/tecnico/chamados', function () {

    User::verifyLogin(2);

    $called = Called::listAll();

    $page = new PageTecnico();

    $page->setTpl("called", [
        'called'=>$called,
        'calledError' => User::getError()
    ]);

});

$app->get('/tecnico/chamados/cadastrar', function () {

    User::verifyLogin(2);

    $group = Called::listAllGroup();

    $page = new PageTecnico();

    $page->setTpl("called-create", [
        'group'=>$group,
        'calledError'=>User::getError()
    ]);

});

$app->post('/tecnico/chamados/cadastrar', function () {

    User::verifyLogin(2);

    if (!isset($_POST['description']) || $_POST['description'] == '') {
        User::setError("Preencha o campo descrição");
        header('Location: /tecnico/chamados/cadastrar');
        exit;
    }

    $called = new Called();

    $called->setData($_POST);

    $called->create();

    header("Location: /tecnico/chamados");

    exit;

});

$app->get('/tecnico/chamados/:id_called/deletar', function ($id_called) {

    User::verifyLogin(2);

    $called = new Called();

    $called->get((int)$id_called);

    $called->delete();

    header("Location: /tecnico/chamados");

    exit;

});

$app->get('/tecnico/chamados/:id_called/visualizar', function ($id_called) {

    User::verifyLogin(2);

    $called = new Called();

    $called->get((int)$id_called);

    $page = new PageTecnico();

    $page->setTpl("called-preview", [
        'called'=>$called->getValues()
    ]);

});

$app->get('/tecnico/chamados/:id_called', function ($id_called) {

    User::verifyLogin(2);

    $called = new Called();

    $group = Called::listAllGroup();

    $status = Called::listAllStatus();

    $called->get((int)$id_called);

    $page = new PageTecnico();

    $page->setTpl("called-update", [
        'called'=>$called->getValues(),
        'calledError'=>User::getError(),
        'group'=>$group,
        'status'=>$status
    ]);

});

$app->post('/tecnico/chamados/:id_called', function ($id_called) {

    User::verifyLogin(2);

    $called = new Called();

    $called->get((int)$id_called);

    $called->setData($_POST);

    $called->update();

    header("Location: /tecnico/chamados");

    exit;

});