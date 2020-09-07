<?php namespace frontend\controllers;use frontend\common\Cart;use frontend\models\product\FOrder;use frontend\models\product\FOrderDetail;use frontend\models\product\FProduct;use frontend\models\product\FProductVersions;use Yii;use yii\filters\AccessControl;use yii\filters\VerbFilter;use yii\web\Response;use yii\web\Session;use yii\widgets\ActiveForm;
class ShoppingController extends \yii\web\Controller
{public function behaviors()
    {return ['access' => ['class' => AccessControl::className(), 'only' => ['logout', 'signup'], 'rules' => [['actions' => ['signup'], 'allow' => true, 'roles' => ['?']], ['actions' => ['logout'], 'allow' => true, 'roles' => ['@']]]], 'verbs' => ['class' => VerbFilter::className(), 'actions' => ['logout' => ['post']]]];}public function actions()
    {return ['error' => ['class' => 'yii\web\ErrorAction'], 'captcha' => ['class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null]];}public function beforeAction($action)
    {$this->enableCsrfValidation = false;return parent::beforeAction($action);}public function actionSuccess()
    {$this->layout = 'shopping';
    $session = Yii::$app->session;
    $model = new FProductVersions();
    $data['khachhang'] = $session['khachhang'];
    $data['cart'] = $session['cart'];return $this->render('success', ['data' => $data]);}public function actionIndex()
    {$this->layout = 'desktop_cart';
    $session = Yii::$app->session;if (empty($session['cart'])) {return $this->redirect(['/']);}$model = new FOrder();if (isset($session['khachhang']) || isset($session['cart'])) {$model->status = 0;
        $model->created_at = $model->updated_at = time();if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {Yii::$app->response->format = Response::FORMAT_JSON;return ActiveForm::validate($model);}if ($post = Yii::$app->request->post()) {$session['khachhang'] = ['fullname' => html_entity_decode($post['FOrder']['fullname']), 'phone' => html_entity_decode($post['FOrder']['phone']), 'email' => html_entity_decode($post['FOrder']['email']), 'address' => html_entity_decode($post['FOrder']['address']), 'payment_orders' => html_entity_decode($post['FOrder']['payment_orders']), 'note' => html_entity_decode($post['FOrder']['note'])];if (isset($session['khachhang'])) {$model->fullname = $session['khachhang']['fullname'];
            $model->email = $session['khachhang']['email'];
            $model->phone = $session['khachhang']['phone'];
            $model->address = $session['khachhang']['address'];
            $model->payment_orders = $session['khachhang']['payment_orders'];
            $model->note = $session['khachhang']['note'];
            $model->created_at = $model->updated_at = time();if ($model->save()) {$data['total'] = 0;foreach ($session['cart'] as $cart) {if (isset($cart['versions'])) {$o_detail = new FOrderDetail();
                $o_detail->order_id = $model->order_id;
                $o_detail->pro_id = $cart['pro_id'];
                $o_detail->pro_version = $cart['idVersion'];
                $o_detail->version_date = $cart['versions']['date'];
                $o_detail->version_price_1 = $cart['versions']['price_1'];
                $o_detail->version_price_sale_1 = $cart['versions']['price_sale_1'];
                $o_detail->version_amount_price_sale_1 = $cart['versions']['amount_price_sale_1'];
                $o_detail->version_price_2 = $cart['versions']['price_2'];
                $o_detail->version_amount_price_2 = $cart['versions']['amount_price_2'];
                $o_detail->version_price_3 = $cart['versions']['price_3'];
                $o_detail->version_amount_price_3 = $cart['versions']['amount_price_3'];
                $o_detail->save();} else { $o_detail = new FOrderDetail();
                $o_detail->order_id = $model->order_id;
                $o_detail->pro_id = $cart['pro_id'];
                $o_detail->pro_version = $cart['idVersion'];
                $o_detail->pro_amount = (int) $cart['amount'];
                $o_detail->pro_price = ($cart['price'] == null) ? 0 : (int) $cart['price'];
                $o_detail->price_sales = ($cart['price_sales'] == null) ? 0 : (int) $cart['price_sales'];
                $o_detail->save();if ($o_detail->errors) {dbg($o_detail->errors);}}}$data['khachhang'] = $session['khachhang'];
                $data['cart'] = $session['cart'];
                $khachhang['khachhang']['hostInfo'] = Yii::$app->request->hostInfo;if (isset($session['khachhang']) && $data['khachhang']['email'] != '') {$setSubject = 'Đơn đặt hàng của Anh/Chị ' . $data['khachhang']['fullname'] . ' từ : ' . $khachhang['khachhang']['hostInfo'];
                    $textBody = $this->actionHtmlbody($data);
                    $model_customer = new \frontend\models\FCustomers();
                    $emailCC = ['nguyenvanxuan@hotmail.com'];if ($model_customer->actionSendEmail($setSubject, $data['khachhang']['email'], $emailCC, $textBody)) {Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị ' . $data['khachhang']['fullname'] . ' đã đặt hàng từ ' . $khachhang['khachhang']['hostInfo']);} else {Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị ' . $khachhang['khachhang']['fullname'] . ' đã đặt hàng từ ' . $khachhang['khachhang']['hostInfo'] . ' | Nhưng thông tin Email của Anh/Chị chúng tôi không gửi được');}}$session->remove('cart');
                $session->remove('khachhang');return $this->render('success', ['data' => $data]);}}if ($model->errors) {dbg($model->errors);}}}return $this->render('index', ['cart' => $session['cart'], 'model' => $model]);}private function actionSendEmail($setSubject, $emailTo, $textBody)
    {$send = Yii::$app->mailer->compose()->setFrom('xuannapp@gmail.com')->setTo($emailTo)->setCc(['nguyenvanxuan@hotmail.com'])->setSubject($setSubject)->setTextBody($setSubject)->setHtmlBody($textBody);if ($send->send()) {return true;} else {return false;}}private function actionHtmlbody($data)
    {return $this->renderAjax('email', ['data' => $data]);}public function actionAddcart($idPro, $idVersion, $number)
    {$product = new FProduct();
    $productinfo = $product->getProductById($idPro);if ($idVersion > 0) {$product = new FProductVersions();
        $productinfo['versions'] = $product->getProversionInfo($idPro);
        $productinfo['versions'] = $productinfo['versions'][$idVersion];
        $productinfo['versions']['amount_price_sale_1'] = $productinfo['versions']['amount_price_2'] = $productinfo['versions']['amount_price_3'] = 1;}$cart = new Cart();
    $cart->addCart($idPro, $idVersion, $productinfo, $number);
    $session = Yii::$app->session;
    $infoCart = $session['cart'];if ($idVersion > 0) {$price_modal = $infoCart[$idPro . $idVersion]['versions']['price_sale_1'];} else { $price_modal = $infoCart[$idPro]['price'];}if ($price_modal > 0) {$infoCart['price_modal'] = number_format($price_modal, 0, '.', '.');} else { $infoCart['price_modal'] = 0;}return $this->renderAjax('cart', ['infoCart' => $infoCart]);}public function actionDelcart($id)
    {$cart = new Cart();
    $cart->delItemCart($id);
    $session = Yii::$app->session;
    $infoCart = $session['cart'];
    $totalAmount = $total = 0;foreach ($infoCart as $value) {$totalAmount += $value['amount'];
        $total += $value['price_sales'] * $value['amount'];}return $this->renderAjax('cart', ['infoCart' => $totalAmount . '-' . $total]);}public function actionUpdatecart($id, $number, $price_attribute)
    {$cart = new Cart();if ($number > 0) {if ($price_attribute) {$cart = $cart->updateCart($id, $number, $price_attribute);} else { $cart = $cart->updateCart($id, $number);}} else { $cart = $cart->delItemCart($id);}$session = Yii::$app->session;
    $infoCart = $session['cart'];return $this->renderAjax('update', ['cart' => $session['cart']]);}public function actionDeletecart($id)
    {$cart = new Cart();
    $cart = $cart->delItemCart($id);
    $session = Yii::$app->session;
    $infoCart = $session['cart'];if (empty($infoCart)) {Yii::$app->session->setFlash('messeage', "Giỏ hàng của bạn đang rỗng !");return $this->redirect(['/']);}return $this->renderAjax('update', ['cart' => $session['cart']]);}}