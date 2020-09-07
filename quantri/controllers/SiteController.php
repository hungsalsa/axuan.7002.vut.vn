<?php
namespace quantri\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use quantri\modules\customer\models\Customers;
use quantri\modules\products\models\Order;
class SiteController extends Controller
{
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
// 'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=> function ($rule ,$action)
                        {
                            $control = Yii::$app->controller->id;
                            $action = Yii::$app->controller->action->id;
                            $module = Yii::$app->controller->module->id;

                            $role = $module.'/'.$control.'/'.$action;
                            if (Yii::$app->user->can($role)) {
                                return true;
                            }else {
                                return true;
                                // throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    // 'logout' => ['post'],
                    'quickchange' => ['post'],
                    // 'quickchange' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => '@quantri/views/layouts/'.Yii::$app->params['layout']['layout_backend'],
            ],
        ];
    }
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    // public function actionError()
    // {
    //     $exception = Yii::$app->errorHandler->exception;
    //     if ($exception !== null) {
    //         $this->layout = 'login';
    //         return $this->render('error', ['exception' => $exception]);
    //     }
    // }

    public function actionIndex()
    {
        $this->layout = Yii::$app->params['layout']['layout_backend'];
        $model = new Customers();
        $data['customer'] = $model->getCountCustomer();
        $model = new Order();
        $data['order'] = $model->getCountOrder();
        // dbg($data);
        return $this->render('index',['data'=>$data]);
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('messeage','Chào mừng bạn tới với admin');
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }



        if (!\Yii::$app->user->isGuest) {
        return $this->goHome();
    }

// $model = new LoginForm();
// if ($model->load(Yii::$app->request->post()) && $model->login()) {
// //check user roles, is user is Admin? 
//     if (\Yii::$app->user->can('Admin'))
//     {
//         // yes he is Admin, so redirect page 
//         // return $this->goBack();
//          return $this->redirect(['quantri/productcategory']);
//     }
//     else // if he is not an Admin then what :P
//     {   // put him out :P Automatically logout. 
//         Yii::$app->user->logout();
//         // set error on login page. 
//         \Yii::$app->getSession()->setFlash('error', 'You are not authorized to login Admin\'s penal.<br /> Please use valid Username & Password.<br />Please contact Administrator for details.');
//         //redirect again page to login form.
//         return $this->redirect(['site/login']);
//     }

// } else {
// return $this->render('login', [
//     'model' => $model,
// ]);
// }


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
