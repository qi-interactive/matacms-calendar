<?php

namespace matacms\calendar\controllers;

use yii;
use matacms\controllers\module\Controller;
use matacms\calendar\helpers\CalendarHelper;

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

		$scheduledEntities = CalendarHelper::getScheduledEntities();

		$dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $scheduledEntities,
        ]);

		return $this->render("index", ['dataProvider' => $dataProvider]);
	}

}
