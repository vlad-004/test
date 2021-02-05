<?php

namespace backend\components\applestorage\actions;

use backend\models\AppleStorage;
use backend\models\EatAppleForm;
use yii\base\Action;
use yii\web\NotFoundHttpException;

class ShowEatAppleModalAction extends Action
{
    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function run(int $id)
    {
        $appleModel = AppleStorage::findOne($id);
        if (!$appleModel) {
            throw new NotFoundHttpException('Ошибка Такого яблока не существует');
        }
        $formModel = new EatAppleForm();

        return $this->controller->renderAjax('_eatAppleModal', [
            'formModel' => $formModel,
            'appleModel' => $appleModel,
        ]);
    }

}