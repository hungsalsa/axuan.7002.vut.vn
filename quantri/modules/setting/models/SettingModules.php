<?php

namespace quantri\modules\setting\models;

use Yii;
use quantri\modules\products\models\Productcategory;
use quantri\modules\news\models\Categories;

class SettingModules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_setting_modules';
    }

    public function rules()
    {
        return [
            [['name', 'type_module','positions', 'status'], 'required','message'=>'{attribute} không được để trống'],
            [[ 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated','parent_id','count_pro'], 'integer'],
            [['order'], 'number'],
            [['content'], 'string'],
            // [['cate_slug'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
            // [['page_show'], 'string', 'max' => 255],
            [['type_module'], 'string', 'max' => 30],
            [['positions','hienthi'], 'string', 'max' => 50],
            [['cate_id', 'page_show'], 'safe'],
            // [['cate_slug'], 'unique'],
            [['parent_id'],'validateCategory','on'=>['update']],
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên Module',
            'type_module' => 'Loại Module',
            'parent_id' => 'Module cha',
            'cate_slug' => 'Danh mục',
            'cate_id' => 'Liên kết tới danh mục',
            'page_show' => 'Trang hiển thị',
            'order' => 'Sắp xếp',
            'hienthi' => 'Kiểu hiển thị',
            'positions' => 'Vị trí hiển thị',
            'content' => 'Nội dung',
            'count_pro' => 'Số (hiển thị)',
            'status' =>  'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }

    public function getModulecha()
    {
        return $this->hasOne(self::className(),['id'=>'parent_id']);
    }
    public function getParents()
    {
        return $this->hasOne(self::className(),['parent_id'=>'id']);
    }

    public function getChildrents()
    {
        return $this->hasMany(self::className(),['parent_id'=>'id']);
    }

    public function getSettingpages()
    {
        return $this->hasMany(SettingModulesPages::className(),['module_id'=>'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Productcategory::className(),['idCate'=>'cate_id']);
    }

    public function getDmuctin()
    {
        return $this->hasOne(Categories::className(),['id'=>'cate_id']);
    }

    public function getUsercreate()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userCreated']);
    }
    public function getUserupdate()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userUpdated']);
    }

    public function validateCategory($attribute, $params)
    {
        $count = self::find()->where('status=:active AND parent_id=:parent',[':active'=>true,':parent'=>0])->all();
        $old_parent = self::find()->select('parent_id')->where('id=:id',[':id'=>$this->id])->one();
        $one = $count[0];
        if ($one->id == $this->id && count($count) ==1 && $this->$attribute != 0) {
            $this->addError($attribute, 'Bạn không thể chọn danh mục cha cho danh mục này, danh mục này đang là danh mục Root duy nhất');
        }
    }

    // lấy tất cả các Id con show chi tiết module
    /*private $child2;
    public function getIdModuleChild($id)
    {
        $result = SettingModules::find()->select(['id','parent_id'])->where('status =:Active AND parent_id =:parent_id',[':Active'=>1,':parent_id'=>$id])->all();
        $this->child2[$id] = $id;

        if($result){
            foreach ($result as $value) {
                $this->child2[$value->id] = $value->id;
                self::getIdMenuChild($value->id);
            }
        }
        return $this->child2;
    }*/

    public function getAllParent()
    {
        return yii\helpers\ArrayHelper::map(self::find()->select(['id','name'])->where('status=:status AND parent_id=:parent',[':status'=>true,':parent'=>0])->andWhere(['<>','type_module','custom'])->all(),'id','name');
    }
    public function getPosition($id)
    {
        $data = self::find()->select(['positions'])->where('id=:id',[':id'=>$id])->one();
        return $data->positions;
    }

    private $child;
    public function getChildrent($id)
    {
        $this->child[$id] = $id;
        $data = self::find()->select(['id','parent_id'])->where('parent_id=:parent_id AND status=:status',[':parent_id'=>$id,':status'=>true])->all();
        foreach ($data as $key=>$value) {
            $this->child[$value->id] = $value->id;
            self::getChildrent($value->id);
        }
        return array_unique($this->child);
    }

    public function getModuleParentZero()
    {
        return yii\helpers\ArrayHelper::map(self::find()->select(['id','name','type_module'])->asArray()->where('status =:Active AND parent_id =:parent',['Active'=>1,'parent'=>0])->all(),'id','name');
}
    public $parent;
    public function getModuleParent($parent = 0,$level = '')
    {
        $result = self::find()->select(['id','name','type_module'])->asArray()->where('status =:Active AND parent_id =:parent',['Active'=>1,'parent'=>$parent])->all();
        $level .=' --| ';

        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level=' --| ';
            }
            $this->parent[$value['id']] = $level.$value['name'];
            self::getModuleParent($value['id'],$level);
        }
        return $this->parent;
    }


    private $data22;
    public function getAllModuleParent($idArray,$parent = 0, $level =""){
        $result = SettingModules::find()->asArray()->where('parent_id=:parent AND status =:Status',['parent'=>$parent,'Status'=>1])->andWhere(['!=', 'id', $id])->all();
        // Tim tat ca cac 
        $level .=" --| ";
        foreach ($result as $key => $value) {
            if($parent == 0){
                $level = "";
            }
            $this->data22[$value["id"]] = $level.$value["name"];
            self::getAllModuleParent($value['id'],$level);
        }
        return $this->data22;
    }

    public function getAllNameIdParent($id=null)
    {
        $data = $this->getAllParentById($id);
        $result =[];
        if ($data) {
            foreach ($data as $one) {
                $result[$one['id']] = '--|'.$one['name'];

                if (!empty($one['childrents'])) {
                    foreach ($one['childrents'] as $two) {
                        $result[$two['id']] = '--| --|'.$one['name'];

                        if (!empty($two['childrents'])) {
                            foreach ($two['childrents'] as $three) {
                                $result[$three['id']] = '--| --| --|'.$three['name'];
                            }
                        }
                    }
                }
            }
            
        }
        return $result;
    }
    public function getAllParentById($id=null)
    {
        // dbg($id);
        $data = self::find()->alias('c')->select(['c.id','c.parent_id','c.name'])
        ->joinWith([
            'childrents as ch' => function ($query) {
                $query->select(['ch.id','ch.parent_id','ch.name'])
                ->andOnCondition(['ch.status' => true])
                ->joinWith([
                    'childrents as ch2' => function (\yii\db\ActiveQuery $query2) {
                        $query2->select(['ch2.id','ch2.parent_id','ch2.name'])
                        // $query2->andWhere(['ch2.status'=>true]);
                        ->andOnCondition(['ch2.status' => true]);
                        // $query2->andWhere(['chi.status'=>1]);
                        // $query2->joinWith(["category cai"],false);
                    }
                ]);
                // $query->andWhere(['ch.status'=> true]);
            },
        ],true)
        ->where('c.status =:active',['active'=>true]);
        if ($id!=null) {
            $data->andWhere(['!=','c.id',$id]);
        }
        return $data->asArray()->all();
    }

}