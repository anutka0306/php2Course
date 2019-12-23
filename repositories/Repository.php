<?php


namespace App\repositories;


use App\entities\Entity;
use App\services\DB;

abstract class Repository
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    abstract public function getTableName(): string;
    abstract public function getEntityClass(): string;

    public function getOne($id){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id= :id";
        return $this->db->queryObject($sql, $this->getEntityClass(), [':id' => $id]);
    }

    public function getAll(){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryObjects($sql, $this->getEntityClass());
    }
/**
 *  @param Entity $entity
 */
    protected function insert(Entity $entity){
        $tableName = $this->getTableName();
        $data = [];
        $columns =[];
        $params =[];
        foreach ($entity as $property => $value){
            if(($property == 'id') ||($property == 'views_count')){
                continue;
            }
            $data[$property] = $value;
        }
        foreach ($data as $property => $value){
            $columns[] = $property;
            $params[":{$property}"] = $value;
        }
        $columnString = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));
        $sql = "INSERT INTO $tableName($columnString) VALUES( $placeholders)";
        $this->db->exec($sql, $params);
        $entity->id = $this->db->lastInsertId();
    }


    protected function update(Entity $entity){
        $tableName = $this->getTableName();
        $data = [];
        foreach ($entity as $property => $value){
            if(($property == 'id') ||($property == 'views_count')){
                continue;
            }
            $data[$property] = $value;
        }
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
        $sql .= " WHERE id = $entity->id";
        echo $sql;
        //var_dump($params);
        $this->db->exec($sql, $params);
    }

    public function save(Entity $entity){
        ($entity->id) ? $this->update($entity) : $this->insert($entity);
    }

    public function delete(Entity $entity){
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id= :id";
        $this->db->exec($sql, [':id' => $entity->id]);
    }


}