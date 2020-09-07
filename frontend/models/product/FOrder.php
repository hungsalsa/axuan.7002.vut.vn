<?php

namespace frontend\models\product;

use Yii;

/**
 * This is the model class for table "tbl_order".
 *
 * @property int $order_id
 * @property int $user_id
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property int $delivery_date ngày giao hàng
 * @property string $user_ship người đi ship
 * @property string $mobile_ship
 * @property int $status 0: mới order; 12- đang giao hàng; 2- đã hoàn thành; 3-hủy
 * @property int $created_at
 * @property int $updated_at
 * @property int $userUpdated
 */
class FOrder extends \yii\db\ActiveRecord
{
    // public $reCaptcha;
    public static function tableName()
    {
        return 'tbl_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'delivery_date', 'status', 'created_at', 'updated_at', 'userUpdated','customer_id'], 'integer'],
            [['status', 'created_at', 'updated_at','payment_orders'], 'required'],
            [['user_ship','payment_orders'], 'string', 'max' => 255],
            [['mobile_ship'], 'string', 'max' => 12],
            [['note'], 'string'],
             // ['email', 'email', 'message' => '{attribute} không đúng định dạng'],
             // [['phone'], 'match', 'pattern' => '/(0)[0-9]{9}/','message' => '{attribute} bao gồm các chữ số bắt đầu bằng 0'],
             // [['people_id'], 'match', 'pattern' => '/[^0-9]/','message' => '{attribute} bao gồm các chữ số'],
             // [['people_id'], 'match', 'pattern' => '/^[0-9]+$/','message' => '{attribute} bao gồm các số'],
             // ['people_id', 'string', 'length' => [9, 12],'message' => '{attribute} từ 9 đến 12 ký tự'],
             # [['phone'], 'match', 'pattern' => '/((\+[0-9]{6})|0)[-]?[0-9]{7}/'],
            // [['reCaptcha'], 'safe'],
            // [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
            //     'secret' => '6LfOlOsUAAAAAChB428ac2Ih5PRaccF5SJOAESoM', // unnecessary if reСaptcha is already configured
            //     'threshold' => 0.5,
            //     'action' => 'index',
            // ],
            // [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
            // 'secret' => '6LdIl-sUAAAAAN5BgPf5DXpmk6yJAjUR-lb_ru-J', // unnecessary if reСaptcha is already configured
            // 'uncheckedMessage' => 'Please confirm that you are not a bot.'],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'user_id' => 'User ID',
            'customer_id' => 'Khách hàng',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'phone' => 'Phone',
            'people_id' => 'Số chứng minh thư',
            'payment_orders' => 'Hình thức thanh toán',
            'address' => 'Address',
            'delivery_date' => 'Delivery Date',
            'user_ship' => 'User Ship',
            'mobile_ship' => 'Mobile Ship',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getKhachhang()
    {
        return $this->hasOne(Customers::className(),['id'=>'customer_id'])->andOnCondition(['type' => 'shopping']);
    }

    public function getSearchPeopleId($peopleId)
    {
        return self::find()->where('people_id=:status',[':status'=>$peopleId])->all();
    }
}
