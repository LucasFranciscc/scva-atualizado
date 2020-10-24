<?php

use \SCVA\PageAdmin;
use \SCVA\Model\User;
use \SCVA\Model\Event;
use \SCVA\DB\Sql;

$app->get('/', function () {

    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("login", array (
        'userError'=>User::getError(),
        'registerValueLogin'=>(isset($_SESSION['registerValueLogin'])) ? $_SESSION['registerValueLogin'] : ['registration'=>'']
    ));

});

$app->post('/', function () {

    $matricula = $_POST['registration'];
    $db = new Sql();

    $result = $db->select("select * from users where registration = :Registration", array(
        ":Registration"=>$matricula
    ));

    $_SESSION['registerValueLogin'] = $_POST;

    if (!isset($_POST['registration']) || $_POST['registration'] == '') {
        User::setError("Preencha o campo matricula.");
        header('Location: /');
        exit;
    }

    if (!isset($_POST['password']) || $_POST['password'] == '') {
        User::setError("Preencha o campo senha.");
        header('Location: /');
        exit;
    }

    if (count($result) === 0) {
        User::setError("Usuário inexistente ou senha inválida.");
        header('Location: /');
        exit;
    }

    $data = $result[0];
    $senha = $_POST['password'];
    $senhaCriptografada = password_verify($senha, $data["password"]);

    if ($senhaCriptografada == false) {
        User::setError("Usuário inexistente ou senha inválida.");
        header('Location: /');
        exit;
    }

    $user = User::login($_POST["registration"], $_POST["password"]);


    unset($_SESSION['registerValueLogin']);

    switch ($user->getfk_level_access()) {
        case 1:
            header("Location: /administrador");
            break;

        case 2:
            header("Location: /tecnico");
            break;

        case 3:
            header("Location: /operador");
            break;
   }

   exit;

});

$app->get('/administrador', function () {

    User::verifyLogin(1);

    $status = "<script>document.write(teste)</script>";

    $group = Event::listAllGroup();

    $page = new PageAdmin();

    $page->setTpl("index", [
        'group'=>$group,
        'status'=>$status,
        'eventError' => User::getError()
    ]);

});

$app->post('/administrador', function () {

    User::verifyLogin(1);

    $event = new Event();

    $event->setData($_POST);

    $event->create();

    header("Location: /administrador");

    exit;

});

$app->get('/administrador/logout', function () {

    User::logout();

    header("Location: /");

    exit;

});

$app->get('/administrador/evento/:id_event', function ($id_event) {

    User::verifyLogin(1);

    $event = new Event();

    $event->get((int)$id_event);

    $page = new PageAdmin();
    $page->setTpl("event", [
        'event'=>$event->getValues()
    ]);

});

$app->post('/administrador/evento/:id_event', function ($id_event) {

    User::verifyLogin(1);

    $event = new Event();

    $event->get((int)$id_event);

    $event->setData($_POST);

    $event->update_status();

    header("Location: /administrador/evento/".$id_event);

    exit;

});

$app->get('/administrador/evento/:id_event/editar', function ($id_event) {

    User::verifyLogin(1);

    $event = new Event();

    $group = Event::listAllGroup();

    $event->get((int)$id_event);

    $page = new PageAdmin();

    $page->setTpl("event-update", [
        'group'=>$group,
        'event'=>$event->getValues(),
        'eventError'=>User::getError()
    ]);

});

$app->post('/administrador/evento/:id_event/editar', function ($id_event) {

    User::verifyLogin(1);

    $event = new Event();

    $event->get((int)$id_event);

    $event->setData($_POST);

    $event->update();

    header("Location: /administrador");

    exit;

});

$app->get('/administrador/evento/:id_event/deletar', function ($id_event) {

    User::verifyLogin(1);

    $event = new Event();

    $event->get((int)$id_event);

    $event->deletar();

    header("Location: /administrador");

    exit;

});