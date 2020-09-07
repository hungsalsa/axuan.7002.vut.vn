<?php

namespace frontend\models\setting;

use Yii;

/**
 * This is the model class for table "tbl_setting_tabs".
 *
 * @property int $id
 * @property int $link_cate
 * @property string $title
 * @property string $slug
 * @property string $name
 * @property double $order
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $userCreated
 * @property int $userUpdated
 */
class FSettingTabs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_setting_tabs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link_cate', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required'],
            [['link_cate', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['order'], 'number'],
            [['title'], 'string', 'max' => 150],
            [['slug', 'name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['link_cate'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_cate' => 'Link Cate',
            'title' => 'Title',
            'slug' => 'Slug',
            'name' => 'Name',
            'order' => 'Order',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getAllTabs($status = 1)
    {
        return self::find()->select(['id','child_cate','name','link_cate','title','slug','order'])->asArray()->where('status =:Status',['Status'=>$status])->orderBy(['order' => SORT_ASC,'updated_at' => SORT_DESC])->all();
    }
}
