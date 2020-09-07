<?php

namespace frontend\models\product;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_product_type".
 *
 * @property int $id
 * @property string $typeName
 * @property int $userCreated
 * @property int $status
 * @property int $updated_at
 * @property int $userUpdated
 */
class FProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userCreated', 'status', 'updated_at', 'userUpdated'], 'required'],
            [['userCreated', 'updated_at', 'userUpdated'], 'integer'],
            [['typeName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['typeName'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeName' => 'Type Name',
            'userCreated' => 'User Created',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getAllType($status=true)
    {
        return ArrayHelper::map(self::find()->where('status=:status',[':status'=>$status])->all(),'id','typeName');
    }
}
