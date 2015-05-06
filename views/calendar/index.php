<?php

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use matacms\calendar\helpers\CalendarHelper;

/* @var $this yii\web\View */
/* @var $model mata\contentblock\models\ContentBlock */

\matacms\theme\simple\assets\CalendarAsset::register($this);

$this->title = \Yii::$app->controller->id;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="calendar-view">

<h1>Calendar</h1>

    <?php
    if(!empty($organizedScheduledEntities)) {
        foreach($organizedScheduledEntities as $date => $entities):
    ?>
        <section>
        <?php
        $groupDate = CalendarHelper::getCalendarGroupDate($date);
        ?>
        <header class="calendar-date"><?= $groupDate['date'] ?><?php if(!empty($groupDate['extra'])) echo '<span class="extra">['.$groupDate['extra'].']</span>';?></header>
        <?php
        foreach($entities as $entity):
            $reflection = new \ReflectionClass($entity['modelClass']);
            $moduleName = $reflection->getShortName();
        ?>
        <div class="calendar-event"><span class="time"><?= date('H:i', strtotime($entity['date'])) . '</span><span class="module">' . Inflector::camel2words($moduleName) . '</span><span class="event-label">' . $entity['label'] . '</span>'; ?></div>

        <?php
        endforeach;
        ?>
        </section>
    <?php 
        endforeach;
    }
    ?>
</div>

<script>

    parent.mata.simpleTheme.header
    .setText('YOU\'RE IN <?= Inflector::camel2words($this->context->module->id) ?> MODULE')
    .hideBackToListView()
    .hideVersions()
    .show();

</script>