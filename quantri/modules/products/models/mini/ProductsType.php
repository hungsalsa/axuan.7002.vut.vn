<?php

namespace quantri\modules\products\models;

use Yii;
use yii\helpers\ArrayHelper;
class ProductsType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_products_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['typeName', 'status'], 'required'],
            [['status'], 'integer'],
            [['typeName'], 'string', 'max' => 255],
            [['typeName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code_type' => 'Code Type',
            'typeName' => 'Type Name',
            'status' => 'Status',
        ];
    }

    public function getAllProductsType()
    {
        return ArrayHelper::map(self::find()->asArray()->where('status =:Status',['Status'=>1])->orderBy(['typeName' => SORT_ASC, ])->all(),'code_type','typeName');
    }
}
