<?php

use backend\models\AppleStorage;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $appleProvider ArrayDataProvider */

$this->title = 'Тестовое задание для PR Holding';
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Сотварить неизведанное кол-во яблок', ['create-apple'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $appleProvider,
        'columns' => [
            [
                'attribute' => 'state',
                'value' => function (AppleStorage $model) {
                    return $model->getStateName();
                }
            ],
            'color',
            'capacity',
            'created_at',
            'fell_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'contentOptions' => ['style' => 'width : 100px;'],
                'template' => '{fall-apple} {eat-apple}',
                'buttons' => [
                    'fall-apple' => function ($url) {
                        return Html::a('<span  class=" btn btn-success btn-sm btn-rounded">Уронить на землю</span>',
                            $url);
                    },
                    'eat-apple' => function ($url) {
                        return Html::a('<span  class=" btn btn-warning btn-sm btn-rounded">Скушать яблоко</span>',
                            $url);
                    },
                ],
            ],
        ]
    ]); ?>
</div>
