<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 14:03
 */
class Product_to_category extends DB{
    public $product_id=3;
    public $category_id=38;
    public $main_category=1;

    public $table = 'product_to_category';

    function __construct(){
        parent::__construct();
        $this->table=DB_PREFIX.$this->table;
    }

    public function create(){
        $q = sprintf("INSERT INTO ".$this->table." (
            product_id,
            category_id,
            main_category
        ) VALUES (%d,%d,%d);",
            $this->product_id,
            $this->category_id,
            $this->main_category
        );
        $this->query($q);
    }
}

