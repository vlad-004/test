<?php


namespace backend\components\applestorage\actions;


use backend\models\AppleStorage;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;

class FallAction extends Action
{
    public function run(int $id)
    {
        $appleModel = AppleStorage::findOne($id);
        if ($appleModel->state === AppleStorage::STATE_FELL) {
            throw new BadRequestHttpException('Яблоко невозможно сорвать с дерева повторно');
        }
        $appleModel->state = AppleStorage::STATE_FELL;
        $appleModel->fell_at = date('Y-m-d, H:i:s', time());
        $appleModel->save();

        return $this->controller->redirect('/backend');
    }

}
