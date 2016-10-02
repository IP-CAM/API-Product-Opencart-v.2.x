<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 15:45
 */
class Product_manager extends DB{
    private $AnimeStarWalker;

    public function __construct()
    {
        parent::__construct();
    }

    public function setAnimeStarWalker($AnimeStarWalker){
        $this->AnimeStarWalker = $AnimeStarWalker;
    }

    public function load(Donor\Product $DonorProduct)
    {
        $Product = new Product();
        $Product->sku = $DonorProduct->id;
		$Product->model = $DonorProduct->model;		
        $Product->date_modified = date("Y-m-d H:i:s", time());
        $Product->price = sprintf("%01.4f", round($DonorProduct->price*KOEF_FOR_PRICE*USD_RUB));
        $product_id = $Product->getProductIdBySku();

        if($product_id){
            // update
echo "update sku=$Product->sku\n";
            $Product->product_id = $product_id;
            $Product->update();

        }else{
echo "insert sku=$Product->sku\n";
            //insert

            $html = $this->AnimeStarWalker->getPage($DonorProduct->url);
            $DonorProduct->parseFullHtml($html);

            if(strlen($DonorProduct->img_url))
            {
                $img_info = pathinfo($DonorProduct->img_url);
                $Product->image = 'data/'.$Product->sku.'.'.$img_info['extension'];
                $pic_path = PATH_TO_ROOT_OPENCART_SCRIPT.'image/'.$Product->image;

                $i=0;
                while(1){
                    if(++$i>20) { echo "can't upload {$DonorProduct->img_url} for sku: {$Product->sku}\n";  break; }
                    if (copy($DonorProduct->img_url,  $pic_path)) break;
                    sleep($i);
                    echo "can't upload {$DonorProduct->img_url}, will try again ... \n";
                }
                chmod($pic_path, 0755);
            }

            $P_d = new Product_description();
            $P_d->name = $DonorProduct->name;
            $P_d->description = $DonorProduct->description;
            $P_d->description_mini = $DonorProduct->description;

            $Product->date_added = $Product->date_modified;
            $Product->date_available = date("Y-m-d", time());
            $Product->create();
            $product_id = $Product->product_id;

            $P_t_c = new Product_to_category();
            $P_t_c->product_id  = $product_id;
            $P_t_c->category_id = $DonorProduct->our_cate_id;
            $P_t_c->create();

            $P_d->product_id = $product_id;
            $P_d->create();

            $P_r = new Product_reward();
            $P_r->product_id = $product_id;
            $P_r->create();

            $P_t_s = new Product_to_store();
            $P_t_s->product_id = $product_id;
            $P_t_s->create();

            $U_a = new Url_alias();
            $U_a->query   = 'product_id='.$product_id;
            $U_a->keyword = $DonorProduct->alias_for_graceful_url;
            $U_a->create();
        }
    }

    function createThumb($path_src, $path_new, $size_x, $size_y)
    {
        $img = new abeautifulsite\SimpleImage($path_src);
        $img->best_fit($size_x, $size_y)->save($path_new);
    }

    public function setZeroDateModifiedForAllProducts()
    {
echo "setZeroDateModifiedForAllProducts()\n";
        $tbl_product = DB_PREFIX.'product';
        $this->query("UPDATE $tbl_product SET date_modified='0000-00-00 00:00:00' WHERE sku!=''");
    }
    public function deleteProductWithZeroDateModified()
    {
echo "deleteProductWithZeroDateModified()\n";
        $tbl_product = DB_PREFIX.'product';
        $base_select = " SELECT product_id FROM $tbl_product WHERE date_modified='0000-00-00 00:00:00' AND sku!='' ";

        $table = DB_PREFIX.'url_alias';
        $q = " DELETE FROM $table WHERE query IN ( SELECT CONCAT('product_id=', product_id) FROM $tbl_product WHERE date_modified='0000-00-00 00:00:00' AND sku!='' ) ";
        $this->query($q);

        $table = DB_PREFIX.'product_to_store';
        $q = " DELETE FROM $table WHERE product_id IN ( $base_select ) ";
        $this->query($q);

        $table = DB_PREFIX.'product_reward';
        $q = " DELETE FROM $table WHERE product_id IN ( $base_select ) ";
        $this->query($q);

        $table = DB_PREFIX.'product_description';
        $q = " DELETE FROM $table WHERE product_id IN ( $base_select ) ";
        $this->query($q);

        $table = DB_PREFIX.'product_to_category';
        $q = " DELETE FROM $table WHERE product_id IN ( $base_select ) ";
        $this->query($q);

        $q = " DELETE FROM $tbl_product WHERE date_modified='0000-00-00 00:00:00' AND sku!='' ";
        $this->query($q);
    }
}