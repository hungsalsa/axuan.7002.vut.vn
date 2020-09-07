<?php

namespace quantri\modules\setting\models;

use Yii;
use quantri\modules\quantri\models\Productcategory;
/**
 * This is the model class for table "tbl_setting_categories".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int $link_cate
 * @property string $slug_cate
 * @property string $title
 * @property string $description
 * @property int $order
 * @property string $icon
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $userCreated
 */
class SettingCategories extends \yii\db\ActiveRecord
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
            [['name', 'link_cate', 'slug_cate', 'status', 'created_at', 'updated_at', 'userCreated'], 'required'],
            [['parent_id', 'link_cate','created_at', 'updated_at', 'userCreated','userUpdated'], 'integer'],
            [['description'], 'string'],
            [['order'], 'number'],
            [['name', 'slug_cate', 'title', 'icon'], 'string', 'max' => 255],
            // [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên hiển thị',
            'parent_id' => ' Cha',
            'link_cate' => 'Liên kết sản phẩm',
            'slug_cate' => 'Đường dẫn',
            'title' => 'Title',
            'description' => 'Description',
            'order' => 'Sắp xếp',
            'icon' => 'Icon',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Productcategory::className(),['idCate'=>'link_cate']);
    }

    public $data;
    public function getParentSetCategory($parent = 0,$level = '')
    {
        $result = SettingCategories::find()->asArray()->where('status =:Active AND parent_id =:parent',['Active'=>1,'parent'=>$parent])->all();
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
}