<?php
class CategoryModel extends Model
{
    public function GetAllCategory()
    {
        $sql = parent::$connection->prepare('SELECT * FROM uml_category');
        return parent::select($sql);
    }
    public function GetCategory($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM uml_category WHERE category_id= ?');
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }
}
