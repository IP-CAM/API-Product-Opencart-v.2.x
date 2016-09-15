<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 14:02
 */

class Product_reward extends DB{
    public $product_reward_id = 551;
    public $product_id = 3;
    public $customer_group_id = 1;
    public $points = 0;

    public $table = 'product_reward';

    function __construct(){
        parent::__construct();
        $this->table=DB_PREFIX.$this->table;
    }

    public function create(){
        $q = sprintf("INSERT INTO ".$this->table." (
            product_id,
            customer_group_id,
            points
        ) VALUES (%d,%d,%d);",
            $this->product_id,
            $this->customer_group_id,
            $this->points
        );
        $this->query($q);
    }
}