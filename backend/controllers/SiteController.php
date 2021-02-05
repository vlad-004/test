<?php

namespace backend\controllers;

use backend\components\applestorage\actions\DeleteAction;
use backend\components\applestorage\actions\EatAction;
use backend\components\applestorage\actions\FallAction;
use backend\models\AppleStorage;
use backend\models\AppleStorageSearch;
use backend\components\applestorage\actions\CreateAction;
use backend\models\EatAppleForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout',
                            'index',
                            'create-apple',
                            'fall-apple',
                            'eat-apple',
                            'delete-apple',
                            'show-eat-apple-modal',
                            ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'eat-apple' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if(in_array($action->id,['eat-apple'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'create-apple' => CreateAction::class,
            'fall-apple' => FallAction::class,
            'eat-apple' => EatAction::class,
            'delete-apple' => DeleteAction::class,
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     * @throws InvalidArgumentException
     */
    public function actionIndex()
    {
        $searchModel = new AppleStorageSearch();
        $appleProvider = $searchModel->search(Yii::$app->request->queryParams);
        $appleProvider->pagination = false;

        return $this->render('index', [
            'appleProvider' => $appleProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionShowEatAppleModal($id)
    {
        $appleModel = AppleStorage::findOne($id);
        if (!$appleModel) {
            throw new NotFoundHttpException('Ошибка Такого яблока не существует');
        }
        $formModel = new EatAppleForm();

        return $this->renderAjax('_eatAppleModal', [
            'formModel' => $formModel,
            'appleModel' => $appleModel,
        ]);
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

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
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
}
