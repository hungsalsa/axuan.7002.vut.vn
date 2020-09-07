<?php

namespace quantri\modules\customer\controllers;

use Yii;
use quantri\modules\customer\models\Contacts;
use quantri\modules\customer\models\ContactsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacts model.
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

    /**
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contacts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contacts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

     public function actionQuickchange($id)
    {
        try {
            $model = $this->findModel($id);
            // dbg($model);
            // if (Yii::$app->user->identity->getRoleName()=='author' && $model->userCreated != getUser()->id) {
            //     return json_encode(["postValue" => "Bài này không phải do bạn tạo, bạn không thể sửa \n Hãy liên hệ admin"]);
            // }

            // $authAssis = new AuthAssignment();
            // // Lấy quyền của usẻ đăng nhập
            // $perrmission = $authAssis->PermissionUser($model->userCreated);
            // $perrmission_login = $authAssis->PermissionUser(getUser()->id);

            // if ($perrmission_login !='admin' && $model->userCreated != getUser()->id ) {
            //     $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
            //     $return =  "Bài này do $result[$perrmission] : ".$model->userCreated->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn";
            //     return json_encode(["postValue" => $return]);
            // }

            if ($model->status==0) {
                $model->status = 1;
                $postValue = ' Đã tiếp nhận';
            } else {
                $model->status = 0;
                $postValue = 'Chưa tiếp nhận';
            }
            $result = [
                'id' => $id,
                'value_post' => $model->status,
                'name' => $model->company_name,
                'field' => 'status',
                'message' => 'Bạn '.$postValue.' hội viên :' .$model->company_name,
            ];
            $result = array_merge($result,["postValue" => $postValue]);

            $model->updated_at = time();
            $model->userUpdated = getUser()->id;
    // dbg($model);
            if($model->save()==true) {
                return json_encode($result);
            }else {
                $erros = $model->errors;
                $result = ["error" => $erros]+$result;
                return json_encode($result);
            }
        } catch (\Exception $e) {
            $result = ["error" => 'Loi roi : '.$e->getMessage().' In File : '.$e->getFile().' In Line : '.$e->getLine()];
            return json_encode($result);
        }
        
    }

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
