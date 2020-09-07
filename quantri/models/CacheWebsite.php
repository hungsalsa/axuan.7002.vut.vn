<?php

namespace quantri\models;

use Yii;

/**
 * This is the model class for table "tbl_cache_website".
 *
 * @property int $id
 * @property string $name
 * @property int $time
 */
class CacheWebsite extends \yii\db\ActiveRecord
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

    public function updateCache($name)
    {
        $data = self::findOne(['name'=>$name]);
        if ($data) {
            $data->time = time();
        } else {
            $data = new CacheWebsite();
            $data->name = $name;
            $data->time = time();
        }
        return $data->save();
    }
}
