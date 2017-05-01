<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TrackForm;
use SoapClient;
use SoapParam;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /* Track check function */

    public function actionTrack()
    {
        $model = new TrackForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model
            $wsdlurl = 'https://tracking.russianpost.ru/rtm34?wsdl';
            $login = "DFgtYRUBIXFMVH";
            $password = "HBvdxI61WWlM";

            $client2 = new SoapClient($wsdlurl, array('trace' => 1, 'soap_version' => SOAP_1_2));

            $params3 = array ('OperationHistoryRequest' => array ('Barcode' => $model->track, 'MessageType' => '0','Language' => 'RUS'),
                'AuthorizationHeader' => array ('login'=>$login,'password'=>$password));

            $model->result = $client2->getOperationHistory(new SoapParam($params3,'OperationHistoryRequest'));

            /*foreach ($result->OperationHistoryData->historyRecord as $record) {
                printf("<p>%s </br>  %s, %s</p>",
                    $record->OperationParameters->OperDate,
                    $record->AddressParameters->OperationAddress->Description,
                    $record->OperationParameters->OperAttr->Name);
            };*/
            // do something meaningful here about $model ...

            return $this->render('track-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('track', ['model' => $model]);
        }
    }
}
