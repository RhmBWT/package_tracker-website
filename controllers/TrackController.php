<?php

namespace app\controllers;

use Yii;
use app\models\TrackForm;
use SoapClient;
use SoapParam;

class TrackController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new TrackForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->getTrackData();
            return $this->render('track', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('index', ['model' => $model]);
        }
    }

}
