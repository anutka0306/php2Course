<?php
namespace App\modules;

class Good extends Model
{
    public  $id;
    public $name;
    public $description;
    public $category;
    public $image;
    public $price;
    public $views_count;



    public function getTableName(): string
    {
        // TODO: Implement getTableName() method.
        return 'goods';
    }
    public function getOne($id){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE good_id= :id";
        return $this->db->find($sql, [':id' => $id]);
    }
}