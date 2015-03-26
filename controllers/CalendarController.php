<?php

namespace matacms\calendar\controllers;

use yii;
use matacms\controllers\module\Controller;

class CalendarController extends Controller 
{

	public function getModel() 
    {
        return null;
    }

    public function getSearchModel() 
    {
        return null;
    }
    
    public function actionIndex() {

        return $this->render("index");
    }

}
