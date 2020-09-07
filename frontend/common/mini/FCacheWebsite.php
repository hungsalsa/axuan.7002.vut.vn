<?php

namespace frontend\common;

use Yii;

/**
 * This is the model class for table "tbl_cache_website".
 *
 * @property int $id
 * @property string $name
 * @property int $time
 */
class FCacheWebsite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_cache_website';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'time'], 'required'],
            [['time'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'time' => 'Time',
        ];
    }

    public function getallCache()
    {
        return yii\helpers\ArrayHelper::map(self::find()->select(['name','time'])->all(),'name','time');
    }
}
