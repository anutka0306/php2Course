<?php


namespace App\Controllers;


use App\modules\Good;

class GoodController
{
    protected $defaultAction = 'all';

    public function run($action){
        if(empty($action)){
            $action = $this->defaultAction;
        }
        $method = $action .'Action';
        if(method_exists($this, $method)){
            return $this->$method();
        }
        return '404';
    }

    public function allAction(){
        $goods = (new Good())->getAll();
        return $this->render('goods', ['goods'=>$goods]);
    }

    public function oneAction(){
        $oGood = new Good();
        $good = $oGood->getOne($_GET['id']);
        return $this->render('good', ['good' => $good]);
    }

    public function render($template, $params = []){
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl(
            'layouts/main',
            ['content'=>$content]
        );
    }

    /**
     * @param $template
     * @param array $params ["users"=>123, "tr"=>[1,5,6]]
     * @return false|string;
     */
    public function renderTmpl($template, $params = []){
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}