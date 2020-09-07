<?php

namespace quantri\modules\setting\models;

use Yii;
use quantri\modules\products\models\Productcategory;

class Menus extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tbl_menus';
    }

    public function rules()
    {
        return [
            [['name', 'type', 'status', 'created_at', 'updated_at', 'userCreated'], 'required'],
            [['type', 'parent_id', 'link_cate', 'created_at', 'updated_at', 'userCreated','status','userUpdated'], 'integer'],
            [['introduction'], 'string'],
            [[ 'order'], 'number'],
            [['name', 'title', 'slug', 'image'], 'string', 'max' => 255],
            // [['status'], 'string', 'max' => 4],
            // [['slug'], 'unique'],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên menu',
            'title' => 'Title',
            'slug' => 'Đường dẫn',
            'type' => 'Loại Menu',
            'introduction' => 'Introduction',
            'parent_id' => 'Menu cha',
            'parent_name' => 'Menu cha',
            'link_cate' => 'Liên kết tới danh mục',
            'order' => 'Sắp xếp',
            'image' => 'Ảnh',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }

    public function getCategoryPro()
    {
        return $this->hasOne(Productcategory::className(),['idCate'=>'link_cate']);
    }

    public function getCateNews()
    {
        return $this->hasOne(\quantri\modules\news\models\Categories::className(),['id'=>'link_cate']);
    }

    public function getUser()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userCreated']);
    }

    public function getUser_update()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userUpdated']);
    }

    public function getParent()
    {
        return $this->hasOne(self::className(),['id'=>'parent_id']);
    }
    public function getChildrens()
    {
        return $this->hasMany(self::className(),['parent_id'=>'id']);//->onCondition(['childrens.status' => true]);
    }

    public function getMenuById($status=true)
    {
        $data = self::find()->alias('m')->select(['m.id','m.name','m.parent_id','m.parent_name'])
                ->joinWith([
                    'childrens as ch_1' => function (\yii\db\ActiveQuery $query2) {
                        $query2->select(['ch_1.id','ch_1.name','ch_1.parent_id','ch_1.status','ch_1.parent_name'])
                            ->andOnCondition(['ch_1.status' => true])
                            ->joinWith([
                                'childrens as ch_2' => function (\yii\db\ActiveQuery $query2) {
                                    $query2->select(['ch_2.id','ch_2.name','ch_2.parent_id','ch_2.status','ch_2.parent_name'])
                                    ->andOnCondition(['ch_2.status' => true])
                                    ->orderBy([
                                        'ch_2.order' => SORT_ASC,
                                        'ch_2.created_at' => SORT_DESC,
                                    ]);
                                }
                            ])
                            ->orderBy([
                                'ch_1.order' => SORT_ASC,
                                'ch_1.created_at' => SORT_DESC,
                        ]);
                    }
                ])
                ->where('m.status =:Active AND m.parent_id =:parent',['Active'=>$status,'parent'=>0])
                ->all();

            $result = [];
            foreach ($data as $child_1) {
                $result[$child_1->id] = '--|'.$child_1->name;
                if ($child_1->childrens) {
                    foreach ($child_1->childrens as $child_2) {
                        $result[$child_2->id] = '--| --|'.$child_2->name;

                        if ($child_2->childrens) {
                            foreach ($child_2->childrens as $child_3) {
                                $result[$child_3->id] = '--| --| --|'.$child_3->name;
                            }
                        }
                    }
                }
            }
        return $result;
    }

    public function getMenuChildrents($status=true)
    {
        $data = self::find()->alias('m')->select(['m.id','m.name','m.parent_id','m.parent_name'])
                ->joinWith([
                    'childrens as ch_1' => function (\yii\db\ActiveQuery $query2) {
                        $query2->select(['ch_1.id','ch_1.name','ch_1.parent_id','ch_1.status','ch_1.parent_name'])
                            ->andOnCondition(['ch_1.status' => true])
                            /*->joinWith([
                                'childrens as ch_2' => function (\yii\db\ActiveQuery $query2) {
                                    $query2->select(['ch_2.id','ch_2.name','ch_2.parent_id','ch_2.status','ch_2.parent_name'])
                                    ->andOnCondition(['ch_2.status' => true])
                                    ->orderBy([
                                        'ch_2.order' => SORT_ASC,
                                        'ch_2.created_at' => SORT_DESC,
                                    ]);
                                }
                            ])*/
                            ->orderBy([
                                'ch_1.order' => SORT_ASC,
                                'ch_1.created_at' => SORT_DESC,
                        ]);
                    }
                ])
                ->where('m.status =:Active AND m.parent_id =:parent',['Active'=>$status,'parent'=>0])
                ->all();

            $result = [];
            foreach ($data as $child_1) {
                $result[$child_1->id] = '--|'.$child_1->name;
                if ($child_1->childrens) {
                    foreach ($child_1->childrens as $child_2) {
                        $result[$child_2->id] = '--| --|'.$child_2->name;

                        // if ($child_2->childrens) {
                        //     foreach ($child_2->childrens as $child_3) {
                        //         $result[$child_3->id] = '--| --| --|'.$child_3->name;
                        //     }
                        // }
                    }
                }
            }
        return $result;
    }

    private $data;
    public function getMenuParent($parent = 0,$level = '')
    {
        $result = Menus::find()->asArray()->where('status =:Active AND parent_id =:parent',['Active'=>1,'parent'=>$parent])->all();
        $level .='--| ';
        $i = 0;
        foreach ($result as $key=>$value) {
            
            if($parent == 0){
                $level='--| ';
            }else {
                $i++;
            }
            if ($i>=2) {
                $i=0;
                // continue;
            }
            $this->data[$value['id']] = $level.$value['name'];
            self::getMenuParent($value['id'],$level);
        }
        return $this->data;
    }

    private $child;
    public function getIdMenuChild($id)
    {
        $result = Menus::find()->select(['id','parent_id'])->where('status =:Active AND parent_id =:parent_id',[':Active'=>1,':parent_id'=>$id])->all();
        $this->child[$id] = $id;

        if($result){
            foreach ($result as $value) {
                $this->child[$value->id] = $value->id;
                self::getIdMenuChild($value->id);
            }
        }
        return $this->child;
    }
}