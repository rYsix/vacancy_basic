<?php

namespace app\controllers;


use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use yii\web\UploadedFile;



/**
 * Site controller
 */
class PpsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup','create-vacancy','edit-vacancy','responses'], 
                'rules' => [
                    [
                        'actions' => ['create-vacancy','edit-vacancy','responses'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if (Yii::$app->user->isGuest || Yii::$app->user->identity->is_manager === false) {
                                throw new \yii\web\ForbiddenHttpException('Доступ запрещен');
                            }
                            return true;
                        },
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionPps()
    {
        return $this->render('pps');
    }

    




    
}
