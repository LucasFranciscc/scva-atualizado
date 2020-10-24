<?php

namespace SCVA\Model;

use \SCVA\DB\Sql;
use \SCVA\Model;

class User extends Model
{

    const SESSION = "User";
    const ERROR_USER = "UserError";

    public static function getFromSession()
    {

        $user = new User();

        if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['id_user'] > 0) {
            $user->setData($_SESSION[User::SESSION]);
        }
        return $user;

    }

    public static function checkLogin($idlvaccess = true)
    {

        if (
            !isset($_SESSION[User::SESSION])
            ||
            !$_SESSION[User::SESSION]
            ||
            !(int)$_SESSION[User::SESSION]["id_user"] > 0
        ) {
            return false;
        } else {
            if ($idlvaccess == $_SESSION[User::SESSION]['fk_level_access']) {
                return true;
            } else {
                return false;
            }
        }

    }

    public static function login($login, $password)
    {

        $sql = new Sql();

        $results = $sql->select("select * from users where registration = :REGISTRATION", array(":REGISTRATION" => $login
        ));

        if (count($results) === 0) {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }
        $data = $results[0];
        if (password_verify($password, $data["password"]) === true) {
            $user = new User();
            $data['name'] = utf8_encode($data['name']);
            $user->setData($data);
            $_SESSION[User::SESSION] = $user->getValues();
            return $user;
        } else {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }

    }

    public static function verifyLogin($access, $idlvaccess = true)
    {

        if (!User::checkLogin($access)) {
            if ($idlvaccess) {
                header("Location: /");
            } else {
                header("Location: /");
            }
            exit;
        }
    }

    public static function logout()
    {

        $_SESSION[User::SESSION] = null;
    }

    public function get($id_user)
    {

        $sql = new Sql();

        $results = $sql->select("select id_user, registration, name, telephone, email, password, id_level_access, level from users a 
        inner join level_access b 
        on a.fk_level_access = b.id_level_access
        where a.id_user = :id_user",
            array(
                "id_user" => $id_user
            ));

        $data = $results[0];

        $data['name'] = utf8_encode($data['name']);
        $data['level'] = utf8_encode($data['level']);

        $data['name'] = utf8_decode($data['name']);
        $data['level'] = utf8_decode($data['level']);

        $this->setData($data);


    }

    public function create()
    {
        $sql = new Sql();

//        $administrador = "ADM";
//        $tecnico = "TEC";
//        $operador = "OPR";
//
        $matricula = $this->getregistration();
        $level = $this->getfk_level_access();
//
//        if ($level == 1) {
//            $levelaccess = $administrador;
//        } elseif ($level == 2) {
//            $levelaccess = $tecnico;
//        } else {
//            $levelaccess = $operador;
//        }

        $userFind = $sql->select("select * from users where registration = :registration", [
            ":registration" => $matricula
        ]);

        if ($userFind) {
            User::setError("A matrícula " . $matricula . " já foi cadastrada!");
            header('Location: /administrador/usuario/cadastrar');
            exit;
        }

        $sql->select("CALL P001_USERS_CREATE(:registration, :name, :telephone, :email, :password, :fk_level_access)", array(
            ":registration" => $matricula,
            ":name" => $this->getname(),
            ":telephone" => $this->gettelephone(),
            ":email" => $this->getemail(),
            ":password" => User::getPasswordHash($this->getpassword()),
            ":fk_level_access" => $this->getfk_level_access()
        ));


        User::setError("Usuário cadastrado com sucesso!");
        header('Location: /administrador/usuario');


    }

    public function update()
    {

        $sql = new Sql();

        $administrador = "ADM";
        $tecnico = "TEC";
        $operador = "OPR";

        $matricula = $this->getregistration();
        $matriculaSeparada = str_split($matricula, 3);
        $level = $this->getfk_level_access();

        if ($level == 1) {
            if ($matriculaSeparada[0] == "ADM") {
                $sql->select("CALL P002_USERS_UPDATE (:id_user, :registration, :name, :telephone, :email, :fk_level_access)", array(
                    ":id_user" => $this->getid_user(),
                    ":registration" => $this->getregistration(),
                    ":name" => $this->getname(),
                    ":telephone" => $this->gettelephone(),
                    ":email" => $this->getemail(),
                    ":fk_level_access" => $this->getfk_level_access()
                ));
            }
            if ($matriculaSeparada[0] == "TEC" or $matriculaSeparada[0] == "OPR") {
                $sql->select("CALL P002_USERS_UPDATE (:id_user, :registration, :name, :telephone, :email, :fk_level_access)", array(
                    ":id_user" => $this->getid_user(),
                    ":registration" => $administrador . $matriculaSeparada[1],
                    ":name" => $this->getname(),
                    ":telephone" => $this->gettelephone(),
                    ":email" => $this->getemail(),
                    ":fk_level_access" => $this->getfk_level_access()
                ));
            }
        }

        if ($level == 2) {
            if ($matriculaSeparada[0] == 'TEC') {
                $sql->select("CALL P002_USERS_UPDATE (:id_user, :registration, :name, :telephone, :email, :fk_level_access)", array(
                    ":id_user" => $this->getid_user(),
                    ":registration" => $this->getregistration(),
                    ":name" => $this->getname(),
                    ":telephone" => $this->gettelephone(),
                    ":email" => $this->getemail(),
                    ":fk_level_access" => $this->getfk_level_access()
                ));
            }
            if ($matriculaSeparada[0] == 'ADM' or $matriculaSeparada[0] == 'OPR') {
                $sql->select("CALL P002_USERS_UPDATE (:id_user, :registration, :name, :telephone, :email, :fk_level_access)", array(
                    ":id_user" => $this->getid_user(),
                    ":registration" => $tecnico . $matriculaSeparada[1],
                    ":name" => $this->getname(),
                    ":telephone" => $this->gettelephone(),
                    ":email" => $this->getemail(),
                    ":fk_level_access" => $this->getfk_level_access()
                ));
            }
        }

        if ($level == 3) {
            if ($matriculaSeparada[0] == "OPR") {
                $sql->select("CALL P002_USERS_UPDATE (:id_user, :registration, :name, :telephone, :email, :fk_level_access)", array(
                    ":id_user" => $this->getid_user(),
                    ":registration" => $this->getregistration(),
                    ":name" => $this->getname(),
                    ":telephone" => $this->gettelephone(),
                    ":email" => $this->getemail(),
                    ":fk_level_access" => $this->getfk_level_access()
                ));
            }
            if ($matriculaSeparada[0] == "ADM" or $matriculaSeparada[0] == "TEC") {
                $sql->select("CALL P002_USERS_UPDATE (:id_user, :registration, :name, :telephone, :email, :fk_level_access)", array(
                    ":id_user" => $this->getid_user(),
                    ":registration" => $operador . $matriculaSeparada[1],
                    ":name" => $this->getname(),
                    ":telephone" => $this->gettelephone(),
                    ":email" => $this->getemail(),
                    ":fk_level_access" => $this->getfk_level_access()
                ));
            }
        }

        User::setError("Usuário alterado com sucesso!");
        header('Location: /administrador/usuario');

    }

    public function delete()
    {

        $sql = new Sql();

        $sql->query("CALL P003_USERS_DELETE(:id_user)", array(
            ":id_user" => $this->getid_user(),
        ));

        User::setError("Usuário excluído com sucesso!");
        header('Location: /administrador/usuario');

    }

    public function updatePassword($password)
    {

        $sql = new Sql();

        $sql->select("CALL P004_USERS_PASSWORD_UPDATE (:id_user, :password)", array(
            ":id_user" => $this->getid_user(),
            ":password" => $password
        ));

    }

    public static function getPasswordHash($password)
    {

        return password_hash($password, PASSWORD_DEFAULT, [
            'cost' => 12
        ]);

    }

    public static function listAllLevel()
    {

        $sql = new Sql();

        return $sql->select("select * from level_access");
    }

    public static function listAll()
    {

        $sql = new Sql();

        $results = $sql->select("SELECT id_user, registration, name, telephone, email, fk_level_access, id_level_access, level
                                FROM users A
                                INNER JOIN level_access B
                                ON A.fk_level_access = b.id_level_access
                                ORDER BY A.id_user");

        return $results;

    }

    public static function setError($msg)
    {

        $_SESSION[User::ERROR_USER] = $msg;

    }

    public static function getError()
    {
        $msg = (isset($_SESSION[User::ERROR_USER]) && $_SESSION[User::ERROR_USER]) ? $_SESSION[User::ERROR_USER] : '';

        User::clearError();

        return $msg;
    }

    public static function clearError()
    {

        $_SESSION[User::ERROR_USER] = NULL;

    }

}