<?php

namespace quantri\modules\products\models;

use Yii;

/**
 * This is the model class for table "tbl_product_versions".
 *
 * @property int $id
 * @property int $pro_id
 * @property string $name
 * @property double $price
 * @property double $price_sale
 * @property int $status
 */
class ProductVersions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_product_versions';
    }

    /**
     * {@inheritdoc}
     */
     public function rules()
    {
        return [
            [['pro_id', 'name', 'price_1', 'status'], 'required'],
            [['pro_id','status'], 'integer'],
            [['date'], 'safe'],
            [['price_1', 'price_sale_1', 'price_2', 'price_3'], 'number'],
            [['name'], 'string', 'max' => 255],
            // [['pro_id', 'name', 'price_sale_1'], 'unique', 'targetAttribute' => ['pro_id', 'name', 'price_sale_1']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_id' => 'pro_id',
            'date' => 'Ngày',
            'name' => 'Tên',
            'price_1' => 'Giá bán',
            'price_sale_1' => 'Giá khuyến mãi',
            'price_2' => 'Giá 2',
            'price_3' => 'Giá 3',
            'status' => 'Trạng thái',
        ];
    }
}