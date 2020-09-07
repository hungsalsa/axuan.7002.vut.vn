<?php

namespace quantri\modules\products\models;

use Yii;
use yii\helpers\ArrayHelper;

class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['supName', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required'],
            [['keywords', 'descriptions', 'content'], 'string'],
            [['status', 'order', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['supName', 'title', 'slug', 'address', 'image'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idMan' => 'Id Man',
            'supName' => 'Sup Name',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'descriptions' => 'Descriptions',
            'slug' => 'Slug',
            'phone' => 'Phone',
            'address' => 'Address',
            'image' => 'Image',
            'status' => 'Status',
            'order' => 'Order',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getAllSuppliers()
    {
        return ArrayHelper::map(self::find()->asArray()->where('status =:Status',['Status'=>1])->orderBy(['supName' => SORT_ASC, ])->all(),'idMan','supName');
    }
}
