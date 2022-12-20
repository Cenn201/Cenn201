<?php
class ProductModel extends Model
{
    public function GetAllProducts()
    {
        $sql = parent::$connection->prepare('SELECT * FROM uml_product');
        return parent::select($sql);
    }
    public function GetEightProductByCategory($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM uml_product WHERE product_catid=? LIMIT 8');
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    public function GetProduct($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM uml_product WHERE product_id=?');
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }
    public function SearchProduct($search)
    {
        $sql = parent::$connection->prepare('SELECT * FROM uml_product where product_name like ?');
        $search = "%{$search}%";
        $sql->bind_param('s', $search);
        return parent::select($sql);
    }
    public function addProduct($product_name, $product_catid, $product_slug, $product_img, $product_number, $product_price, $product_sale, $product_detail)
    {
        $sql = parent::$connection->prepare('INSERT INTO `uml_product`(`product_sale`, `product_catid`, `product_name`, `product_slug`, `product_img`, `product_detail`, `product_number`, `product_price`) VALUES (?,?,?,?,?,?,?,?)');
        $sql->bind_param('sissssii', $product_sale, $product_catid, $product_name, $product_slug, $product_img, $product_detail, $product_number, $product_price);
        return $sql->execute();
    }
    public function editProduct($product_name, $product_catid, $product_slug, $product_img, $product_number, $product_price, $product_sale, $product_detail,$product_id)
    {
        $sql = parent::$connection->prepare('UPDATE `uml_product` SET `product_sale`=?, `product_catid`=?, `product_name`=?, `product_slug`=?, `product_img`=?, `product_detail`=?, `product_number`=?, `product_price`=? WHERE `product_id`=?');
        $sql->bind_param('sissssiii', $product_sale, $product_catid, $product_name, $product_slug, $product_img, $product_detail, $product_number, $product_price,$product_id);
        return $sql->execute();
    }
    public function deleteproduct($product_id)
    {
        $sql=parent::$connection->prepare('DELETE FROM `uml_product` WHERE product_id=?');
        $sql->bind_param('i',$product_id);
        return $sql->execute();
    }
    public function getProductByIds($arrId)
    {
        $chamHoi = str_repeat('?,', count($arrId) - 1);
        $chamHoi .= '?';
        
        $i = str_repeat('i', count($arrId));
        $sql = parent::$connection->prepare("SELECT * FROM uml_product WHERE product_id IN ( $chamHoi ) ORDER BY FIELD(product_id, $chamHoi ) DESC");
        $sql->bind_param($i . $i, ...$arrId, ...$arrId);

        return parent::select($sql);
    }
}
