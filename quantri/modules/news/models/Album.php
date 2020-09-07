<?php

namespace quantri\modules\news\models;

use Yii;
use yii\helpers\ArrayHelper;

class Album extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_album';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required','message'=>'{attribute} không được để trống'],
            [['content', 'keywords', 'descriptions','short_description'], 'string'],
            [['status', 'created_at', 'updated_at', 'userCreated', 'userUpdated', 'cate_id','view'], 'integer'],
            [['sort'], 'number'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên Album',
            'slug' => 'Đường dẫn',
            'cate_id' => 'Danh mục',
            'content' => 'Chi tiết',
            'title' => 'Title',
            'view' => 'view',
            'short_description' => 'Mô tả ngắn',
            'keywords' => 'Keywords',
            'descriptions' => 'Description',
            'status' => 'Trạng thái',
            'sort' => 'Sắp xếp',
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

    public function getImage_album()
    {
        return $this->hasMany(AlbumImages::className(),['album_id'=>'id']);
    }

    public function getAllAlbums()
    {
        return ArrayHelper::map(self::find()->select(['id','name'])->where('status =:Status',['Status'=>1])->orderBy(['name' => SORT_ASC])->all(),'id','name');
    }
}