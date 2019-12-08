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

    public function update($id){
        $tableName = $this->getTableName();
        $data = $this->getData();
        $sql = "UPDATE {$tableName} SET " ;
        foreach ($data as $key => $val){
            ($val == end($data)) ? $sql.= $key."='".$val."'" : $sql.= $key."='".$val."', ";
        }
        $sql.=" WHERE good_id= :id";
        echo $sql;
        return $this->db->update($sql, [':id' => $id]);
    }

    public function delete($id){
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE good_id= :id";
        return $this->db->delete($sql, [':id' => $id]);
    }
}