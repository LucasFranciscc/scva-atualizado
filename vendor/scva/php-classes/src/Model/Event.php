<?php

namespace SCVA\Model;

use \SCVA\DB\Sql;
use \SCVA\Model;

class Event extends Model {

    public function get($id_events) {

        $sql = new Sql();

        $results = $sql->select("SELECT * from events A
                                           LEFT JOIN grupos B
                                           ON A.fk_group = B.id_group
                                           LEFT JOIN valves C 
                                           ON B.fk_valve = C.id_valve
                                           LEFT JOIN group_region D
                                           ON B.id_group = D.fk_group
                                           WHERE A.id_events = :id_events",
            array(
                ":id_events"=>$id_events
            ));

        $data = $results[0];

        $data['title'] = utf8_encode($data['title']);

        $data['title'] = utf8_decode($data['title']);

        $this->setData($data);

    }

    public function create() {

        $sql = new Sql();

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $data_start = str_replace('/', '-', $dados['start']);
        $data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

        $data_end = str_replace('/', '-', $dados['end']);
        $data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

        $sql->select("CALL P016_EVENTS_CREATE (:title, :fk_group, :color, :start, :end)", [
            ":title"=>$this->gettitle(),
            ":fk_group"=>$this->getfk_group(),
            ":color"=>$this->getcolor(),
            ":start"=>$data_start_conv,
            ":end"=>$data_end_conv
        ]);

        User::setError("Evento cadastrado com sucesso!");
        header('Location: /administrador');

    }

    public function update_status() {

        $sql = new Sql();

        $status = $this->getstatus();

        if ($status == 1) {
            $sql->select("CALL P017_EVENTS_START_UPDATE (:id_events, :status)", [
                ":id_events"=>$this->getid_events(),
                ":status"=> 0
            ]);
        }
        else if ($status == 0) {
            $sql->select("CALL P017_EVENTS_START_UPDATE (:id_events, :status)", [
                ":id_events"=>$this->getid_events(),
                ":status"=> 1
            ]);
        }

    }

    public function update() {

        $sql = new Sql();

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $data_start = str_replace('/', '-', $dados['start']);
        $data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

        $data_end = str_replace('/', '-', $dados['end']);
        $data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

        $sql->select("CALL P018_EVENTS_UPDATE (:id_events, :title, :fk_group, :color, :start, :end)", [
            ":id_events"=>$this->getid_events(),
            ":title"=>$this->gettitle(),
            ":fk_group"=>$this->getfk_group(),
            ":color"=>$this->getcolor(),
            ":start"=>$data_start_conv,
            ":end"=>$data_end_conv
        ]);

        User::setError("Evento alterado com sucesso!");
        header('Location: /administrador');

    }

    public function deletar() {

        $sql = new Sql();

        $sql->query("CALL P019_EVENTS_DELETAR (:id_events)", [
            ":id_events"=>$this->getid_events(),
        ]);

        User::setError("Evento deletado com sucesso!");
        header('Location: /administrador');

    }

    public static function listAllGroup() {

        $sql = new Sql();

        return $sql->select("SELECT * FROM grupos");

    }

}