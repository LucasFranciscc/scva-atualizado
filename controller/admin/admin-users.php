<?php

use SCVA\DB\Sql;
use \SCVA\PageAdmin;
use \SCVA\Model\User;

$app->get('/administrador/usuario', function () {

    User::verifyLogin(1);

    $user = User::listAll();

    $page = new PageAdmin();

    $page->setTpl("user", [
        'users'=>$user,
        'userError'=>User::getError(),
    ]);

});

$app->get('/administrador/usuario/cadastrar', function () {

    User::verifyLogin(1);

    $level = User::listAllLevel();

    $page = new PageAdmin();

    $page->setTpl("user-create", [
        'level'=>$level,
        'userError'=>User::getError(),
        'registerValuesUser'=>(isset($_SESSION['registerValuesUser'])) ? $_SESSION['registerValuesUser'] : ['registration'=>'', 'name'=>'', 'telephone'=>'', 'email'=>'', 'password'=>'', 'fk_level_access'=>'']
    ]);

});

$app->post('/administrador/usuario/cadastrar', function () {

    User::verifyLogin(1);

    $_SESSION['registerValuesUser'] = $_POST;

    if (mb_strlen($_POST['registration']) <= 4 || mb_strlen($_POST['registration']) >= 11) {
        User::setError("A matrícula deve ter entre 5 e 10 caracteres.");
        header('Location: /administrador/usuario/cadastrar');
        exit;
    }

    if (!preg_match('/\p{Lu}/u', $_POST['registration'])) {
        User::setError("A matricula deve ter pelo menos uma letra maiuscula");
        header('Location: /administrador/usuario/cadastrar');
        exit;
    }

    if (!preg_match('/\d+/', $_POST['registration'])>0 ){
        User::setError("A matricula deve ter pelo menos um número");
        header('Location: /administrador/usuario/cadastrar');
        exit;
    }

    if (!isset($_POST['registration']) || $_POST['registration'] == '') {
        User::setError("Preencha o campo matrícula");
        header('Location: /administrador/usuario/cadastrar');
        exit;
    }

    if (!isset($_POST['name']) || $_POST['name'] == '') {
        User::setError("Preencha o campo nome");
        header('Location: /administrador/usuario/cadastrar');
        exit;
    }

    if (!isset($_POST['telephone']) || $_POST['telephone'] == '') {
        User::setError("Preencha o campo telefone");
        header('Location: /administrador/usuario/cadastrar');
        exit;
    }

    if (!isset($_POST['email']) || $_POST['email'] == '') {
        User::setError("Preencha o campo e-mail");
        header('Location: /administrador/usuario/cadastrar');
        exit;
    }

    if (!isset($_POST['password']) || $_POST['password'] == '') {
        User::setError("Preencha o campo senha");
        header('Location: /administrador/usuario/cadastrar');
        exit;
    }

    $user = new User;

    $user->setData($_POST);

    $user->create();

    unset($_SESSION['registerValuesUser']);

    header("Location: /administrador/usuario");

    exit;

});

$app->get('/administrador/usuario/:id_user/alterar-senha', function ($id_user) {

    User::verifyLogin(1);

    $user = new User();

    $user->get((int)$id_user);

    $page = new PageAdmin();

    $page->setTpl("user-password-update", [
        'userError'=>User::getError(),
        'user'=>$user->getValues(),
        'registerValuesUser'=>(isset($_SESSION['registerValuesUser'])) ? $_SESSION['registerValuesUser'] : ['password'=>'']
    ]);

});

$app->post('/administrador/usuario/:id_user/alterar-senha', function ($id_user) {

    User::verifyLogin(1);

    $_SESSION['registerValuesUser'] = $_POST;

    if (!isset($_POST['password']) || $_POST['password'] == '') {
        User::setError("Preencha o campo nova senha");
        header("Location: /administrador/usuario/$id_user/alterar-senha");
        exit;
    }

    if (!isset($_POST['password_confirm']) || $_POST['password_confirm'] == '') {
        User::setError("Preencha o campo confirmar senha");
        header("Location: /administrador/usuario/$id_user/alterar-senha");
        exit;
    }

    if ($_POST['password'] !== $_POST['password_confirm']) {
        User::setError("Confirme corretamente as senhas");
        header("Location: /administrador/usuario/$id_user/alterar-senha");
        exit;
    }

    $user = new User();

    $user->get((int)$id_user);

    $user->updatePassword(User::getPasswordHash($_POST['password']));

    unset($_SESSION['registerValuesUser']);

    header("Location: /administrador/usuario");

    exit;

});

$app->get('/administrador/usuario/:id_user/deletar', function ($id_user) {

    User::verifyLogin(1);

    $user = new User();

    $user->get((int)$id_user);

    $user->delete();

    header("Location: /administrador/usuario");

    exit;

});

$app->get('/administrador/usuario/:id_user', function ($id_user) {

    User::verifyLogin(1);

    $user = new User();

    $level = User::listAllLevel();

    $user->get((int)$id_user);

    $page = new PageAdmin();

    $page->setTpl("user-update", array(
        'level'=>$level,
        'user'=>$user->getValues(),
        'userError'=>User::getError(),
        'registerValuesUser'=>(isset($_SESSION['registerValuesUser'])) ? $_SESSION['registerValuesUser'] : ['registration'=>'', 'name'=>'', 'telephone'=>'', 'email'=>'', 'fk_level_access'=>'']
    ));

});

$app->post('/administrador/usuario/:id_user', function ($id_user) {

    User::verifyLogin(1);

    $_SESSION['registerValuesUser'] = $_POST;

    if (!isset($_POST['registration']) || $_POST['registration'] == '') {
        User::setError("Preencha o campo matrícula");
        header("Location: /administrador/usuario/$id_user");
        exit;
    }

    if (!isset($_POST['name']) || $_POST['name'] == '') {
        User::setError("Preencha o campo nome");
        header("Location: /administrador/usuario/$id_user");
        exit;
    }

    if (!isset($_POST['telephone']) || $_POST['telephone'] == '') {
        User::setError("Preencha o campo telefone");
        header("Location: /administrador/usuario/$id_user");
        exit;
    }

    if (!isset($_POST['email']) || $_POST['email'] == '') {
        User::setError("Preencha o campo e-mail");
        header("Location: /administrador/usuario/$id_user");
        exit;
    }

    $user = new User();

    $user->get((int)$id_user);

    $user->setData($_POST);

    $user->update();

    unset($_SESSION['registerValuesUser']);

    header("Location: /administrador/usuario");

    exit;

});