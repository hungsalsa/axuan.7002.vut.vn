<?php

namespace frontend\models\setting;

use Yii;

/**
 * This is the model class for table "tbl_setting_modules_pages".
 *
 * @property int $id
 * @property string $name
 * @property int $module_id
 * @property int $status
 */
class FSettingModulesPages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_setting_modules_pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'module_id', 'status'], 'required'],
            [['module_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['name', 'module_id'], 'unique', 'targetAttribute' => ['name', 'module_id']],
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
            'module_id' => 'Module ID',
            'status' => 'Status',
        ];
    }

    public function getModulePages($name)
    {
        return yii\helpers\ArrayHelper::map(self::find()->select(['id','module_id'])->where(['name'=>$name,'status'=>1])->all(),'id','module_id');
    }
}
