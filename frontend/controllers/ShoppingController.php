<?php
namespace frontend\controllers;
use frontend\models\product\FProduct;
use frontend\models\product\FProductVersions;
use frontend\models\product\FOrder;
use frontend\models\product\FOrderDetail;
use frontend\models\FCustomers;
use frontend\common\Cart;
use Yii;
use yii\web\Session;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
class ShoppingController extends \yii\web\Controller
{
    public function behaviors()
    {
        return ['access' => ['class' => AccessControl::className() , 'only' => ['logout', 'signup'], 'rules' => [['actions' => ['signup'], 'allow' => true, 'roles' => ['?'], ], ['actions' => ['logout'], 'allow' => true, 'roles' => ['@'], ], ], ], 'verbs' => ['class' => VerbFilter::className() , 'actions' => ['logout' => ['post'], ], ], ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return ['error' => ['class' => 'yii\web\ErrorAction', ], 'captcha' => ['class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null, ], ];
    }
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actionSuccess()
    {
        $this->layout = 'shopping';
        $session = Yii::$app->session;
        $model = new FProductVersions();
        $data['khachhang'] = $session['khachhang'];
        $data['cart'] = $session['cart'];

        return $this->render('success', ['data' => $data]);
    }

    public function actionIndex()
    {
        $this->layout = 'desktop_cart';
        $session = Yii::$app->session;

        if (empty($session['cart']))
        {
            // Yii::$app->session->setFlash('messeage', "Giỏ hàng của bạn đang rỗng !");
            return $this->redirect(['/']);
        }

        $model = new FOrder();
        // $customers = new \frontend\models\FCustomers();
        if (isset($session['khachhang']) || isset($session['cart']))
        {
            $model_khachhang = new FCustomers();
            $model->status = 0;
            $model->created_at = $model->updated_at = time();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            $transaction = Yii::$app->db->beginTransaction();
            try
            {
                if ($post = Yii::$app ->request ->post())
                {
                    // dbg($post);
                    $session['khachhang'] = ['fullname' => html_entity_decode($post['FCustomers']['fullname']) , 'phone' => html_entity_decode($post['FCustomers']['phone']) , 'email' => html_entity_decode($post['FCustomers']['email']) , 'address' => html_entity_decode($post['FCustomers']['address']) , 'payment_orders' => html_entity_decode($post['FOrder']['payment_orders']) , 'note' => html_entity_decode($post['FOrder']['note']) , ];
                    if (isset($session['khachhang']))
                    {
                        // $model = new FOrder();
                        $model_khachhang->fullname = $session['khachhang']['fullname'];
                        $model_khachhang->email = $session['khachhang']['email'];
                        $model_khachhang->phone = $session['khachhang']['phone'];
                        $model_khachhang->address = $session['khachhang']['address'];
                        $model_khachhang->type = 'shopping';
                        $model_khachhang->id_link =0;
                        $model_khachhang->url = 'shopping';
                        $model_khachhang->created_at = $model_khachhang->updated_at = time();
                        if ($model_khachhang->save())
                        {
                            $model->payment_orders = $session['khachhang']['payment_orders'];
                            $model->note = $session['khachhang']['note'];
                            $model->customer_id = $model_khachhang->id;
                            $model->created_at = $model->updated_at = time();

                            if ($model->save())
                            {
                                $data['total'] = 0;
                                foreach ($session['cart'] as $cart)
                                {
                                    if (isset($cart['versions']))
                                    {
                                        $o_detail = new FOrderDetail();
                                        $o_detail->order_id = $model->order_id;
                                        $o_detail->pro_id = $cart['pro_id'];

                                        $o_detail->pro_version = $cart['idVersion'];
                                        $o_detail->version_date = $cart['versions']['date'];

                                        $o_detail->version_price_1 = $cart['versions']['price_1'];
                                        $o_detail->version_price_sale_1 = $cart['versions']['price_sale_1'];
                                        $o_detail->version_amount_price_sale_1 = $cart['versions']['amount_price_sale_1'];
                                        // $data['total'] += (int)$o_detail->version_price_1*$o_detail->version_amount_price_sale_1;
                                        $o_detail->version_price_2 = $cart['versions']['price_2'];
                                        $o_detail->version_amount_price_2 = $cart['versions']['amount_price_2'];
                                        // $data['total'] += (int)$o_detail->version_price_2*$o_detail->version_amount_price_2;
                                        $o_detail->version_price_3 = $cart['versions']['price_3'];
                                        $o_detail->version_amount_price_3 = $cart['versions']['amount_price_3'];
                                        // $data['total'] += (int)$o_detail->version_price_3*$o_detail->version_amount_price_3;
                                        $o_detail->save();
                                        // if($o_detail->errors)pr('head');dbg($o_detail->errors);
                                        
                                    }
                                    else
                                    {
                                        $o_detail = new FOrderDetail();
                                        $o_detail->order_id = $model->order_id;
                                        $o_detail->pro_id = $cart['pro_id'];
                                        $o_detail->pro_version = $cart['idVersion'];
                                        $o_detail->pro_amount = (int)$cart['amount'];
                                        $o_detail->pro_price = ($cart['price'] == null) ? 0 : (int)$cart['price'];
                                        $o_detail->price_sales = ($cart['price_sales'] == null) ? 0 : (int)$cart['price_sales'];
                                        // $data['total'] += (int)$o_detail->pro_price*$o_detail->pro_amount;
                                        $o_detail->save();
                                        // if($o_detail->errors)pr($o_detail);dbg($o_detail->errors);
                                        if ($o_detail->errors)
                                        {
                                            dbg($o_detail->errors);
                                        }

                                    }
                                }
                                $data['khachhang'] = $session['khachhang'];
                                $data['cart'] = $session['cart'];
                                $khachhang['khachhang']['hostInfo'] = Yii::$app
                                    ->request->hostInfo;
                                $transaction->commit();
                                if (isset($session['khachhang']) && $data['khachhang']['email'] != '')
                                {
                                    $setSubject = 'Đơn đặt hàng của Anh/Chị ' . $data['khachhang']['fullname'] . ' từ : ' . $khachhang['khachhang']['hostInfo'];
                                    $textBody = $this->actionHtmlbody($data);
                                    // $textBody = $this->actionSendEmail($setSubject,$data['khachhang']['email'],$textBody);
                                    $model_customer = new \frontend\models\FCustomers();
                                    $emailCC = ['nguyensonqang240@gmail.com'];

                                    if ($model_customer->actionSendEmail($setSubject, $data['khachhang']['email'], $emailCC, $textBody))
                                    {
                                        Yii::$app ->session ->setFlash('messeage', 'Cảm ơn Anh/Chị ' . $data['khachhang']['fullname'] . ' đã đặt hàng từ ' . $khachhang['khachhang']['hostInfo']);
                                    }
                                    else
                                    {
                                        Yii::$app ->session ->setFlash('messeage', 'Cảm ơn Anh/Chị ' . $khachhang['khachhang']['fullname'] . ' đã đặt hàng từ ' . $khachhang['khachhang']['hostInfo'] . ' | Nhưng thông tin Email của Anh/Chị chúng tôi không gửi được');
                                    }

                                }

                                $session->remove('cart');
                                $session->remove('khachhang');
                                return $this->render('success', ['data' => $data]);
                            }
                           /* else {
                                dbg($model->errors);
                            }*/
                        }
                        /*else {
                            dbg($model_khachhang->errors);
                        }*/
                    }
                    
/*
                    if ($model->errors)
                    {
                        dbg($model->errors);
                    }*/
                }
                //END TRY
                
            }
            catch(Exception $e)
            {
                $transaction->rollBack();
                pr('rollback');
                dbg($e->getMessage() . ' In Line : ' . $e->getLine());
            }

        }
        return $this->render('index', ['cart' => $session['cart'], 'model' => $model, 'model_khachhang' => $model_khachhang]);
    }

    private function actionSendEmail($setSubject, $emailTo, $textBody)
    {
        $send = Yii::$app
            ->mailer
            ->compose()
            ->setFrom('minhlam26889@gmail.com')
            ->setTo($emailTo)
        // ->setTo('nguyequoccuong90@gmail.com')
        ->setCc(['nguyensonqang240@gmail.com'])
            ->setSubject($setSubject)->setTextBody($setSubject)->setHtmlBody($textBody);
        if ($send->send())
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    private function actionHtmlbody($data)
    {
        return $this->renderAjax('email', ['data' => $data]);
    }

    public function actionAddcart($idPro, $idVersion, $number)
    {

        $product = new FProduct();
        $productinfo = $product->getProductById($idPro);
        if ($idVersion > 0)
        {
            $product = new FProductVersions();
            $productinfo['versions'] = $product->getProversionInfo($idPro);
            $productinfo['versions'] = $productinfo['versions'][$idVersion];
            $productinfo['versions']['amount_price_sale_1'] = 1;
            $productinfo['versions']['amount_price_2'] = $productinfo['versions']['amount_price_3'] = 0;
        }

        // dbg($productinfo);
        $cart = new Cart();
        $cart->addCart($idPro, $idVersion, $productinfo, $number);

        $session = Yii::$app->session;

        $infoCart = $session['cart'];

        if ($idVersion > 0)
        {
            $price_modal = $infoCart[$idPro . $idVersion]['versions']['price_sale_1'];
        }
        else
        {
            $price_modal = $infoCart[$idPro]['price'];
        }
        if ($price_modal > 0)
        {
            $infoCart['price_modal'] = number_format($price_modal, 0, '.', '.');

        }
        else
        {
            $infoCart['price_modal'] = 0;

        }
        // $totalAmount = $total =0;
        // foreach ($infoCart as $value) {
        //  $totalAmount += $value['amount'];
        //  $total += $value['price_sales']*$value['amount'];
        // }
        return $this->renderAjax('cart', ['infoCart' => $infoCart]);

    }

    public function actionDelcart($id)
    {
        $cart = new Cart();
        $cart->delItemCart($id);

        $session = Yii::$app->session;
        $infoCart = $session['cart'];

        $totalAmount = $total = 0;
        foreach ($infoCart as $value)
        {
            $totalAmount += $value['amount'];
            $total += $value['price_sales'] * $value['amount'];
        }
        return $this->renderAjax('cart', ['infoCart' => $totalAmount . '-' . $total]);
    }

    public function actionUpdatecart($id, $number, $price_attribute)
    {
        // pr($id);
        // pr($number);
        // pr($price_attribute);
        $cart = new Cart();
        if ($number > 0)
        {
            if ($price_attribute)
            {
                // dbg('có');
                $cart = $cart->updateCart($id, $number, $price_attribute);
            }
            else
            {
                // dbg('ko');
                $cart = $cart->updateCart($id, $number);
            }
        }
        else
        {
            $cart = $cart->delItemCart($id);

        }

        $session = Yii::$app->session;
        $infoCart = $session['cart'];
        // pr($infoCart);
        // $totalAmount = $total =0;
        // foreach ($infoCart as $value) {
        //     $totalAmount += $value['amount'];
        //     $total += $value['price_sales']*$value['amount'];
        // }
        return $this->renderAjax('update', ['cart' => $session['cart']]);
        // return $this->renderPartial('update',['cart'=>$session['cart']]);
        
    }

    public function actionDeletecart($id)
    {
        // pr($price_attribute);
        $cart = new Cart();
        $cart = $cart->delItemCart($id);

        $session = Yii::$app->session;
        $infoCart = $session['cart'];
        if (empty($infoCart))
        {
            Yii::$app
                ->session
                ->setFlash('messeage', "Giỏ hàng của bạn đang rỗng !");
            return $this->redirect(['/']);
        }
        return $this->renderAjax('update', ['cart' => $session['cart']]);
        // return $this->renderPartial('update',['cart'=>$session['cart']]);
        
    }

    public function actionShowCart()
    {
        // $peopleId=2345;
        $model = new \frontend\models\SearchId();
        $data = '';
        if ($post = Yii::$app
            ->request
            ->post('SearchId'))
        {
            $order = new \frontend\models\product\FOrder();
            $data = $order->getSearchPeopleId($post['peopleId']);
            $peopleId = $post['peopleId'];
            pr($peopleId);
            dbg($data);
        }
        return $this->render('showcart', ['model' => $model, 'data' => $data]);
    }

}

