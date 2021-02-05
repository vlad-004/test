<?php

namespace console\controllers;

use backend\models\AppleStorage;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * This class needs for checking every hour AppleStorage when apple state was fallen,
 * If 5 hours have passed since the fall then change state to STATE_ROTTEN
 * @package console\controllers
 */
class AppleStorageController extends Controller
{
    /**
     * @return bool
     */
    public function actionCheck(): bool
    {
        $changeToRotten = AppleStorage::changeToRotten();

        return $changeToRotten
            ? Console::output('Были обнаружены упавшие яблоки которые сгнили')
            : Console::output('Сгнивших яблок не обнаружено');
    }

}
