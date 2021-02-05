<?php


namespace backend\components\applestorage\actions;


use Yii;
use yii\base\Action;

class FallAction extends Action
{
    public function run()
    {
        $appleId = Yii::$app->request->post('appleId');

    }

}