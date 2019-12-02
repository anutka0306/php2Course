<?php


abstract class Model
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    abstract public function getTableName(): string;

    public function getOne($id){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id={$id}";
        return $this->db->find($sql);
    }
    public function getAll(){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->find($sql);
    }

}