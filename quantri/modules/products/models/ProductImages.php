<?php

namespace quantri\modules\products\models;

use Yii;

/**
 * This is the model class for table "tbl_product_images".
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property string $seo_alt
 * @property int $created_at
 * @property int $updated_at
 */
class ProductImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_product_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pro_id', 'image','status'], 'required'],
            [['pro_id', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['order'], 'number'],
            [['image', 'title', 'alt'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idIma' => 'Id Ima',
            'pro_id' => 'Pro ID',
            'image' => 'Image',
            'title' => 'Title',
            'alt' => 'Alt',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getAllImageBy($idpro)
    {
       return self::find()->where('pro_id=:id',['id'=>$idpro])->all();
       
    }
}
