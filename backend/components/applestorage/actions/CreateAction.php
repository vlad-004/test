<?php

namespace backend\components\applestorage\actions;

use backend\models\AppleStorage;
use yii\base\Action;
use yii\helpers\Url;

/**
 * Creating random count of apples with random colors
 */
class CreateAction extends Action
{
    public function run()
    {
        $appleCount = rand(1, 6);

        for ($i = 1; $i <= $appleCount; $i++) {
           AppleStorage::generateNewApple();
        }

        return $this->controller->redirect(Url::to('/backend'));
    }
}
