<?php

namespace frontend\models\setting;

use Yii;
use frontend\models\product\FProductCategory;
use frontend\models\news\FCategories;

class FMenus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_menus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['name', 'slug', 'type', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required'],
            [['type', 'parent_id', 'link_cate', 'order', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['introduction'], 'string'],
            [['name', 'title', 'slug', 'image','parent_name'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
            'title' => 'Title',
            'slug' => 'Slug',
            'type' => 'Type',
            'introduction' => 'Introduction',
            'parent_id' => 'Parent ID',
            'parent_name' => 'Parent name',
            'link_cate' => 'Link Cate',
            'order' => 'Order',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getSanpham()
    {
        return $this->hasOne(FProductCategory::className(),['idCate'=>'link_cate']);//->andOnCondition(['type' => 1]);
    }
    public function getBaiviet()
    {
        return $this->hasOne(FCategories::className(),['id'=>'link_cate']);//->andOnCondition(['type' => 2]);
    }
    public function getParent()
    {
        return $this->hasMany(self::className(),['id'=>'parent_id']);//->andOnCondition(['status' => true]);
    }
    public function getChildrens()
    {
        return $this->hasMany(self::className(),['parent_id'=>'id'])->select(['id','type','link_cate','parent_id','status']);
            // ->andOnCondition(['status' => true]);
            // ->orderBy([
            //     'order' => SORT_ASC,
            //     'created_at' => SORT_DESC,
            // ]);
    }

    public function getAllMenus($parent=0,$status = true)
    {
        return self::find()->alias('m')->select(['m.id','m.name','m.introduction','m.type','m.link_cate','ca.slug slug_cate','cn.slug slug_cateNews','m.image','m.parent_id','m.slug','m.order'])
        ->joinWith(['sanpham ca','baiviet cn'],false)
        ->where('m.status=:active AND m.parent_id=:parent',[':active'=>$status,':parent'=>$parent])
        ->orderBy(['m.order' => SORT_ASC,'m.created_at' => SORT_ASC])->asArray()->all();
    }

    public function getMenusChild_3($parent=0,$status = true)
    {
        return self::find()->alias('m')
        ->select(['m.id','m.name','m.type','m.link_cate','m.parent_id','m.order','ca.slug slug_cate','cn.slug slug_cateNews','m.introduction','m.image'])
        ->joinWith(['sanpham ca','baiviet cn'],false)

        ->joinWith([
            'childrens ch' => function (\yii\db\ActiveQuery $query) {
                $query->select(['ch.id','ch.name','ch.type','ch.link_cate','ch.parent_id','ch.order','ch.status','ca1.slug slug_cate','cn1.slug slug_cateNews','ch.introduction'])
                ->andOnCondition(['ch.status' => true])
                ->joinWith(['sanpham ca1','baiviet cn1'],false)

                ->joinWith([
                    'childrens as ch2' => function (\yii\db\ActiveQuery $query2) {
                        $query2->select(['ch2.id','ch2.name','ch2.parent_name','ch2.type','ch2.link_cate','ch2.parent_id','ch2.slug','ch2.order','ch2.status','ca2.slug slug_cate','cn2.slug slug_cateNews','ch2.introduction'])
                        ->andOnCondition(['ch2.status' => true])
                        ->joinWith(['sanpham ca2','baiviet cn2'],false)
                        ->orderBy([
                            'ch2.order' => SORT_ASC,
                            'ch2.created_at' => SORT_DESC,
                        ]);
                    }
                ])
                ->orderBy([
                    'ch.order' => SORT_ASC,
                    'ch.created_at' => SORT_DESC,
                ]);
            },
        ])
        ->where('m.status=:active AND m.parent_id=:parent',[':active'=>$status,':parent'=>$parent])
        ->orderBy(['m.order' => SORT_ASC,'m.created_at' => SORT_DESC])->asArray()->all();
    }

    /*public function getMenusIDAllChild($idMenu,$type = 1,$link_cate)
    {
        $result[] = $link_cate;
        
        $data = self::find()->alias('m')->select(['m.id','m.link_cate','m.parent_id'])
        ->joinWith([
            'childrens ch' => function (\yii\db\ActiveQuery $query) use ($type) {
                $query->select(['ch.link_cate','ch.parent_id'])
                ->andOnCondition(['ch.type' => $type,'ch.status'=>true]);
            },
        ],true)
        ->where('m.status=:active AND m.parent_id=:parent',[':active'=>true,':parent'=>$idMenu])->asArray()->all();
        foreach ($data as $child_1) {
            $result[] = $child_1['link_cate'];
            if ($child_1['childrens']) {
                foreach ($data as $child_2) {
                    $result[] = $child_2['link_cate'];
                }
                
            }
        }

        return array_unique($result);
    }*/

}
