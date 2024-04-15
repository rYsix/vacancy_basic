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

use app\models\User;



/**
 * Site controller
 */
class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['admin','edit-user','create-user'], 
                'rules' => [
                    [
                        'actions' => ['admin','edit-user','create-user'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if (Yii::$app->user->isGuest === false and Yii::$app->user->identity->is_admin) {
                                return true;
                            }
                            throw new \yii\web\ForbiddenHttpException('Доступ запрещен');
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create-user' => ['post'],
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
    public function actionAdmin()
    {
        $users = User::find()->all();
        return $this->render('admin', [
            'users' => $users,
        ]);
    }
    public function actionEditUser($id)
    {
        $user = User::findOne($id);

        if ($user !== null) {
            if (Yii::$app->request->isPost) {
                $user->username = Yii::$app->request->post('username');
                $user->email = Yii::$app->request->post('email');
                if (Yii::$app->request->post('newPassword')){
                    $user->setPassword(Yii::$app->request->post('newPassword'));
                }
                $user->is_manager = Yii::$app->request->post('is_manager') ? true : false;
                $user->is_admin = Yii::$app->request->post('is_admin') ? true : false;
            
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', 'Данные пользователя успешно обновлены.');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка при обновлении данных пользователя.');
                }
            
                return $this->redirect(['admin']);
            }            
        } else {
            Yii::$app->session->setFlash('error', 'Пользователь не найден.');
            return $this->redirect(['admin']);
        }

        return $this->render('editUser', [
            'user' => $user,
        ]);
    }
    public function actionCreateUser()
    {
        $user = new User();

        if (Yii::$app->request->isPost) {
            $user->username = Yii::$app->request->post('newUsername');
            $user->email = Yii::$app->request->post('newEmail');
            $user->setPassword(Yii::$app->request->post('newPassword'));
            $user->generateAuthKey();
            $user->is_manager = Yii::$app->request->post('newIsManager') ? true : false;
            $user->is_admin = Yii::$app->request->post('newIsAdmin') ? true : false;
            $user->status = 10;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Пользователь успешно создан.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при создании пользователя.');
            }
        }

        return $this->redirect(['admin']);
    }

    public function actionDeleteUser($id)
    {
        if (Yii::$app->request->isPost) {
            $user = User::findOne($id);
            if ($user !== null){
                $user ->delete();
                Yii::$app->session->setFlash('success','Пользователь удалён',);
            }
            else {
                Yii::$app->session->setFlash('error', 'Пользователь не найден.');
                return $this->redirect(['admin']);
            }
            
            
        }
        return $this->redirect(['admin']);
    }






    




    
}
