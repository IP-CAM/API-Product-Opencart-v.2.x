<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 14:02
 */

class Product_description extends DB{

    public $product_id=3;
    public $language_id=1;
    public $name='Новый покемон';
    public $description='&lt;p&gt;Основное описание - новый покемон&lt;/p&gt;\r\n';
    public $description_mini='&lt;p&gt;Краткое описание - новый покемон&lt;/p&gt;\r\n';
    public $meta_description='';
    public $meta_keyword='';
    public $seo_title='';
    public $seo_h1='';
    public $tag='';
    public $meta_title='NULL';

    public $table = 'product_description';

    function __construct(){
        parent::__construct();
        $this->table=DB_PREFIX.$this->table;
    }

    public function create(){
        $q = sprintf("INSERT INTO ".$this->table." (
            product_id,
            language_id,
            name,
            description,
            description_mini,
            meta_description,
            meta_keyword,
            seo_title,
            seo_h1,
            tag,
            meta_title
        ) VALUES (%d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %s);",
            $this->product_id,
            $this->language_id,
            $this->name,
            $this->description,
            $this->description_mini,
            $this->meta_description,
            $this->meta_keyword,
            $this->seo_title,
            $this->seo_h1,
            $this->tag,
            $this->meta_title
        );
        $this->query($q);
    }
}


