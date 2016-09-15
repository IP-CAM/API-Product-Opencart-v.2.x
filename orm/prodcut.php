<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 14:01
 */
class Product extends DB{
    public $product_id=3;
    public $model='novii-pokemon-002';
    public $sku='super-art-0002';
    public $upc='';
    public $ean='';
    public $jan='';
    public $isbn='';
    public $mpn='';
    public $location='';
    public $quantity=1;
    public $stock_status_id=5;
    public $image='data/pokemon2.jpeg';
    public $manufacturer_id=0;
    public $shipping=1;
    public $price=0.0000;
    public $points=0;
    public $tax_class_id=0;
    public $date_available='2016-09-13';
    public $weight=0.00000000;
    public $weight_class_id=1;
    public $length=0.00000000;
    public $width=0.00000000;
    public $height=0.00000000;
    public $length_class_id=1;
    public $subtract=1;
    public $minimum=1;
    public $sort_order=1;
    public $status=1;
    public $date_added = '2016-09-14 10:01:44';
    public $date_modified='0000-00-00 00:00:00';
    public $viewed=0;

    public $table = 'product';

    function __construct(){
        parent::__construct();
        $this->table=DB_PREFIX.$this->table;
    }

    public function create(){
        $q = sprintf("INSERT INTO ".$this->table." (
            model,
            sku,
            upc,
            ean,
            jan,
            isbn,
            mpn,
            location,
            quantity,
            stock_status_id,
            image,
            manufacturer_id,
            shipping,
            price,
            points,
            tax_class_id,
            date_available,
            weight,
            weight_class_id,
            length,
            width,
            height,
            length_class_id,
            subtract,
            minimum,
            sort_order,
            status,
            date_added,
            date_modified,
            viewed
        ) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s',%d,%d,'%s',%d,%d,%01.4f,%d,%d,'%s',%01.8f,%d,%01.8f,%01.8f,%01.8f,%d,%d,%d,%d,%d,'%s','%s',%d);",
            $this->model,
            $this->sku,
            $this->upc,
            $this->ean,
            $this->jan,
            $this->isbn,
            $this->mpn,
            $this->location,
            $this->quantity,
            $this->stock_status_id,
            $this->image,
            $this->manufacturer_id,
            $this->shipping,
            $this->price,
            $this->points,
            $this->tax_class_id,
            $this->date_available,
            $this->weight,
            $this->weight_class_id,
            $this->length,
            $this->width,
            $this->height,
            $this->length_class_id,
            $this->subtract,
            $this->minimum,
            $this->sort_order,
            $this->status,
            $this->date_added,
            $this->date_modified,
            $this->viewed
        );
        $this->query($q);
    }
}

