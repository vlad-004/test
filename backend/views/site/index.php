<?php

use backend\components\applestorage\assets\AppleAsset;
use backend\models\AppleStorage;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $appleProvider ArrayDataProvider */

AppleAsset::register($this);

$this->title = 'Тестовое задание для PR Holding';
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Сотварить неизведанное кол-во яблок', ['create-apple'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['id' => 'appleGridview']) ?>

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
                'template' => '{fall-apple} {show-eat-apple-modal}',
                'buttons' => [
                    'fall-apple' => function ($url, $model) {
                        return Html::a('<span  class="btn btn-success btn-sm btn-rounded">Уронить на землю</span>',
                            $url, ['class' => $model->state === AppleStorage::STATE_FELL ? 'disable' : '',]);
                    },
                    'show-eat-apple-modal' => function ($url, $model) {
                        switch ($model->state) {
                            case AppleStorage::STATE_ROTTEN:
                                $btn = Html::tag('span',
                                    'Яблоко испорченно',
                                    ['class' => 'rotten-apple disabled']
                                );
                                break;
                            case AppleStorage::STATE_ON_BRANCH:
                                $btn = Html::tag('span',
                                    'Скушать яблоко',
                                    [
                                        'class' => 'btn btn-default btn-sm btn-rounded',
                                        'title' => 'Сначала яблоко нужно уронить на землю',
                                    ]
                                );
                                break;
                            default:
                                $btn = Html::tag('span',
                                    'Скушать яблоко',
                                    [
                                        'class' => 'btn btn-warning btn-sm btn-rounded show-eat-apple-modal_link',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#eatAppleModal',
                                        'data-url' => $url,
                                    ]
                                );
                                break;
                        }

                        return $btn;
                    },
                ],
            ],
        ]
    ]); ?>

    <?php Pjax::end(); ?>

    <div class="modal remote fade" id="eatAppleModal">
        <div class="modal-dialog">
            <div class="modal-content loader-lg"></div>
        </div>
    </div>
</div>
