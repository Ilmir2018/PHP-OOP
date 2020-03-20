<?php


namespace app\services\renderers;


class TwigRenderer implements IRenderer
{

    private $template;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(TWIG_DIR);
        $this->template = new \Twig\Environment($loader);
    }

    public function render($template, $params = [])
    {
        echo $this->template->render($template . '.twig', $params);
    }

}