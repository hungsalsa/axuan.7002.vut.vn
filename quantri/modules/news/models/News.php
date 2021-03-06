<?php

namespace quantri\modules\news\models;

use Yii;
use yii\helpers\ArrayHelper;
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'newSlug', 'category_id','status', 'userCreated', 'userUpdated', 'created_at', 'updated_at','formshow'], 'required','message'=>'{attribute} không được để trống'],
            [['category_id',  'view','userCreated','userUpdated', 'created_at', 'updated_at'], 'integer'],
            [['htmldescriptions', 'short_description', 'content'], 'string'],
            [['name', 'newSlug', 'images', 'image_category', 'image_detail', 'htmltitle', 'htmlkeyword'], 'string', 'max' => 255],
            // [['related_albums', 'related_downloads'], 'string', 'max' => 500],
            [['newSlug'], 'unique'],
            [['tags'], 'safe'],
            [['related_products','hot', 'status', 'formshow', 'related_news','related_albums', 'related_downloads','interest'], 'safe'],
            [['name'], 'unique'],
            [[ 'sort'], 'number'],
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
            'formshow' => 'Form',
            'newSlug' => 'Đường dẫn',
            'image_category' => 'Image Category',
            'image_detail' => 'Image Detail',
            'htmltitle' => 'Htmltitle',
            'htmlkeyword' => 'Htmlkeyword',
            'htmldescriptions' => 'Htmldescriptions',
            'short_description' => 'Short Description',
            'content' => 'Content',
            'hot' => 'Hot',
            'view' => 'View',
            'related_products' => 'Related Products',
            'related_news' => 'Related News',
            'name' => 'Tên bài viết',
            'images' => 'Ảnh đại diện',
            'image_detail' => 'Image Detail',
            'category_id' => 'Danh mục',
            'htmltitle' => 'Title',
            'htmlkeyword' => 'Keywords',
            'htmldescriptions' => 'Description',
            'short_description' => 'Mô tả ngắn',
            'related_albums' => 'Albums liên quan',
            'related_downloads' => 'Tải files liên quan',
            'content' => 'Chi tiết',
            'tags' => 'Tags',
            'hot' => 'Hot',
            'interest' => 'Quan tâm',
            'view' => 'Lượt xem',
            'related_products' => 'Sản phẩm liên quan',
            'related_news' => 'Bài viết liên quan',
            'sort' => 'Sắp xếp',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }

    public function getAlltags()
    {
        return $this->hasMany(\quantri\models\Tags::className(),['link'=>'id'])->andOnCondition(['type' => 'news']);;
    }

    public function getAllNews()
    {
        return ArrayHelper::map(News::find()->asArray()->where('status =:Status',['Status'=>1])->orderBy(['name' => SORT_ASC, ])->all(),'id','name');
    }

    public function getCategories()
    {
        return $this->hasOne(Categories::className(),['id'=>'category_id']);
    }
    
    public function getUserUpdate()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userUpdated']);
    }
    
    public function getAllIdCategories()
    {
        return  yii\helpers\ArrayHelper::map(self::find()->select(['category_id'])->distinct()->where('status=:status',[':status'=>true])->all(),'category_id','category_id');
    }
    // public function getCatename()
    // {
    //     return $this->categories->cateName;
    // }
}