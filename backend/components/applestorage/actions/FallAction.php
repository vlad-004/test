<?php

namespace backend\components\applestorage\actions;

use backend\models\AppleStorage;
use yii\base\Action;

class FallAction extends Action
{
    public function run(int $id)
    {
        AppleStorage::findOne($id)->fallToGround();

        return $this->controller->redirect('/backend');
    }

}
