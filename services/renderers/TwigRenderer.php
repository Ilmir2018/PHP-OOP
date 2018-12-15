<?php


namespace app\services\renderers;


class TwigRenderer implements Irenderer
{
    private $twig;

    public function __construct()
    {
        //Указываем путь к шаблонам.
        $loader = new \Twig_Loader_Filesystem( TWIG_DIR);
        //Инициализируем твиг
        $this->twig = new \Twig_Environment($loader);
    }

    public function render($template, $params = [])
    {
        return $this->twig->render($template . ".twig", $params);
    }
}