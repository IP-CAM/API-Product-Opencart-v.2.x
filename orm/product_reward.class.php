<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 14:02
 */

class Product_reward extends DB{
    public $product_reward_id = 551;
    public $product_id = 0;
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

    function tryClearCrap()
    {
        $product_table = DB_PREFIX.'product';
        $q = "SELECT COUNT(*) c_p, (SELECT COUNT(*) FROM {$this->table}) as c_r FROM {$product_table}";
        $this->query($q);
        $res = $this->query($q);
        $row = $res->fetch_assoc();
        if($row['c_p'] != $row['c_r'])
        {
            $q = " DELETE FROM ".$this->table." WHERE product_id NOT IN( SELECT product_id FROM $product_table)";
            $this->query($q);
        }
    }
}