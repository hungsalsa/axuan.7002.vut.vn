<?php
namespace quantri\models;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use quantri\models\User;
/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $newPasswordConfirm;
    public function rules()
    {
        return [
            [['password','newPasswordConfirm'], 'required'],
            ['password', 'string', 'min' => 6],
            // ['password', 'match', 'pattern' => '/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/'],
            [['newPasswordConfirm'],'compare' , 'compareAttribute'=> 'password','message'=>'Hai mật khẩu không giống nhau'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'password' => 'Mật khẩu mới',
            'newPasswordConfirm' => 'Nhập lại mật khẩu mới',
        ];
    }

   /* public function findPasswords($attribute, $params){
        $user = UserIdentity::find()->where([
            'username'=>Yii::$app->user->identity->username
        ])->one();


        $password = $user->password_hash;  //returns current password as stored in the dbase

        $hash2 = Yii::$app->security->generatePasswordHash($this->oldpass); //generates an encrypted password

           if($password!= $hash2)
           {
                    $this->addError($attribute, 'Old password is incorrect');
           }

    }*/
    
    public function resetPassword($id,$password)
    {

        $user = User::findOne($id);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->removePasswordResetToken();
        $user->save(false);
        return $user->username;
    }
}