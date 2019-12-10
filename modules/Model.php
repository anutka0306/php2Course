<?php
namespace App\modules;

use App\services\DB;
use App\services\TCalcRows;

abstract class Model
{
    use TCalcRows;
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    abstract public function getTableName(): string;

    public function getOne($id){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id= :id";
        return $this->db->queryObject($sql, static::class, [':id' => $id]);
    }

    public function getAll(){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryObjects($sql, static::class);
    }

    public function insert(){
        $tableName = $this->getTableName();
        $data = $this->getData();
        $columns =[];
        $params =[];

        foreach ($data as $property => $value){
            $columns[] = $property;
            $params[":{$property}"] = $value;
        }
        $columnString = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));
        $sql = "INSERT INTO $tableName($columnString) VALUES( $placeholders)";
        echo $sql;
        $this->db->exec($sql, $params);
        $this->id = $this->db->lastInsertId();
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
        $sql .= " WHERE id = $id";
        echo $sql;
        //var_dump($params);
        $this->db->exec($sql, $params);
    }

    public function save($id=null){
        ($id) ? $this->update($id) : $this->insert();
    }

    public function delete(){
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id= :id";
        $this->db->exec($sql, [':id' => $this->id]);
    }

    public function getData(){
        $data = [];
        foreach ($this as $property => $value){
            if(($property == 'id') || ($property == 'db')||($property == 'views_count')){
                continue;
            }
            if($property == 'password'){
                $value = md5($value);
            }
            $data[$property] = $value;
        }
        return $data;
    }

}