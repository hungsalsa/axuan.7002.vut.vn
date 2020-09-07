<?php

namespace quantri\modules\products\models;

use Yii;

/**
 * This is the model class for table "tbl_product_property".
 *
 * @property int $id
 * @property string $name
 */
class ProductProperties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_product_property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['code', 'name'], 'string', 'max' => 30],
            [['name'], 'unique'],
            // [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    public function getProductProperties()
    {
        return yii\helpers\ArrayHelper::map(self::find()->all(),'name','name');
    }
}
