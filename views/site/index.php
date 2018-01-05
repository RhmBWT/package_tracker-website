<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Главная - Package Tracker';
?>
<div class="container">
    <h1>Package Tracker</h1>

    <p class="lead">Здесь вы можете узнать, где находится ваша посылка</p>

    <?php $form = ActiveForm::begin([
        'action' => ['track/index'],
        'layout' => 'inline',
    ]); ?>
    <?= $form->field($model, 'track', [
        'inputOptions' => [
            'placeholder' => 'Введите трек-код',
            'class' => 'form-control input-lg',
        ],
    ])->label(false) ?>
    <?= Html::submitButton('Проверить мою посылку!', ['class' => 'btn btn-lg btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>