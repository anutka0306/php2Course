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
        return $this->db->find($sql, [':id' => $id]);
    }

    public function getAll(){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->findAll($sql);
    }

    protected function insert(){
        $tableName = $this->getTableName();
        $data = $this->getData();
        $sql = "INSERT INTO {$tableName}(";
        foreach ($data as $key => $val){
            ($val == end($data)) ? $sql.=$key : $sql.=$key . ', ';
        }
        $sql.=") VALUES (";
        foreach ($data as $val){
            ($val == end($data)) ? $sql.="'".$val."'" : $sql.="'".$val."'" . ', ';
        }
        $sql.=")";
        echo $sql;
        return $this->db->insert($sql);
    }

    protected function update($id){
        $tableName = $this->getTableName();
        $data = $this->getData();
        $sql = "UPDATE {$tableName} SET " ;
        foreach ($data as $key => $val){
            ($val == end($data)) ? $sql.= $key."='".$val."'" : $sql.= $key."='".$val."', ";
        }
        $sql.=" WHERE id= :id";
        echo $sql;
        return $this->db->update($sql, [':id' => $id]);
    }

    public function save($id=null){
        ($id) ? $this->update($id) : $this->insert();
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