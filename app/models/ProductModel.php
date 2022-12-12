<?php
class ProductModel extends Model
{
    public function GetAllProducts()
    {
        $sql=parent::$connection->prepare('SELECT * FROM uml_product');
        return parent::select($sql);
    }
    public function GetEightProductByCategory($id)
    {
        $sql=parent::$connection->prepare('SELECT * FROM uml_product WHERE product_catid=? LIMIT 8');
        $sql->bind_param('i',$id);
        return parent::select($sql);
    }
    public function GetProduct($id)
    {
        $sql=parent::$connection->prepare('SELECT * FROM uml_product WHERE product_id=?');
        $sql->bind_param('i',$id);
        return parent::select($sql)[0];
    }
    public function SearchProduct($search)
    {
        $sql = parent::$connection->prepare('SELECT * FROM uml_product where product_name like ?');
        $search = "%{$search}%";
        $sql->bind_param('s', $search);
        return parent::select($sql);
    }
}