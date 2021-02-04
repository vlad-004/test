<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $appleProvider ArrayDataProvider */

$this->title = 'тестовое задание для PR Holding';
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Сотварить неизведанное кол-во яблок', ['create-apple'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $appleProvider,
    ]); ?>
</div>
