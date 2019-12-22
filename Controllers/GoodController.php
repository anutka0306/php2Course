<?php


namespace App\Controllers;


use App\modules\Good;

class GoodController extends Controller
{
    protected $defaultAction = 'all';


    public function allAction(){
        $goods = (new Good())->getAll();
        return $this->render('goods', [
            'goods'=>$goods,
            'title'=>'Все товары'
        ]);
    }

    public function oneAction(){
        $oGood = new Good();
        $good = $oGood->getOne($this->getId());
        return $this->render('good', [
            'good' => $good,
            'title'=>'Один товар'
        ]);
    }

    public function addAction(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $good = new Good();
            $good->name = $_POST['name'];
            $good->description = $_POST['description'];
            $good->category = $_POST['category'];
            $good->image = $this->getImage();
            $good->price = $_POST['price'];
            $good->save();
            return header('Location: /php2Course/lesson5/php2Course/public/good/');
           // var_dump($good);
           // var_dump($_FILES);
        }
        return $this->render('goodAdd');
    }

    public function updateAction(){
        if(empty($this->getId())){
            return header('Location: /php2Course/lesson5/php2Course/public/good/');
        }
        $good = (new Good())->getOne($this->getId());

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $good->id = $_POST['id'];
            $good->name = $_POST['name'];
            $good->description = $_POST['description'];
            $good->price = $_POST['price'];
            $good->image = $this->getImage();
            $good->save($good->id);
            return header('Location: /php2Course/lesson5/php2Course/public/good/');
        }
        return $this->render('goodUpdate', ['good' => $good]);
    }

    public function getImage(){
        $php_errors = array(1 => 'Превышен мах. размер файла, указанный в php.ini',
            2 => 'Превышенм мах. размер файла, указанный в форме html',
            3 => 'Была отправлена только часть файла',
            4 => 'Файл для отправки не был выбран');

            $upload_dir = "upload/";
            $image_fildname = "user_pic";
            if($_FILES[$image_fildname]['name']) {
            $_FILES[$image_fildname]['error'] == 0
            or die($php_errors[$_FILES[$image_fildname]['error']]);
            @getimagesize($_FILES[$image_fildname]['tmp_name'])
            or die($_FILES[$image_fildname]['tmp_name'] . " не является изображением");
            $now = time();
            while(file_exists($upload_filename = '../'. $upload_dir . $now . '-' . $_FILES[$image_fildname]['name'])){
                $now++;
            }
            $image_name = $upload_filename;
            @move_uploaded_file($_FILES[$image_fildname]['tmp_name'], $upload_filename) or die("Не удалось переместить");
        }else{
            $image_name = $_POST['old-image'];
        }
        return $image_name;
    }

    public function deleteAction(){
        if(empty($this->getId())){
            return header('Location: /php2Course/lesson5/php2Course/public/good/');
        }
        $good = (new Good())->getOne($this->getId());
        $good->delete($good->id);
        return header('Location: /php2Course/lesson5/php2Course/public/good/');
    }
}