<?php

namespace app\controllers;

use app\services\renderers\Irenderer;
use app\base\App;

abstract class Controller
{
    //Свойство для названия открываемой страницы
    protected $action;
    //Открываемая страница по умолчанию
    protected $defaultAction = "index";
    //Название шаблона который подгружается поверх основного если не произошло аутентификации
    protected $layout = 'main';
    //Название шаблона который подгружается поверх основного если произошла аутентификация
    protected $layout2 = 'main2';
    //Переменная равная true по умолчанию.
    protected $uselayout = true;
    //Переменная для выбора метода отрисовки.
    protected $renderer = null;

    //При создании класса контроллера происходит выбор между данными методами отображения шаблонов
    public function __construct(Irenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function run($action = null){
        //В переменную попадает либо свойство которые задаётся при вызове метода run по умолчанию null либо index
        //Если при вызове мы ничего там не прописываем.
        $this->action = $action ?: $this->defaultAction;
        //В переменную попадает имя метода который должен быть в данном классе
        $method = "action" . ucfirst($this->action);
        //Если метод есть в данном классе, то запускается код который в нём прописан.
        if (method_exists($this, $method)){
            $this->$method();
        }else{
            //Если нет вызываестя сообщение обошибке.
            echo '404';
        }
    }
    //Это главный метод который вызывается в каждом контроллере, в который передаётся основной подгружаемый шаблон
    //и параметры для вывода на странице.
    public function render($template, $params = [])
    {
        //Мы в любом случае используем определённый шаблон в который оборачиваем всё остальное поэтому он всегда будет true
        if ($this->uselayout){
            //В переменную помещаем метод который у нас прописан в другом классе.
            $content = $this->renderTemplate($template, $params);
            //Если сессия которая создаётся при аутентификации не пустая
            if (!empty($_SESSION['user_name'])){
                //Мы обволакиваем контент шаблоном для зарегестрированнного пользователя
                $content = $this->renderTemplate("layouts/{$this->layout2}", ['content' => $content]);
            }
            else{
                //Если эта сессия пуста, то отражается шаблон для незареганного пользователя.
                $content = $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
            }
            //Возвращаем контент.
            return $content;
        }
    }
    //Метод возврвщет метод, созданный в другом классе, в нашем случае либо TemplateRenderer либо TwigRenderer.
    //Чтобы методов подгрузки шаблонов было несколько мы делая систему более гибкой создаём интерфейс в котором задаётся
    //метод для отображения шаблона, а самих методов может быть несколько. В нашем случае 2.
    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }
    //Создаём общий для всех контроллеров метод, возвращающий сессию для сохранения подшаблона, котороый открывается для
    //авторизованных и зарегестрированных пользователей.
    public function getSession()
    {
        //в переменную помещается созданный объект одиночка для открытия сессии.
        $session = App::call()->session;
        //Возваращается массив сессии по ключу.
        return $session->get('user_name');
    }
    //Общий объект для редиректа после отправки запроса на ту же страницу скоторый произошла отправка, чтобы не происходило
    //повтороной отправки
    public function redirect($url)
    {
        header("Location:{$url}");
        exit;
    }

    //Метод для открытия и создания сессии с ключом basket.
    public function getData(){
        $session = App::call()->session;
        return $session->get('basket');
    }
}