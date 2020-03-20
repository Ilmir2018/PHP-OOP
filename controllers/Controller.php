<?php


namespace app\controllers;


use app\base\App;
use app\services\renderers\IRenderer;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = "main";
    private $layout2 = "main2";
    private $useLayout = true;
    private $renderer = null;
    protected $request;
    protected $cart;
    protected $session;
    protected $order;
    protected $user;
    protected $product;
    protected $comment;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->request = App::call()->request;
        $this->session = App::call()->session;
        $this->cart = App::call()->cart;
        $this->order = App::call()->order;
        $this->user = App::call()->user;
        $this->product = App::call()->product;
        $this->comment = App::call()->comment;
    }

    public function run($action = null) {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if(method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            $content = $this->renderTemplate($template, $params);
            if (!empty($_SESSION['user_name'])) {
                $content = $this->renderTemplate("layouts/{$this->layout2}", ['content' => $content, 'session' => $this->session]);
            } else {
                $content = $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
            }
            echo $content;
        }
    }

    public function renderTemplate($template, $params = []) {
        return $this->renderer->render($template, $params);
    }

    public function redirect($url)
    {
        header("Location:{$url}");
        exit;
    }

}