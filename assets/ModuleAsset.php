<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\calendar\assets;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{
	public $sourcePath = '@vendor/matacms/matacms-calendar/web';

	public $js = [
	];

	public $depends = [
		'yii\web\YiiAsset'
	];
}
