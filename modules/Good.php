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
        return $this->db->queryObject($sql, static::class, [':id' => $id]);
    }

    protected function update($id){
        $tableName = $this->getTableName();
        $data = $this->getData();
        $columns =[];
        $params =[];
        foreach ($data as $property => $value){
            $columns[":{$property}"] = $property;
            $params[":{$property}"] = $value;
        }

        $sql = "UPDATE $tableName SET ";
        foreach ($columns as $key => $val){
            ($val == end($columns)) ? $sql .= "$val = $key" : $sql .= "$val = $key, ";
        }
        $sql .= " WHERE good_id = $id";
        echo $sql;
        //var_dump($params);
        return $this->db->exec($sql, $params);
    }

    public function delete($id){
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE good_id= :id";
        return $this->db->delete($sql, [':id' => $id]);
    }
}