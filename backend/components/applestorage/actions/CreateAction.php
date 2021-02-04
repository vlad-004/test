<?php

namespace backend\components\applestorage\actions;

use backend\models\AppleStorage;
use yii\base\Action;

/**
 * Creating random count of apples with random colors
 */
class CreateAction extends Action
{
    public function run()
    {
        $appleCount = rand(1, 6);

        for ($i = 1; $i <= $appleCount; $i++) {
            $apple = new AppleStorage();
            $apple->color = $this->getRandomColor();
            $apple->state = AppleStorage::STATE_ON_BRANCH;
            $apple->created_at = date('Y-m-d, H:i:s', mt_rand(1, time()));
            $apple->save();
        }

        return $this->controller->redirect('/backend');
    }

    /**
     * @return string
     */
    private function getRandomColor(): string
    {
        $appleColors = AppleStorage::$appleColors;
        return $appleColors[array_rand($appleColors)];
    }

}