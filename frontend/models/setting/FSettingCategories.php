<?php

namespace frontend\models\setting;

use Yii;
use frontend\models\product\FProductCategory;

class FSettingCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_setting_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'link_cate', 'slug_cate', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required'],
            [['type', 'parent_id', 'link_cate', 'order', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['description'], 'string'],
            [['name', 'slug_cate', 'title', 'icon'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'parent_id' => 'Parent ID',
            'link_cate' => 'Link Cate',
            'slug_cate' => 'Slug Cate',
            'title' => 'Title',
            'description' => 'Description',
            'order' => 'Order',
            'icon' => 'Icon',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(FProductCategory::className(),['idCate'=>'link_cate']);
    }
    public function getParent()
    {
        return $this->hasMany(self::className(),['id'=>'parent_id']);
    }
    public function getChildrent()
    {
        return $this->hasMany(self::className(),['parent_id'=>'id']);
    }

    // public function getSidebar($parent=0,$status = true)
    // {
    //     $data = self::find()->alias('sc')
    //     ->select(['sc.id','sc.name','sc.type','sc.link_cate','ca.cateName','ca.slug','sc.parent_id'])
    //         // ->joinWith(['category ca',true])
    //     ->innerJoinWith('category ca',false)
    //     ->where('sc.status=:active AND sc.parent_id=:parent',[':active'=>$status,':parent'=>$parent])->orderBy(['sc.order' => SORT_ASC,'sc.created_at' => SORT_DESC])
    //     ->asArray()
    //     ->all();
    //     $result = $data;
    //     foreach ($data as $key => $value) {
    //         if(!empty($child = self::getSidebar($value['id'])))
    //         $result[$key]['child'] = $child;
    //     }
    //     return $result;
    // }

    private function getSidebar($parent=0,$status = true)
    {
        $data = self::find()->alias('sc')
        ->select(['sc.id','sc.name','sc.type','sc.link_cate','ca.cateName','ca.slug','sc.parent_id'])
            // ->joinWith(['category ca',true])
        ->innerJoinWith('category ca',false)
        ->where('sc.status=:active AND sc.parent_id=:parent',[':active'=>$status,':parent'=>$parent])->orderBy(['sc.order' => SORT_ASC,'sc.created_at' => SORT_DESC])
        ->asArray()
        ->all();
        
        return $data;
    }

    public function getAllCategory($parent=0,$status = true)
    {
        $data = $this->getSidebar();
        foreach ($data as $key => $value) {
            $data[$key]['child'] = $this->getSidebar($value['id']);
        }
        
        return $data;
    }
}
