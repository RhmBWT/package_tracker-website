<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'track') ?>

    <div class="form-group">
        <?= Html::submitButton('Проверить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>