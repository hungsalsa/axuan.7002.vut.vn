<?php

namespace quantri\modules\news\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_downloads".
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $category_slug
 * @property double $sort
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $userCreated
 * @property int $userUpdated
 */
class Downloads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_downloads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'link'], 'required','message'=>'{attribute} không được để trống'],
            [['descriptions'], 'string'],
            [['sort', 'status'], 'number'],
            [['status', 'created_at', 'updated_at', 'userCreated', 'userUpdated','cate_id'], 'integer'],
            [['name', 'link', 'category_slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'link' => 'Đường dẫn',
            'cate_id' => 'Danh mục',
            'category_slug' => 'Danh mục url',
            'sort' => 'Sắp xếp',
            'status' => 'Trạng thái',
            'descriptions' => 'Mô tả',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }

    public function getCategories()
    {
        return $this->hasOne(Categories::className(),['id'=>'cate_id']);
    }

    public function getUserUpdate()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userUpdated']);
    }
    

    public function getAllDownloads()
    {
        return ArrayHelper::map(self::find()->select(['id','name'])->where('status =:Status',['Status'=>1])->orderBy(['name' => SORT_ASC])->all(),'id','name');
    }
}