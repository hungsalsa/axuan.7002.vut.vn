<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property int $type
 * @property string $value
 * @property int $link
 */
class SearchId extends \yii\db\ActiveRecord
{
    public $peopleId;
    public function rules()
    {
        return [
            [['peopleId'], 'match', 'pattern' => '/^[0-9]+$/','message' => '{attribute} bao gồm các số không chứa khoảng trắng'],
            ['peopleId', 'string', 'max' => 12, 'min' => 9, 'tooLong' => '{attribute} dài nhất 12 ký tự', 'tooShort' => '{attribute} ngắn nhất 9 ký tự']
        ];
    }

    public function attributeLabels()
    {
        return [
            'peopleId' => 'Số chứng minh',
        ];
    }

}
