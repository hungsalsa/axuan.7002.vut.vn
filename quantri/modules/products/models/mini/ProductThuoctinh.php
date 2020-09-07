<?php

namespace quantri\modules\products\models;

use Yii;

/**
 * This is the model class for table "tbl_product_thuoctinh".
 *
 * @property int $id
 * @property string $name
 * @property int $product_id
 * @property string $value
 */
class ProductThuoctinh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_product_thuoctinh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','value'], 'required'],
            [['product_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['value'], 'string', 'max' => 200],
            [['sort'], 'number'],
            [['name', 'product_id', 'value'], 'unique', 'targetAttribute' => ['name', 'product_id', 'value']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'name' => 'Tên',
            'value' => 'Giá trị',
            'sort' => 'Sắp xếp',
        ];
    }

    public function getAllName()
    {
        $data = self::find()->select('name')->distinct()->all();
        return yii\helpers\ArrayHelper::map($data,'name','name');
    }
}
