<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\calendar\assets;

use yii\web\AssetBundle;

class CalendarAsset extends AssetBundle
{
	public $sourcePath = '@vendor/matacms/matacms-calendar/web';

	public $css = [
        'css/calendar.css'
    ];

	public $js = [
		'js/calendar.js'
	];

	public $depends = [
		'yii\web\YiiAsset'
	];
}
