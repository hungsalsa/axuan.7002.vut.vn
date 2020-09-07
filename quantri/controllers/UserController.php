<?php

namespace quantri\controllers;

use Yii;
use quantri\models\User;
use quantri\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use quantri\models\SignupForm;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use quantri\modules\auth\models\AuthAssignment;
use yii\web\HttpException;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule,$action)
                        {
                            $module = Yii::$app->controller->module->id;
                            $action = Yii::$app->controller->action->id;
                            $controller = Yii::$app->controller->id;
                            $route = "$controller/$action";
                            $post = Yii::$app->request->post();
                            if (\Yii::$app->user->can($route)) {
                                return true;
                            }
                        }
                    ],
                    // [
                    //     'allow' => true,
                    //     'actions' => ['logout'],
                    //     'roles' => ['@'],
                    // ],
                ],
            ],
        ];
    }

    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        $this->layout = Yii::$app->params['layout']['layout_backend'];
        return parent::beforeAction($action); 
    }
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSignup()
    {
        // $this->layout = 'signup';
        $model = new SignupForm();
        $user = new User();

        $authItems = ['admin'=>'Admin','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

            // echo '<pre>';print_r($authItems);die;

        if ($model->load($post = Yii::$app->request->post())) {
            // dbg($_POST['SignupForm']['permission']);
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('messeage','Bạn đã thêm thành công :'.$user->username);
                return $this->redirect(['index']);
            }
        }
        return $this->render('signup', [
            'model' => $model,
            'user' => $user,
            'authItems' => $authItems,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionResetpassword($id)
    {
        $user_username = User::find()->select('username')->where(['id'=>$id])->one();
        $user_username = $user_username->username;
        if ($id == 1) {
            // throw new HttpException(403,'Bạn không thể sửa mật khẩu tài khoản quản trị');
        }

        if (md5(getUser()->username)!= Yii::$app->params['configuration']['info'] && md5($user_username)==Yii::$app->params['configuration']['info']) {
            throw new HttpException(403,'Không có tài khoản nào');
        }
        if ($id == Yii::$app->user->identity->id) {
            throw new HttpException(403,'Bạn hãy thay đổi mật khẩu tài khoản của mình chứ ko Reset');
        }
        if (Yii::$app->user->identity->id != 1 && Yii::$app->user->identity->id != 2 && Yii::$app->user->identity->id != 9) {
            // throw new HttpException(403,'Bạn không có quyền truy cập ');
        }
        $model = new \quantri\models\ResetPasswordForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
        
        if ($model->load($post = Yii::$app->request->post()) && $model->validate()) {
            // dbg($post);
            $username = $model->resetPassword($id,$post['ResetPasswordForm']['password']);

            Yii::$app->session->setFlash('messeage','Bạn đã Reset mật khẩu thành công tài khoản : '.$username);
            return $this->redirect(['index']);
        }
        return $this->render('resetPassword', [
            'model' => $model,
            'user_username' => $user_username,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (md5(getUser()->username)!= Yii::$app->params['configuration']['info'] && md5($model->username)==Yii::$app->params['configuration']['info']) {
            throw new HttpException(403,'Không có tài khoản nào');
        }

        $permission = new AuthAssignment();
        if ($permission->PermissionUser($id)) {
            $model->permission = $permission->PermissionUser($id);
            
        }

        $authItems = ['admin'=>'Admin','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];

        if ($model->load($post = Yii::$app->request->post())) {
            $permission = AuthAssignment::findOne(['user_id'=>$id]);
            if ($permission) {
                $permission->item_name= $post['User']['permission'];
                $permission->updated_at= time();
            }else {
                $permission = new AuthAssignment();
                $permission->user_id= $id;
                $permission->item_name= $post['User']['permission'];
                $permission->created_at= time();
                $permission->updated_at= time();
            }
            // dbg($post);
            if($model->save() && $permission->save()) pr('sada');
                // dbg($permission->errors);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'authItems' => $authItems,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($id==1) {
            throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
        }
        $permission = AuthAssignment::findOne(['user_id'=>$id]);
        $model->delete();
        if ($permission) {
            $permission->delete();
            
        }

        return $this->redirect(['index']);
    }

    public function actionChangepassword()
    {
        // set up user and load post data
        $user = Yii::$app->user->identity;
        $user->scenario = 'changepassword';

        $loadedPost = $user->load(Yii::$app->request->post());
        
        // echo "<pre>";print_r($user);die;

        // validate for normal request
        if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($user);
        }

        if ($loadedPost && $user->validate()) {

            $user->setPassword($user->newPassword);

            // save , set flash, and refresh page
            // echo '<pre>'; print_r($user);die
            if($user->save()){
                Yii::$app->session->setFlash('messeage','You have successfully change your password');
                Yii::$app->user->logout();

                return $this->goHome();
            }
            // $session = Yii::$app->session;
            // unset($session['old_id']);
            // unset($session['timestamp']);
            // $session->destroy();
            return $this->refresh();
        }

        // render
        return $this->render("change_password",[
            'user'=>$user,
        ]);
        
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
