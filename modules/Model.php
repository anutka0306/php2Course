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
    public function insert(){
        // todo
    }

}