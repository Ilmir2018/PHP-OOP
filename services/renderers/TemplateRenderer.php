<?php


namespace app\services\renderers;


use app\base\App;

//Этот класс существует для отображения шаблона и передачи параметров основного контента.
class TemplateRenderer implements Irenderer
{
    public function render($template, $params = [])
    {
        //Используем фуферизацию вывода. Всё что идёт в выходной поток записывается в память.
        ob_start();
        //Функция из ассоциативного массива извлекает перемненные по ключам.
        extract($params);
        //Подключается запрашиваемый шаблон который попадает в буфер, тоесть сразу он не выводится.
        include App::call()->config['templatesDir'] . $template . ".php";
        //Функция забирает данные из буфера, выводит и очищает его.
        return ob_get_clean();
    }
}