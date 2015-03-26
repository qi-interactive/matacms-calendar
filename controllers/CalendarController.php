<?php

namespace matacms\calendar\controllers;

use yii;
use matacms\controllers\module\Controller;

class CalendarController extends Controller 
{

    public function actionIndex() {

        return $this->render("index");
    }

}
