<?php

use \SCVA\PageAdmin;
use \SCVA\Model\Group;
use \SCVA\Model\User;
use \SCVA\Model\Region;

$app->get('/administrador/grupo', function () {

    User::verifyLogin(1);

    $group = Group::listAll();

    $page = new PageAdmin();

    $page->setTpl("group", [
        'group' => $group,
        'groupError' => User::getError()
    ]);

});

$app->get('/administrador/grupo/cadastrar', function () {

    User::verifyLogin(1);

    $valve = Group::listAllValve();

    $page = new PageAdmin();

    $page->setTpl("group-create", [
        'valve' => $valve,
        'groupError' => User::getError()
    ]);

});

$app->post('/administrador/grupo/cadastrar', function () {

    User::verifyLogin(1);

    $sql = new \SCVA\DB\Sql();
    $groups = $sql->select("select * from grupos where _grupo = :grupo", [":grupo" => $_POST["_grupo"]]);

    if (!isset($_POST['_grupo']) || $_POST['_grupo'] == '') {
        User::setError("Preencha o campo grupo");
        header('Location: /administrador/grupo/cadastrar');
        exit;
    }

    if ($groups) {
        User::setError("Esse grupo já foi cadastrado");
        header('Location: /administrador/grupo/cadastrar');
        exit;
    }

    $group = new Group();

    $group->setData($_POST);

    $group->create();

    header("Location: /administrador/grupo");

    exit;

});

$app->get('/administrador/grupo/:id_group/deletar', function ($id_group) {

    User::verifyLogin(1);

    $group_region = Group::check_linked_region($id_group);

    $group_event = Group::check_linked_event($id_group);

    $group_called = Group::check_linked_called($id_group);

    if ($group_called != null) {

        User::setError("O grupo não pode ser excluida, por que existe chamados vinculados a ele.");
        header('Location: /administrador/grupo');
        exit;

    } elseif ($group_event != null) {

        User::setError("O grupo não pode ser excluida, por que existe eventos vinculados a ele.");
        header('Location: /administrador/grupo');
        exit;

    } elseif ($group_region != null) {

        User::setError("O grupo não pode ser excluida, por que existe regiões vinculadas a ele.");
        header('Location: /administrador/grupo');
        exit;

    } else {

        $group = new Group();

        $group->get((int)$id_group);

        $group->delete();

        header("Location: /administrador/grupo");

        exit;

    }


});

$app->get('/administrador/grupo/:id_group', function ($id_group) {

    User::verifyLogin(1);

    $group = new Group();

    $valve = Group::listAllValve();

    $group->get((int)$id_group);

    $page = new PageAdmin();

    $page->setTpl("group-update", [
        'valve' => $valve,
        'group' => $group->getValues(),
        'groupError' => User::getError()
    ]);

});

$app->post('/administrador/grupo/:id_group', function ($id_group) {

    User::verifyLogin(1);

    $group = new Group();

    $group->get((int)$id_group);

    $group->setData($_POST);

    $group->update();

    header("Location: /administrador/grupo");

    exit;

});

$app->get('/administrador/grupo/:id_group/regiao', function ($id_group) {

    User::verifyLogin(1);

    $group = new Group();

    $group->get((int)$id_group);

    $page = new PageAdmin();

    $page->setTpl("group-region", [
        'group' => $group->getValues(),
        'groupName' => $group->getValues(),
        'regionLinked' => $group->getRegionLinked(),
        'regionNotLinked' => $group->getRegionNotLinked()
    ]);

});

$app->get('/administrador/grupo/:fk_group/regiao/:fk_region/adicionar', function ($fk_group, $fk_region) {

    User::verifyLogin(1);

    $group = new Group();

    $group->get((int)$fk_group);

    $region = new Region();

    $region->get((int)$fk_region);

    $group->add_Group_Region($region);

    header("Location: /administrador/grupo/" . $fk_group . "/regiao");

    exit;

});

$app->get('/administrador/grupo/:fk_group/regiao/:fk_region/remover', function ($fk_group, $fk_region) {

    User::verifyLogin(1);

    $group = new Group();

    $group->get((int)$fk_group);

    $region = new Region();

    $region->get((int)$fk_region);

    $group->remove_Group_Region($region);

    header("Location: /administrador/grupo/" . $fk_group . "/regiao");

    exit;

});