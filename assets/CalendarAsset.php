<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace matacms\calendar\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
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
