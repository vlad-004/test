<?php

namespace backend\components\applestorage\assets;

use yii\web\AssetBundle;


class AppleAsset extends AssetBundle
{
    public $sourcePath = '@backend/components/applestorage/assets';

    public $css = [
        'css/page.css',
    ];
    public $js = [
        'js/page.js',
    ];

    public $depends = [
        'backend\assets\AppAsset',
    ];
}
