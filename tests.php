<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 15:47
 */

require 'config.php';
require 'db.php';

$a_files = scandir(__DIR__. '/orm');
foreach($a_files as $file){
    $p = __DIR__. "/orm/$file";
    if(!is_file($p)) continue;
    require $p;
}

/*
$P = new Product();
$P->create();
*/

/*
$P_t_c = new Product_to_category();
$P_t_c->product_id = 34;
$P_t_c->create();
*/

/*
$P_d = new Product_description();
$P_d->product_id = 34;
$P_d->create();
*/

/*
$P_r = new Product_reward();
$P_r->create();
*/

/*
$P_t_s = new Product_to_store();
$P_t_s->product_id=33;
$P_t_s->create();
*/
/*
$U_a = new Url_alias();
$U_a->create();
*/
