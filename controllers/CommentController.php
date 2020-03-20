<?php


namespace app\controllers;


use app\base\App;

class CommentController extends Controller
{

    public function actionIndex()
    {
        if ($this->session->issetKey('user_name')){
            if ($this->request->post('submitAddComment') ?? null) {
                $content = $this->request->post('content');
                $name = $this->request->post('name');
                if (!empty($content) && !empty($name)) {
                    $this->comment->getComment($name, $content);
                    $this->redirect($this->request->getRequestString());
                } else {
                    echo 'Заполните все поля';
                }
            }
            $comments = $this->comment->getAll();
            echo $this->render('comment', ['comments' => $comments]);
        } else {
            echo $this->render('authentication');
        }
    }

}