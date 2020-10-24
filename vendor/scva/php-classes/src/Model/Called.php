<?php


namespace SCVA\Model;

use \SCVA\DB\Sql;
use SCVA\Model;

class Called extends Model
{

    public function get($id_called)
    {

        $sql = new Sql();

        $results = $sql->select("select * from called a
                                           left join grupos b
                                           on a.fk_group = b.id_group
                                           left join status c                                     
                                           on a.fk_status = c.id_status 
                                           left join valves d 
                                           on b.fk_valve = d.id_valve
                                           where a.id_called = :id_called",
            array(
                ":id_called"=>$id_called
            ));

        $data = $results[0];

        $data['name'] = utf8_encode($data['name']);
        $data['description'] = utf8_encode($data['description']);

        $data['name'] = utf8_decode($data['name']);
        $data['description'] = utf8_decode($data['description']);

        $this->setData($data);

    }

    public function create()
    {

        $sql = new Sql();

        $registration = getUserRegistration();
        $name = getUserName();

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y/m/d H:i:s');

        $sql->select("CALL P020_CALLED_CREATE (:registration, :name, :update_date, :fk_group, :description)",[
            ":registration"=>$registration,
            ":name"=>$name,
            ':update_date'=>$date,
            ":fk_group"=>$this->getfk_group(),
            ":description"=>$this->getdescription()
        ]);

        User::setError("Chamado cadastrado com sucesso!");
        header('Location: /tecnico/chamados');

    }

    public function update()
    {

        $sql = new Sql();

        $sql->select("CALL P021_CALLED_UPDATE (:id_called, :fk_group, :description, :fk_status)", [
            ":id_called"=>$this->getid_called(),
            ":fk_group"=>$this->getfk_group(),
            ":description"=>$this->getdescription(),
            ":fk_status"=>$this->getfk_status()
        ]);

        User::setError("Chamado alterado com sucesso!");
        header('Location: /tecnico/chamados');

    }

    public function delete() {

        $sql = new Sql();

        $sql->query("CALL P022_CALLED_DELETE (:id_called)", [
            ":id_called"=>$this->getid_called(),
        ]);

        User::setError("Chamado deletado com sucesso!");
        header('Location: /tecnico/chamados');

    }

    public function updateStatus()
    {

        $sql = new Sql();

        $status = 2;

        $sql->select("CALL P023_CALLED_UPDATE_STATUS (:id_called, :fk_status)", [
            ":id_called"=>$this->getid_called(),
            ":fk_status"=>$status
        ]);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $sql->query("insert into answers (fk_called, answer) value(:fk_called, :answer)",
            [
                ":answer" => $dados["answer"],
                ":fk_called" => $dados["id_called"]
            ]);

    }

    public static function listAll()
    {

        $sql = new Sql();

        $results = $sql->select("select * from called a
                                           inner join grupos b
                                           on a.fk_group = b.id_group
                                           inner join status c
                                           on a.fk_status = c.id_status
                                           order by a.update_date");

        return $results;

    }

    public static function listAllOperador()
    {

        $sql = new Sql();

        $results = $sql->select("select * from called a
                                           inner join grupos b
                                           on a.fk_group = b.id_group
                                           inner join status c
                                           on a.fk_status = c.id_status
                                           where not exists (
                                            select * from status
                                            where c.id_status = 2
                                           )
                                           order by a.update_date
                                           ");

        return $results;

    }


    public static function listAllGroup()
    {
        $sql = new Sql();

        return $sql->select("select * from grupos");
    }

    public static function listAllStatus()
    {
        $sql = new Sql();

        return $sql->select("select * from status");
    }

}