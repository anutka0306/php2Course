<?php
namespace App\modules;

class Good extends Model
{
    public $id;
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


}