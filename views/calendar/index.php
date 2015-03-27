<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model mata\contentblock\models\ContentBlock */

$this->title = \Yii::$app->controller->id;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="calendar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'ul',
        ],
        'itemOptions' => [
            'tag' => 'li',
        ],
        'itemView' => function ($model, $key, $index, $widget) {
	        //return print_r($model, true);
	        return $model['label'] . ' at ' . $model['date'] . ' / ' . $model['modelClass'] . '(' . $model['pk'] . ')';
    	},
        'summary' => '',
    ]);
    ?>
</div>
