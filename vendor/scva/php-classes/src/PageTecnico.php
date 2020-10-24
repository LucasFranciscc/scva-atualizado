<?php

namespace SCVA;

class PageTecnico extends PageAdmin {

    public function __construct(array $opts = array(), $tpl_dir = "/views/tecnico/")
    {
        parent::__construct($opts, $tpl_dir);
    }

}