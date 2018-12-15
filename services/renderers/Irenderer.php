<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 23.10.2018
 * Time: 12:02
 */

namespace app\services\renderers;

//Мы создаём зависимость от абстракции.
interface Irenderer
{
    public function render($template, $params = []);
}