<?php

namespace SCVA\Model;

use \SCVA\DB\Sql;
use \SCVA\Model;

class Valve extends Model
{

    public function get($id_valve)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM valves WHERE id_valve = :id_valve",
            array(
                "id_valve" => $id_valve
            ));

        $data = $results[0];

        $data['valve'] = utf8_encode($data['valve']);

        $data['valve'] = utf8_decode($data['valve']);

        $this->setData($data);

    }

    public function create()
    {

        $sql = new Sql();

        $sql->select("CALL P008_VALVE_CREATE (:valve)", array(
            ":valve" => $this->getvalve()
        ));

        User::setError("Valvula cadastrada com sucesso!");
        header('Location: /administrador/valvula');

    }

    public function update()
    {

        $sql = new Sql();

        $sql->select("CALL P009_VALVE_UPDATE (:id_valve, :valve)", array(
            ":id_valve" => $this->getid_valve(),
            ":valve" => $this->getvalve()
        ));

        User::setError("Valvula atualizada com sucesso!");
        header('Location: /administrador/valvula');

    }

    public function delete()
    {

        $sql = new Sql();

        $sql->query("CALL P010_VALVE_DELETE (:id_valve)", array(
            ":id_valve" => $this->getid_valve()
        ));

        User::setError("Valvula deletada com sucesso!");
        header('Location: /administrador/valvula');

    }

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM valves ORDER BY id_valve");

    }

    public static function check_linked_group($id_valve)
    {

        $sql = new Sql();

        return $sql->select("select * from grupos
                                where fk_valve = :id_valve",
            array(
                ':id_valve' => $id_valve
            ));

    }

}