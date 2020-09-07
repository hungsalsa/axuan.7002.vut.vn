<?php

namespace quantri\modules\setting\models;

use Yii;

/**
 * This is the model class for table "tbl_banner".
 *
 * @property int $id
 * @property string $image
 * @property string $url
 * @property string $alt
 * @property int $order
 * @property string $content
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $userCreated
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'image', */'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated','alt','name', 'image'], 'required','message'=>'{attribute} không được để trống'],
            [['created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['content'], 'string'],
            [['order'], 'number'],
            [['url'], 'string', 'max' => 255],
            // [['status'], 'string', 'max' => 4],
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
            'url' => 'Liên kết',
            'alt' => 'Alt',
            'order' => 'Sắp xếp',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người sửa',
            'userUpdated' => 'Người sửa',
        ];
    }


    public function checkBannerImage($id,$image)
    {
        return self::find()->where(['image'=>$image])
        ->andWhere(['!=','id',$id])
        ->count();
    }
}