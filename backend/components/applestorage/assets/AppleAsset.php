<?php

namespace backend\components\applestorage\assets;

use yii\web\AssetBundle;


class AppleAsset extends AssetBundle
{
    public $sourcePath = '@backend/components/applestorage/assets';

    public $css = [
        'css/appleIndex.css',
    ];
    public $js = [
        'js/appleIndex.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
