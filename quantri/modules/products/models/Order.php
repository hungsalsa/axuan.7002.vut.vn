<?php

namespace quantri\modules\products\models;

use Yii;
use quantri\modules\customer\models\Customers;

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
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'user_id' => 'Người tiếp nhận',
            'customer_id' => 'Khách hàng',
            'payment_orders' => 'Cách thanh toán',
            'delivery_date' => 'Ngày nhận đơn',
            'user_ship' => 'Nhân viên ship',
            'mobile_ship' => 'Số điện nhân viên',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày nhận',
            'userUpdated' => 'Người tiếp nhận',
        ];
    }

    public function getDetails()
    {
        return $this->hasMany(OrderDetail::className(),['order_id'=>'order_id']);
    }

    public function getVersions()
    {
        return $this->hasMany(OrderDetail::className(),['order_id'=>'order_id']);
    }

    public function getUser()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userUpdated']);
    }

    public function getKhachhang()
    {
        return $this->hasOne(Customers::className(),['id'=>'customer_id'])->andOnCondition(['type' => 'shopping']);
    }

    // laays danh sách các khách hàng nếu xóa sản phẩm
    public function getAllCustomerByPro($id_pro)
    {
        return self::find()->alias('o')
                ->select(['o.order_id'])
                ->joinWith([
                    // 'imageList as i' => function (\yii\db\ActiveQuery $query){
                    'details as d' => function (\yii\db\ActiveQuery $query) use ($id_pro){
                        // $query->select(['d.pro_id','d.pro_name','d.pro_id','d.order_id']);
                        $query->where(['d.pro_id' => $id_pro]);
                        // $query->orderBy(['i.order'=>SORT_ASC]);
                        // $query->andWhere(['<>','pd.slug', $slug]);
                        // $query->orderBy([
                        //     'i.order' => SORT_ASC,
                        //     'i.updated_at' => SORT_DESC,
                        // ]);
                        // $query->limit($offset)->offset($limit);
                    },
                ],true)
                ->all();
                 // $data;
    }

    public function getCountOrder()
    {
        $data = self::find()->alias('o')->select(['order_id','status','customer_id'])
        ->with([
            'khachhang' => function (\yii\db\ActiveQuery $query){
                $query->select(['id','fullname','phone','email']);
                // $query->orderBy([
                //     'i.order' => SORT_ASC,
                //     'i.updated_at' => SORT_DESC,
                // ]);
            },
        ])
        ;
        // 
        $result['total'] = $data->count();
        $result['not_activated'] = $data->where('status=:status',[':status'=>0])->count();
        $result['rows'] = $data->all();
        return $result;
    }
}