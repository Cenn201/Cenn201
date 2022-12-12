<?php
    class CategoryModel extends Model
    {
        public function GetAllCategory()
        {
            $sql=parent::$connection->prepare('SELECT * FROM uml_category');
            return parent::select($sql);
        }
    }
?>