<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
?>
<p class="lead">История перемещений вашей посылки</p>

<?php
$formatter = \Yii::$app->formatter;
foreach ($model->result->OperationHistoryData->historyRecord as $record) {
    echo '<p>';
    echo($record->OperationParameters->OperType->Name.'</br>');
    echo $formatter->asDate($record->OperationParameters->OperDate, 'long').', ';
    echo $formatter->asTime($record->OperationParameters->OperDate, 'full').', ';
    //echo($record->OperationParameters->OperDate.', ');
    echo($record->AddressParameters->OperationAddress->Description);
    echo '</p>';
};
//print_r($model->result->OperationHistoryData->historyRecord);
?>