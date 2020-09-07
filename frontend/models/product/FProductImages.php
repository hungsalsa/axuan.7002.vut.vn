<?php

namespace frontend\models\product;

use Yii;

/**
 * This is the model class for table "tbl_imgpro_list".
 *
 * @property int $idIma
 * @property int $pro_id
 * @property string $image
 * @property string $title
 * @property string $alt
 * @property int $status
 */
class FProductImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_images';
    }

    public function rules()
    {
        return [
            [['pro_id', 'image', 'status'], 'required'],
            [['pro_id', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }
}
