<?php

namespace quantri\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $type
 * @property string $value
 * @property int $link
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'link','slugTag','name'], 'required'],
            [['link'], 'integer'],
            [['type'], 'string', 'max' => 20],
            [['value','slugTag','name'], 'string', 'max' => 255],
            [['type', 'value', 'link'], 'unique', 'targetAttribute' => ['type', 'value', 'link']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Loại',
            'name' => 'Tên thẻ',
            'value' => 'Giá trị',
            'link' => 'Liên kết',
        ];
    }

    /*public function getProduct()
    {
        return $this->hasOne(\quantri\modules\products\models\Products::className(),['id'=>'link']);
    }*/


    /*Hàm lấy tất cả các tags sử dụng tạo mới*/
    public function getAllTags($type='product')
    {
        return yii\helpers\ArrayHelper::map(self::find()->where('type=:type',[':type'=>$type])->all(),'value','value');
    }

    /*Hàm lấy tất cả các tags theo loại, sản phẩm , tin tức, 
    sử dụng cho cập nhật*/
    public function getAllTagsBytype($type='product',$link)
    {
        return self::find()->where('type=:type AND link=:link',[':type'=>$type,':link'=>$link])->indexBy('id')->all();
    }
}
