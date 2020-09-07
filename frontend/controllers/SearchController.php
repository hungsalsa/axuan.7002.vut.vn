<?php
namespace frontend\controllers;
use yii\base\Controller;
use yii\filters\AccessControl;
use frontend\models\Search;
use Yii;
// use app\modules\quantri\models\FNews;
use yii\data\ActiveDataProvider;

class SearchController extends Controller
{
	public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						//'only'=>['index','search'],
						'rules'=>[
								[
										'allow'=>TRUE,
										'actions'=>['index','search','view'],
										'roles'=>['?','@'],
								]
						]
				]
		];
	}
	
	public function actionTimkiem($keysearch)
	{
		echo $keysearch;
		return $this->render('index',['typeSearch'=>$typeSearch]);
	}
	// public function actionIndex()
	// {
	// 	$keySearch = (string)Yii::$app->request->get('keySearch');
	// 	// $keySearch =mysqli_real_escape_string($keySearch);
	// 	// dbg($keySearch);
	// 	$data = new FNews();
	// 	$data = $data->SearchNew($keySearch);

	// 	if ($keySearch =='') {
	// 		$data = [];
	// 	}

	// 	// pr($keySearch);
 //  //       pr($data);
	// 	// dbg(Yii::$app->request->url);
	// 	return $this->render('index',['data'=>$data,'keySearch'=>$keySearch]);
	// }
	public function actionView($typeSearch='',$keySearch='')
	{
		$model = new Search();
		$keySearch = Yii::$app->request->get('keySearch');
		$typeSearch = Yii::$app->request->get('typeSearch');
		// dbg($keySearch);
		// $data = new FNews();
		// $data = $data->SearchNew($keySearch);

		// if ($keySearch =='') {
		// 	$data = [];
		// }

		// pr($keySearch);
        // pr($data);
		// dbg(Yii::$app->request->url);
		return $this->render('view',['keySearch'=>$keySearch,'model'=>$model]);
		// return $this->render('view',['data'=>$data,'keySearch'=>$keySearch,'model'=>$model]);
	}

	public function actionSearch()
	{
		$question = \Yii::$app->request->queryParams['keySearch'];
		// dbg($question);
		$model = new Search();
		$keySearch = Yii::$app->request->get('keySearch');
		// dbg($keySearch);
		$data = new FNews();
		$data = $data->SearchNew($keySearch);

		if ($keySearch =='') {
			$data = [];
		}

		// pr($keySearch);
        pr($data);
		// dbg(Yii::$app->request->url);
		return $this->render('view',['data'=>$data,'keySearch'=>$keySearch,'model'=>$model]);
	}
}