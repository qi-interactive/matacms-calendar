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

		$scheduledEntities = CalendarHelper::getScheduledEntities(date('Y-m-d H:i:s'));
		$organizedScheduledEntities = CalendarHelper::organizeScheduledEntites($scheduledEntities);

		// $dataProvider = new \yii\data\ArrayDataProvider([
  //           'allModels' => $scheduledEntities,
  //       ]);

		return $this->render("index", ['organizedScheduledEntities' => $organizedScheduledEntities]);
	}

}
