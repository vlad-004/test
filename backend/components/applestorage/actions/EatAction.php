<?php

namespace backend\components\applestorage\actions;

use backend\models\AppleStorage;
use backend\models\EatAppleForm;
use Throwable;
use Yii;
use yii\base\Action;
use yii\base\InvalidArgumentException;
use yii\db\StaleObjectException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class EatAction extends Action
{
    /**
     * @param $id
     * @return Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     * @throws InvalidArgumentException
     */
    public function run($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $appleModel = AppleStorage::findOne($id);
        if (!$appleModel) {
            throw new NotFoundHttpException('Ошибка - Такого яблока не существует');
        }

        if ($appleModel->state === $appleModel::STATE_ON_BRANCH) {
            throw new BadRequestHttpException('невозможно скушать - яблоко на дереве');
        }
        if ($appleModel->state === $appleModel::STATE_ROTTEN) {
            throw new BadRequestHttpException('невозможно скушать - яблоко гнилое');
        }

        $formData = Yii::$app->request->post('EatAppleForm');
        $eatPercent = $formData[EatAppleForm::CAPACITY] / 100;
        $currentPercentCapacity = $appleModel->capacity;

        if ($eatPercent > $currentPercentCapacity) {
            throw new BadRequestHttpException('невозможно скушать больше чем осталось в яблоке, осталось в яблоке '
                . $currentPercentCapacity . '%');
        }
        $appleModel->capacity = $currentPercentCapacity - $eatPercent;

        if ($appleModel->capacity == 0) {
            $appleModel->delete();
        } else {
            $appleModel->save();
        }
// This is bad variant but my ajax is not working and just now I dont see why
        return $this->controller->redirect(Url::to('/backend'));
    }

}