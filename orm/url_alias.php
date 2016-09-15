<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 14:04
 */
class Url_alias extends DB{
    public $url_alias_id=864;
    public $query  ='product_id=3';
    public $keyword='novij-pokemon';
    public $seomanager=0;

    public $table = 'url_alias';

    function __construct(){
        parent::__construct();
        $this->table=DB_PREFIX.$this->table;
    }

    public function create(){
        $q = sprintf("INSERT INTO ".$this->table." (
            query,
            keyword,
            seomanager
        ) VALUES ('%s','%s',%d);",
            $this->query,
            $this->keyword,
            $this->seomanager
        );
        $this->query($q);
    }
}
