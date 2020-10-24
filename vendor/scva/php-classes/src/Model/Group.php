<?php

namespace SCVA\Model;

use \SCVA\DB\Sql;
use \SCVA\Model;

class Group extends Model {

    public function get($id_group) {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM grupos A 
                                            LEFT JOIN valves B
                                            ON A.fk_valve = B.id_valve 
                                            LEFT JOIN group_region C
                                            ON C.fk_group = A.id_group
                                            LEFT JOIN regions D
                                            ON D.id_region = C.fk_region
                                            WHERE A.id_group = :id_group",
            array(
                "id_group"=>$id_group
            ));

        $data = $results[0];


        $this->setData($data);

    }

    public function create() {

        $sql = new Sql();

        $sql->select("CALL P011_GROUP_CREATE (:_grupo, :fk_valve)", array(
            ":_grupo"=>$this->get_grupo(),
            ":fk_valve"=>$this->getfk_valve()
        ));

        User::setError("grupo cadastrado com sucesso!");
        header('Location: /administrador/grupo');

    }

    public function update() {

        $sql = new Sql();

        $sql->select("CALL P012_GROUP_UPDATE (:id_group, :_grupo, :fk_valve)", array(
            ":id_group"=>$this->getid_group(),
            ":_grupo"=>$this->get_grupo(),
            ":fk_valve"=>$this->getfk_valve()
        ));

        User::setError("grupo alterado com sucesso!");
        header('Location: /administrador/grupo');

    }

    public function delete() {

        $sql = new Sql();

        $sql->query("CALL P013_GROUP_DELETE (:id_group)", array(
            ":id_group"=>$this->getid_group()
        ));

        User::setError("grupo deletado com sucesso!");
        header('Location: /administrador/grupo');

    }

    public function getRegionLinked() {

        $sql = new Sql();

        $result = $sql->select("
            select * from regions a
            inner join group_region b
            on b.fk_region = a.id_region
            where b.fk_group = :fk_group ", [
            ':fk_group'=>$this->getfk_group()
        ]);

        return $result;

    }

    public function getRegionNotLinked() {

        $sql = new Sql();

        $result = $sql->select("
        select * from regions
        where not exists
        (select * from group_region
        where fk_region = id_region )");

        return $result;

    }

    public function add_Group_Region(Region $region) {

        $sql = new Sql();

        $sql->select("CALL P014_ADD_REGION (:fk_group, :fk_region)", array(
            ":fk_group"=>$this->getid_group(),
            ":fk_region"=>$region->getid_region()
        ));

    }

    public function remove_Group_Region(Region $region) {

        $sql = new Sql();

        $sql->select("CALL P015_REMOVE_REGION (:fk_group, :fk_region)", array(
            ":fk_group"=>$this->getid_group(),
            ":fk_region"=>$region->getid_region()
        ));

    }

    public static function listAllValve() {

        $sql = new Sql();

        return $sql->select("SELECT * FROM valves");

    }

    public static function listAll() {

        $sql = new Sql();

        return $sql->select("SELECT * FROM grupos A 
                                       INNER JOIN valves B
                                       ON A.fk_valve = B.id_valve 
                                       ORDER BY id_group");

    }

    public static function check_linked_region($id_group) {

        $sql = new Sql();

        return $sql->select("select * from group_region
                                        where fk_group = :id_group",
            array(
                ':id_group'=>$id_group
            ));

    }

    public static function check_linked_event($id_group) {

        $sql = new Sql();

        return $sql->select("select * from events
                                        where fk_group = :id_group",
            array(
                ':id_group'=>$id_group
            ));

    }

    public static function check_linked_called($id_group) {

        $sql = new Sql();

        return $sql->select("select * from called
                                        where fk_group = :id_group",
            array(
                ':id_group'=>$id_group
            ));

    }

}