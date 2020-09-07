<?php

namespace frontend\models\product;

use Yii;

/**
 * This is the model class for table "tbl_order_detail".
 *
 * @property int $order_detail_id
 * @property int $order_id
 * @property int $pro_id
 * @property int $pro_version
 * @property int $pro_amount
 * @property int $pro_price
 */
class FOrderDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_order_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'pro_id'], 'required'],
            [['order_id', 'pro_id', 'pro_amount', 'pro_price', 'price_sales', 'pro_version', 'version_price_1', 'version_amount_price_sale_1', 'version_price_sale_1', 'version_price_2', 'version_amount_price_2', 'version_price_3', 'version_amount_price_3'], 'integer'],
            [['version_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_detail_id' => 'Order Detail ID',
            'order_id' => 'Order ID',
            'pro_id' => 'Pro ID',
            'slug' => 'Slug',
            'slugCate' => 'Slug Cate',
            'pro_name' => 'Pro Name',
            'pro_amount' => 'Pro Amount',
            'pro_price' => 'Pro Price',
            'price_sales' => 'Price Sales',
            'pro_version' => 'Pro Version',
            'version_date' => 'Version Date',
            'version_name' => 'Version Name',
            'version_price_1' => 'Version Price 1',
            'version_amount_price_sale_1' => 'Version Amount Price Sale 1',
            'version_price_sale_1' => 'Version Price Sale 1',
            'version_price_2' => 'Version Price 2',
            'version_amount_price_2' => 'Version Amount Price 2',
            'version_price_3' => 'Version Price 3',
            'version_amount_price_3' => 'Version Amount Price 3',
        ];
    }
}
