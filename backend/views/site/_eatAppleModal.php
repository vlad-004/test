<?php

use backend\models\AppleStorage;
use backend\models\EatAppleForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/** @var EatAppleForm $formModel */
/** @var AppleStorage $appleModel */

?>

<?php $form = ActiveForm::begin([
    'action' => Url::to(['site/eat-apple', 'id' => $appleModel->id]),
    'method'=>'post',
    'options' => [
        'id' => 'eat-apple-form'
    ]
]);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Укажите сколько откусить в % яблока #<?= $appleModel->id ?></h4>
</div>
<div class="modal-body">
    <?php echo $form->field($formModel, 'capacity')->textInput(['maxlength' => 3]) ?>
</div>
<div class="modal-footer">
    <?php echo Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
</div>
<?php ActiveForm::end(); ?>
