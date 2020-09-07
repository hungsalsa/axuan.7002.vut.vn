<?php

namespace quantri\modules\setting\models;

use Yii;

/**
 * This is the model class for table "tbl_setting_brands".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $alt
 * @property string $description
 * @property int $order
 * @property int $status
 */
class SettingBrands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_setting_brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image', 'alt'], 'required','message'=>'{attribute} không được để trống'],
            [['description'], 'string'],
            [['order'], 'number'],
            [['status'], 'integer'],
            [['name', 'image', 'alt', 'link'], 'string', 'max' => 255],
            [['order'], 'default', 'value'=> 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'image' => 'Ảnh',
            'alt' => 'Alt',
            'description' => 'Description',
            'link' => 'Liên kết',
            'order' => 'Sắp xếp',
            'status' => 'Trạng thái',
        ];
    }
}