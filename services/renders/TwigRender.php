<?php


namespace App\services\renders;


use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class TwigRender implements IRender
{
    protected $twig;
    public function __construct()
    {
        $loader = new FilesystemLoader([
           dirname(dirname(__DIR__)) .  "/views/layouts",
            dirname(dirname(__DIR__)) .  "/views"
        ]);
        $this->twig = new Environment($loader);
    }

    public function render($template, $params = []){
        $template .= '.twig';
        return $this->twig->render($template, $params);
    }

    /**
     * @param $template
     * @param array $params
     * @return string
     * @throws LoaderError
     * @throws SyntaxError
     * @throws RuntimeError
     */
    public function renderTmpl($template, $params = []){

    }
}