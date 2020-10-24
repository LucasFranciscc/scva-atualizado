<?php

namespace SCVA\Model;

use \SCVA\DB\Sql;
use \SCVA\Model;

class Region extends Model {

    public function get($id_region) {

        $sql = new Sql();

        $results = $sql->select("select id_region, region from regions where id_region = :id_region",
            array(
                "id_region"=>$id_region
            ));

        $data = $results[0];

        $data['region'] = utf8_encode($data['region']);

        $data['region'] = utf8_decode($data['region']);

        $this->setData($data);

    }

    public function create() {

        $sql = new Sql();

        $sql ->select("CALL P005_REGION_CREATE(:region)", array(
            ":region"=>$this->getregion()
        ));

        User::setError("Região cadastrada com sucesso!");
        header('Location: /administrador/regiao');

    }

    public function update() {

        $sql = new Sql();

        $sql->select("CALL P006_REGION_UPDATE (:id_region, :region)", array(
            ':id_region'=>$this->getid_region(),
            ':region'=>$this->getregion()
        ));

        User::setError("Região editada com sucesso!");
        header('Location: /administrador/regiao');

    }

    public function delete() {

        $sql = new Sql();

        $sql->query("CALL P007_REGION_DELETE (:id_region)", array(
            ':id_region'=>$this->getid_region()
        ));

        User::setError("Região deletada com sucesso!");
        header('Location: /administrador/regiao');

    }

    public static function listAll() {

        $sql = new Sql();

        return $sql->select("SELECT * FROM regions ORDER BY id_region");

    }

}