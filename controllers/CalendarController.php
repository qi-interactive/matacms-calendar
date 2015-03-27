<?php

namespace matacms\calendar\controllers;

use yii;
use matacms\controllers\module\Controller;
use mata\modulemenu\models\Module as ModuleModel;
use mata\helpers\MataModuleHelper;
use mata\helpers\ComposerHelper;

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

		$modules = ModuleModel::find()->all();

		foreach ($modules as $moduleEntry) {
			echo 'moduleEntry->Location ' . $moduleEntry->Location . '<br>';
			$moduleLocationDir = ComposerHelper::getLibraryDirByNamespace($moduleEntry->Location);
			$moduleModels = glob($moduleLocationDir . '/models/*.php');
			foreach($moduleModels as $moduleModel) {
				// get model class with namespace
				$className = basename($moduleModel, '.php');
				// omit classname with Form
				if(strpos($className, 'Form') !== false || strpos($className, 'Search') !== false)
					continue;
				$classNameWithNamespace = $moduleEntry->Location . 'models\\' . basename($moduleModel, '.php');
				echo '- moduleModelWithNamespace: ' . $classNameWithNamespace . '<br>';
				// create object for model to get attributes
				$model = new $classNameWithNamespace();
				echo 'model: ' . \yii\helpers\VarDumper::dumpAsString($model) . '<br>';
			}
			
			// $module = MataModuleHelper::getModuleByClass($moduleEntry->Location . "Module");

			// // Not every module should be loaded as a Yii module
			// if ($module == null || !$module->canShowInNavigation() || $module->getNavigation() == null) {
			// 	continue;
			// }

			echo '<br><br>--<br><br>';

		}

    	// require_once '/Users/michal-qi/Sites/taste/vendor/mata/mata-ar-history/models/Revision.php';

  //   	$modules = \Yii::$app->getModules();

  //   	$modelsPaths =  glob(\Yii::getAlias('@vendor').'/*/*/models/*.php');

  //   	foreach ($modelsPaths as $modelPath) {
  //   		$className = basename($modelPath, ".php");
  //   		require_once $modelPath;
  //   		echo 'Model: ' . \yii\helpers\VarDumper::dumpAsString($className).'<br>';
		// 	echo 'ModelPath: ' . \yii\helpers\VarDumper::dumpAsString($modelPath).'<br>';
		// 	echo '<br><br>';

		// }

		// foreach ($modules as $id => $module) {

		// 	echo 'Module ID: ' . $id . '<br>';
		// 	echo \yii\helpers\VarDumper::dumpAsString($module);
		// 	echo '<br><br>';

		// }

		return $this->render("index");
	}

}
