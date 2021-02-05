<?php


namespace backend\components\applestorage\actions;


use Yii;
use yii\base\Action;

class DeleteAction extends Action
{
    /**
     * @param int $appleId
     */
    public function run(int $appleId)
    {
        $appleId = Yii::$app->request->post('appleId');

    }

}