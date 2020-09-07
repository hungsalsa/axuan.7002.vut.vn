<?php

namespace quantri\modules\setting\models;

use Yii;
use quantri\modules\quantri\models\Productcategory;
/**
 * This is the model class for table "tbl_setting_category".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int $link_cate
 * @property int $order
 * @property string $icon
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class SettingCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_setting_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['name', 'link_cate', 'title', 'description', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['parent_id', 'link_cate', 'order', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['description'], 'string'],
            [['name', 'slug', 'title', 'icon'], 'string', 'max' => 255],
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
            'name' => 'Tên',
            'parent_id' => 'Parent ID',
            'link_cate' => 'Link Cate',
            'slug' => 'Đường dẫn',
            'title' => 'Title',
            'description' => 'Description',
            'order' => 'Order',
            'icon' => 'Icon',
            'status' => 'Trạng thái',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public $data;
    public function getParentSetCategory($parent = 0,$level = '')
    {
        $result = SettingCategory::find()->asArray()->where('status =:Active AND parent_id =:parent',['Active'=>1,'parent'=>$parent])->all();
        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level='';
            }
            $this->data[$value['id']] = $level.$value['name'];
            self::getParentSetCategory($value['id'],$level);
        }
        return $this->data;
    }

    public function getProductCategory()
    {
        return $this->hasOne(Productcategory::className(),['idCate'=>'link_cate']);
    }

    public function getParent()
    {
        return $this->hasOne(SettingCategory::className(),['parent_id'=>'id']);
    }
}