<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 14:03
 */
class Product_to_store extends DB{
    public $product_id=3;
    public $store_id=0;

    public $table = 'product_to_store';

    function __construct(){
        parent::__construct();
        $this->table=DB_PREFIX.$this->table;
    }

    public function create(){
        $q = sprintf("INSERT INTO ".$this->table." (
            product_id,
            store_id
        ) VALUES (%d,%d);",
            $this->product_id,
            $this->store_id
        );
        $this->query($q);
    }
}