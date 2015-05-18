<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\calendar\helpers;

use mata\helpers\MataModuleHelper;
use mata\helpers\ComposerHelper;
use mata\helpers\ActiveRecordHelper;

class CalendarHelper 
{
	
	public static function getScheduledEntities($fromDate = null, $order = 'asc')
	{
		$modelsForCalendar = self::getModelsForCalendar();
		$schedulesEntities = [];

		if(!empty($modelsForCalendar)) {
			foreach($modelsForCalendar as $model) {
				if(!empty($fromDate)){
					$eventDateAttribute = $model::getEventDateAttribute();
					$entities = $model::find()->where("$eventDateAttribute >= :fromDate", [':fromDate' => $fromDate])->all();
				}
				else 
					$entities = $model::find()->all();
				if(!empty($entities)) {
					foreach($entities as $entity) {
						if(empty($entity->getEventDate()))
							continue;
						array_push($schedulesEntities, ['pk' => ActiveRecordHelper::getPk($entity), 'label' => $entity->getLabel(), 'date' => $entity->getEventDate(), 'modelClass' => $model::className()]);
					}

				}
			}
		}

		usort($schedulesEntities, function($a, $b) use ($order){
			return ($order == 'desc') ? ($a['date'] < $b['date']) : ($a['date'] > $b['date']);
		});
		return $schedulesEntities;
	}

	public static function getModelsForCalendar() 
	{
		$modules = \Yii::$app->getModules();

		$modelsForCalendar = [];

		foreach ($modules as $module) {
			if (is_array($module))
				$module = new $module["class"](null); // module not initialized
			
			$moduleClass = get_class($module);
			$reflector = new \ReflectionClass($moduleClass);
			$moduleClassNamespace = $reflector->getNamespaceName();
			$moduleModels = self::getModelsFromNamespace($moduleClassNamespace);

			foreach($moduleModels as $moduleModel) {
				// get model class with namespace
				$className = basename($moduleModel, '.php');
				$classNameWithNamespace = $moduleClassNamespace . '\\models\\' . basename($moduleModel, '.php');
				$containsFormSubstring = substr_compare($className, 'Form', -4, 4) === 0 && strlen($className) > 4;
				$containsSearchSubstring = substr_compare($className, 'Search', -6, 6) === 0 && strlen($className) > 6;

				// omit classname with Form
				if($containsFormSubstring || $containsSearchSubstring)
					continue;

				// create object to check if it's instance of CalendarInterface
				$model = new $classNameWithNamespace(null);
				if (!$model instanceof \matacms\interfaces\CalendarInterface) 
					continue;

				array_push($modelsForCalendar, $model);
			}
		}

		return $modelsForCalendar;
	}

	public static function organizeScheduledEntites($schedulesEntities)
	{
		$results = [];
		if(!empty($schedulesEntities)) {
			$eventDateGroups = [];
			foreach($schedulesEntities as $entity) {
				array_push($eventDateGroups, date('Y-m-d', strtotime($entity['date'])));
			}

			foreach($schedulesEntities as $entity) {
				$results[date('Y-m-d', strtotime($entity['date']))][] = $entity;
			}
		}
		return $results;
	}

	public static function getCalendarGroupDate($date, $format = 'd-m-Y') 
	{
		$date = new \DateTime($date);
		$today = new \DateTime();
		$today->setTime(0, 0, 0);
		$tomorrow = new \DateTime('tomorrow');
		$tomorrow->setTime(0, 0, 0);

		if($date == $today) {
			return ['date' => $date->format($format), 'extra' => 'TODAY'];
		} elseif($date == $tomorrow) {
			return ['date' => $date->format($format), 'extra' => 'TOMORROW'];
		} else {
			return ['date' => $date->format($format)];
		}
	}

	private static function getModelsFromNamespace($namespace) 
	{
		$foldersToScan = [
			\Yii::getAlias('@mata-cms') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . str_replace("matacms", "mata-cms", str_replace('\\', '/', $namespace)),
			ComposerHelper::getLibraryDirByNamespace($namespace . '\\'),
		];

		foreach($foldersToScan as $folder) {
			if(!file_exists($folder))
				continue;
			return glob($folder . '/models/*.php');
		}
	}

}
