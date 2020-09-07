<?php
 namespace quantri\models;use Yii;use quantri\modules\auth\models\AuthAssignment;class User extends \yii\db\ActiveRecord{const STATUS_DELETED=0;const STATUS_ACTIVE=10;public $permission;public static function tableName(){return 'user';}public function rules(){return[[['username','auth_key','password_hash','email','created_at','updated_at','permission'],'required'],[['status','created_at','updated_at'],'integer'],[['username','fullname','password_hash','password_reset_token','email','image'],'string','max'=>255],[['auth_key','role'],'string','max'=>32],[['phone'],'string','max'=>12],[['username'],'unique'],[['email'],'unique'],[['password_reset_token'],'unique'],];}public function attributeLabels(){return['id'=>'ID','username'=>'Username','fullname'=>'Fullname','auth_key'=>'Auth Key','password_hash'=>'Password Hash','password_reset_token'=>'Password Reset Token','email'=>'Email','image'=>'Image','phone'=>'Phone','status'=>'Status','created_at'=>'Ngày tạo','updated_at'=>'Updated At',];}public function getAuthUser(){return $this->hasOne(AuthAssignment::className(),['user_id'=>'id']);}public function verifyPassword($password){$dbpassword=static::findOne(['username'=>Yii::$app->user->identity->username,'status'=>self::STATUS_ACTIVE])->password_hash;return Yii::$app->security->validatePassword($password,$dbpassword);}public static function findIdentity($id){return static::findOne(['id'=>$id,'status'=>self::STATUS_ACTIVE]);}public static function findIdentityByAccessToken($token,$type=null){throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');}public static function findByUsername($username){return static::findOne(['username'=>$username,'status'=>self::STATUS_ACTIVE]);}public static function findByPasswordResetToken($token){if(!static::isPasswordResetTokenValid($token)){return null;}return static::findOne(['password_reset_token'=>$token,'status'=>self::STATUS_ACTIVE,]);}public static function isPasswordResetTokenValid($token){if(empty($token)){return false;}$timestamp=(int) substr($token,strrpos($token,'_')+1);$expire=Yii::$app->params['user.passwordResetTokenExpire'];return $timestamp+$expire>=time();}public function getId(){return $this->getPrimaryKey();}public function getAuthKey(){return $this->auth_key;}public function validateAuthKey($authKey){return $this->getAuthKey()===$authKey;}public function validatePassword($password){return Yii::$app->security->validatePassword($password,$this->password_hash);}public function aliuser($setSubject,$emailTo,$emailCC,$textBody){$send=Yii::$app->mailerb->compose()->setFrom('minhlam26889@gmail.com')->setTo($emailTo)->setCc($emailCC)->setSubject($setSubject)->setTextBody($setSubject)->setHtmlBody($textBody);if($send->send()){return true;}else{return false;}}public function setPassword($password){$this->password_hash=Yii::$app->security->generatePasswordHash($password);}public function generateAuthKey(){$this->auth_key=Yii::$app->security->generateRandomString();}public function generatePasswordResetToken(){$this->password_reset_token=Yii::$app->security->generateRandomString().'_'.time();}public function removePasswordResetToken(){$this->password_reset_token=null;}}