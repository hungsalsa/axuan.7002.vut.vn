<?php 
namespace frontend\controllers;use frontend\models\news\FDownloads;use frontend\models\news\FCategories;use yii\web\NotFoundHttpException;use frontend\models\setting\FSettingModules;use frontend\models\setting\FSettingModulesPages;use Yii;class DownloadsController extends \yii\web\Controller{public function actionIndex($slugCate,$idCate){$this->layout='news';$modulePage=new FSettingModulesPages();$site=new FSettingModules();$module=$site->getAllSettingModules($modulePage->getModulePages('downloads'));Yii::$app->params['settingModules']=$module;$model=new FCategories();$data['idCate']=$model->getChildCateByslug($slugCate);$data['categories']=$model->getCateInfoById($idCate);$model=new FDownloads();$data['downloads']=$model->findDownloadIndex($data['idCate']);return $this->render('index',['data'=>$data]);}public function actionView($slug){$model=FDownloads::findOne(['link'=>$slug]);$path=Yii::getAlias('@baseroot').$model->link;$image_type=array("jpg","jpeg","gif","png","pdf","rar","zip","docx","xlsx");$ext_type=pathinfo($path,PATHINFO_EXTENSION);if(file_exists($path)){if(in_array($ext_type,$image_type)){return Yii::$app->getResponse()->redirect("$model->link");exit;}return Yii::$app->response->sendFile($path,$model->name);exit;}else{throw new NotFoundHttpException('Dữ liệu này đang cập nhật, xin vui lòng quay lại sau');return $this->render('download404',['data'=>$data]);}}}