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

    public function getData(){
       $data = [];
       foreach ($this as $property => $value){
           if(($property == 'id') || ($property == 'db')||($property == 'views_count')){
               continue;
           }
           $data[$property] = $value;
       }
       var_dump($data);
    }

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