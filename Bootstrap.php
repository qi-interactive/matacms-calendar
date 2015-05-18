<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\calendar;

use Yii;
use yii\base\Event;
use mata\base\MessageEvent;
//TODO Dependency on matacms
use matacms\controllers\module\Controller;

class Bootstrap extends \mata\base\Bootstrap 
{

	public function bootstrap($app) 
	{

	}

	private function canRun($app) 
	{
		return is_a($app, "yii\console\Application") == false;
	}

}
