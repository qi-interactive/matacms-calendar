<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

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

		return $this->render("index", ['organizedScheduledEntities' => $organizedScheduledEntities]);
	}

}
