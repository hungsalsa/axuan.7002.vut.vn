<?php

namespace quantri\modules\setting\models;

use Yii;

/**
 * This is the model class for table "tbl_setting_tabs".
 *
 * @property int $id
 * @property int $link_cate
 * @property string $slug
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $userCreated
 * @property int $userUpdated
 */
class SettingTabs extends \yii\db\ActiveRecord
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
            [['link_cate', 'status'], 'required'],
            [['link_cate', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 150],
            [['order'], 'number'],
            [['child_cate'], 'string'],
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
            'link_cate' => 'Liên kết sản phẩm',
            'slug' => 'Đường dẫn',
            'name' => 'Tên',
            'order' => 'Sắp xếp',
            'title' => 'Title',
            'child_cate' => 'child_cate',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }
}