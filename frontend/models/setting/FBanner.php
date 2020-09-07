<?php

namespace frontend\models\setting;

use Yii;

/**
 * This is the model class for table "tbl_banner".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $url
 * @property string $alt
 * @property double $order
 * @property string $content
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $userCreated
 * @property int $userUpdated
 */
class FBanner extends \yii\db\ActiveRecord
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
            [['image', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required'],
            [['order'], 'number'],
            [['content'], 'string'],
            [['created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['name', 'image', 'url', 'alt'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'url' => 'Url',
            'alt' => 'Alt',
            'order' => 'Order',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getAllBanner($status = 1)
    {
        return self::find()->select(['name','image','url','alt','content','order'])->asArray()->where('status =:Status',['Status'=>$status])->orderBy(['order' => SORT_ASC,'updated_at' => SORT_DESC])->all();
    }
}
