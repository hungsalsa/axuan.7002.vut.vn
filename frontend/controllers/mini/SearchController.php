<?php
 namespace frontend\controllers;use yii\base\Controller;use yii\filters\AccessControl;use frontend\models\Search;use Yii;use yii\data\ActiveDataProvider;class SearchController extends Controller{public function behaviors(){return['access'=>['class'=>AccessControl::className(),'rules'=>[['allow'=>TRUE,'actions'=>['index','search','view'],'roles'=>['?','@'],]]]];}public function actionTimkiem($keysearch){echo $keysearch;return $this->render('index',['typeSearch'=>$typeSearch]);}public function actionView($typeSearch='',$keySearch=''){$model=new Search();$keySearch=Yii::$app->request->get('keySearch');$typeSearch=Yii::$app->request->get('typeSearch');return $this->render('view',['keySearch'=>$keySearch,'model'=>$model]);}public function actionSearch(){$question=\Yii::$app->request->queryParams['keySearch'];$model=new Search();$keySearch=Yii::$app->request->get('keySearch');$data=new FNews();$data=$data->SearchNew($keySearch);if($keySearch==''){$data=[];}pr($data);return $this->render('view',['data'=>$data,'keySearch'=>$keySearch,'model'=>$model]);}}