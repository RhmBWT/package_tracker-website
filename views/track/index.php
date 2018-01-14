<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Отследить';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'track') ?>

    <div class="form-group">
        <?= Html::submitButton('Проверить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>