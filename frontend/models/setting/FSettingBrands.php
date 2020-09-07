<?php

namespace frontend\models\setting;

use Yii;

/**
 * This is the model class for table "tbl_setting_brands".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $alt
 * @property string $description
 * @property string $link
 * @property double $order
 * @property int $status
 */
class FSettingBrands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_setting_brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image', 'alt'], 'required'],
            [['description'], 'string'],
            [['order'], 'number'],
            [['status'], 'integer'],
            [['name', 'image', 'alt', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'alt' => 'Alt',
            'description' => 'Description',
            'link' => 'Link',
            'order' => 'Order',
            'status' => 'Status',
        ];
    }

    public function getAllBrands($status = 1)
    {
        return self::find()->select(['name','image','alt','link'])->asArray()->where('status =:Status',['Status'=>$status])->orderBy(['order' => SORT_ASC])->all();
    }
}
